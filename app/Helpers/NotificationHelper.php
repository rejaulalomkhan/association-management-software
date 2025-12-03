<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Services\SettingsService;

class NotificationHelper
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Send payment approval notification to member
     */
    public function sendPaymentApprovalNotification($payment)
    {
        // In a real implementation, this would send SMS, email, or push notification
        // For now, we'll just create a notification record

        $message = "আপনার {$payment->month} {$payment->year} মাসের ৳{$payment->amount} টাকার পেমেন্ট অনুমোদিত হয়েছে।";

        return $this->createNotification($payment->user_id, 'payment_approved', $message, $payment->id);
    }

    /**
     * Send payment rejection notification to member
     */
    public function sendPaymentRejectionNotification($payment, $reason)
    {
        $message = "আপনার {$payment->month} {$payment->year} মাসের পেমেন্ট প্রত্যাখ্যাত হয়েছে। কারণ: {$reason}";

        return $this->createNotification($payment->user_id, 'payment_rejected', $message, $payment->id);
    }

    /**
     * Send membership approval notification
     */
    public function sendMembershipApprovalNotification($user)
    {
        $message = "অভিনন্দন! আপনার সদস্যপদ অনুমোদিত হয়েছে। আপনার সদস্য নম্বর: {$user->membership_id}";

        return $this->createNotification($user->id, 'membership_approved', $message);
    }

    /**
     * Send membership rejection notification
     */
    public function sendMembershipRejectionNotification($user, $reason)
    {
        $message = "দুঃখিত! আপনার সদস্যপদ আবেদন প্রত্যাখ্যাত হয়েছে। কারণ: {$reason}";

        return $this->createNotification($user->id, 'membership_rejected', $message);
    }

    /**
     * Send monthly due reminder
     */
    public function sendMonthlyDueReminder($user, $month, $year, $amount)
    {
        $message = "স্মরণ: আপনার {$month} {$year} মাসের ৳{$amount} টাকা বকেয়া রয়েছে। দয়া করে শীঘ্রই পরিশোধ করুন।";

        return $this->createNotification($user->id, 'due_reminder', $message);
    }

    /**
     * Create notification record
     */
    protected function createNotification($userId, $type, $message, $relatedId = null)
    {
        return \App\Models\Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'message' => $message,
            'related_id' => $relatedId,
            'read' => false
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId)
    {
        $notification = \App\Models\Notification::find($notificationId);

        if ($notification) {
            $notification->update(['read' => true]);
            return true;
        }

        return false;
    }

    /**
     * Get unread notifications for user
     */
    public function getUnreadNotifications($userId)
    {
        return \App\Models\Notification::where('user_id', $userId)
            ->where('read', false)
            ->latest()
            ->get();
    }

    /**
     * Get unread count
     */
    public function getUnreadCount($userId)
    {
        return \App\Models\Notification::where('user_id', $userId)
            ->where('read', false)
            ->count();
    }
}

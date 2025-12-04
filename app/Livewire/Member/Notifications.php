<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class Notifications extends Component
{
    use WithPagination;

    public function markAsRead($notificationId)
    {
        $notification = Notification::where('user_id', Auth::id())->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            session()->flash('success', 'নোটিফিকেশন পড়া হয়েছে হিসেবে চিহ্নিত করা হয়েছে');
        }
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('read', false)
            ->update(['read' => true]);
        session()->flash('success', 'সকল নোটিফিকেশন পড়া হয়েছে হিসেবে চিহ্নিত করা হয়েছে');
    }

    public function deleteNotification($notificationId)
    {
        $notification = Notification::where('user_id', Auth::id())->find($notificationId);
        if ($notification) {
            $notification->delete();
            session()->flash('success', 'নোটিফিকেশন মুছে ফেলা হয়েছে');
        }
    }

    public function render()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        $unreadCount = Notification::where('user_id', Auth::id())
            ->where('read', false)
            ->count();

        return view('livewire.member.notifications', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ])->layout('layouts.app');
    }
}

<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    use WithPagination;

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            session()->flash('success', 'নোটিফিকেশন পড়া হয়েছে হিসেবে চিহ্নিত করা হয়েছে');
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        session()->flash('success', 'সকল নোটিফিকেশন পড়া হয়েছে হিসেবে চিহ্নিত করা হয়েছে');
    }

    public function deleteNotification($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->delete();
            session()->flash('success', 'নোটিফিকেশন মুছে ফেলা হয়েছে');
        }
    }

    public function render()
    {
        $notifications = Auth::user()->notifications()->paginate(15);
        $unreadCount = Auth::user()->unreadNotifications->count();

        return view('livewire.member.notifications', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ])->layout('layouts.app');
    }
}

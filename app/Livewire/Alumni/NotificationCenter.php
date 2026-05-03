<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationCenter extends Component
{
    public $unreadCount = 0;

    public function mount()
    {
        $this->unreadCount = Auth::user() ? Auth::user()->unreadNotifications()->count() : 0;
    }

    public function getListeners()
    {
        $userId = Auth::id();
        
        if (! $userId) {
            return [];
        }

        return [
            "echo-private:App.Models.User.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'refreshNotifications',
        ];
    }

    #[On('refresh-notifications')]
    public function refreshNotifications()
    {
        $this->unreadCount = Auth::user()->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->unreadCount = Auth::user()->unreadNotifications()->count();
            
            if (isset($notification->data['url'])) {
                return redirect($notification->data['url']);
            }
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->unreadCount = 0;
    }

    public function render()
    {
        $notifications = Auth::user() 
            ? Auth::user()->notifications()->latest()->limit(10)->get() 
            : collect();

        return view('livewire.alumni.notification-center', [
            'notifications' => $notifications
        ]);
    }
}

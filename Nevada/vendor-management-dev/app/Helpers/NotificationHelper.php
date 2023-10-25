<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;

class NotificationHelper {

    public function __construct(
        private string $title,
        private string $message
    ) {}

    public function sendTo(string ...$roles): void
    {
        $notification = Notification::create([
            'title' => $this->title,
            'message' => $this->message,
        ]);

        $users = User::whereHas('roles', function($query) use ($roles) {
            $query = $query->where('name', $roles[0]);
            array_shift($roles);

            foreach ($roles as $role) {
                $query = $query->orWhere('name', $role);
            }
        })->get();

        foreach ($users as $user) {
            $user->notifications()->attach($notification);
        }
    }
}

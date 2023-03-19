<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MailService
{
    public function getUsers($type): Collection
    {
        switch ($type) {
            case 'Тренерам':
                $users = User::where('role_id', 2)->get();
                break;
            case 'Администраторам':
                $users = User::where('role_id', 1)->get();
                break;
            case 'Представителям фитнес-клуба':
                $users = User::where('role_id', 4)->get();
                break;
            case 'Клиентам сайта':
                $users = User::where('role_id', 3)->get();
                break;
            case 'Подписавшимся':
                $users = Subscription::where('status', 'subscribed')->get();
                break;
            case 'Тестовый адрес':
                $users = Subscription::where('email', 'admin.test@mail.ru')->get();
                break;
        }

        return $users;
    }
}

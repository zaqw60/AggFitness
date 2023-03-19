<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\Social;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialService implements Social
{
    /**
     * @param SocialUser $socialUser
     * @return string
     * @throws \Exception
     */
    public function loginAndGetRedirectUrl(SocialUser $socialUser): string
    {
        $user = User::query()->where('email', '=', $socialUser->getEmail())->first();
        if ($user === null) {
            return route('register');
        }

        $user->name = $socialUser->getNickname();
        if (isset($user->profile)) {
            $user->profile->image = $socialUser->getAvatar();
        }

        if ($user->save()) {
            Auth::loginUsingId($user->id);

            return route('account');
        }

        throw new \Exception("Did not save user");
    }
}

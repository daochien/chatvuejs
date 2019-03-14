<?php

namespace App\Observers;

use App\User;
use Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    protected $_toEmail;
    public function created(User $user)
    {
        $secretKey = md5($user->getAttribute('id').$user->getAttribute('email').md5('@daochien'));
        $data = [
            'name' => $user->getAttribute('first_name') .' '. $user->getAttribute('last_name'),
            'link' => route('verify', ['id' => $user->getAttribute('id'), 'email' => $user->getAttribute('email'), 'secretKey' => $secretKey])
        ];
        $this->_toEmail = $user->getAttribute('email');
        Mail::send('mail', $data, function($message)  {
           $message->to($this->_toEmail, 'Kích hoạt tài khoản')->subject('Kích hoạt tài khoản blog-me.vn');
           $message->from('chienedudct@gmail.com', 'Đào Văn Chiến');
        });
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

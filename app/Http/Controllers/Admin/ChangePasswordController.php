<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Requests\Password\ChangeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle updatePassword.
     *
     * @param  ChangeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ChangeRequest $request)
    {
        $request->validated();

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", __('messages.admin.password.change.mismatch'));
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", __('messages.admin.password.change.success'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('admin.password.index');
    }
}

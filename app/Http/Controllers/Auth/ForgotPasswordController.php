<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Mail\Websitemail;

use App\User;
use App\Models\PasswordResetToken;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function resetPasswordRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function resetPasswordEmailRequest(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user_data = User::where('email', $request->email)->first();
        if (!$user_data) {
            return redirect()->back()->with('error', 'Email address not found');
        }

        $token_data = PasswordResetToken::where('email', $request->email)->first();
        if ($token_data) {
            return redirect()->back()->with('error', 'A token already exist for this user. Make sure you dont have a link already in your mail');
        }

        $token = hash('sha256', time());
        PasswordResetToken::insert([
            'token' => $token,
            'email' => $user_data->email,
            'created_at' => Carbon::now()
        ]);

        $reset_link = url('user/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Kindly click on this link to reset your password<br>';
        $message .= '<a href="' . $reset_link . '">Click here</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('login')->with('success', 'Kindly check you mail for a reset link');
    }

    public function resetPassword($token, $email)
    {
        // dd($token);
        $user_data = PasswordResetToken::where('token', $token)->where('email', $email)->first();
        if (!$user_data) {
            return redirect()->route('login')->with('error', 'Invalid token/email');
        }

        return view('auth.passwords.reset', compact('token', 'email'));
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $token_data = PasswordResetToken::where('token', $request->token)->where('email', $request->email)->first();

        DB::table('password_reset_tokens')->where('email', $token_data->email)->delete();

        $user_data = User::where('email', $request->email)->first();
        $user_data->password = Hash::make($request->password);
        $user_data->update();


        return redirect()->route('login')->with('success', 'Password updated successfully. You can now login to your account');
    }
}

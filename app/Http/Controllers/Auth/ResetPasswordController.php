<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * Show the reset password form.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function getPassword($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Handle the password reset process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            // Validate the request inputs
            $request->validate([
                'email'    => 'required|email|exists:users,email',
                'password' => 'required|string|min:6|confirmed',
                'token'    => 'required',
            ]);

            // Find password reset record
            $resetRecord = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();

            if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
                return back()->with('error', 'Invalid token!')->withInput();
            }

            // Check if the token has expired (valid for 60 minutes)
            if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
                return back()->with('error', 'The password reset link has expired.')->withInput();
            }

            // Find the user and update the password
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                // Delete the used password reset record
                DB::table('password_resets')->where('email', $request->email)->delete();

                return redirect('/login')->with('success', 'Your password has been changed successfully!');
            }

            return back()->with('error', 'User not found!')->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating password: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating your password. Please try again later.');
        }
    }
}

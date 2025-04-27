<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; 
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /** Show the reset password page */
    public function getPassword($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /** Update the user's password */
    public function updatePassword(Request $request)
    {
        try {
            // Validate the input
            $request->validate([
                'email'    => 'required|email|exists:users,email',
                'password' => 'required|string|min:6|confirmed',
                'token'    => 'required',
            ]);

            // Use 'password_resets' (default Laravel table) for consistency
            $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();
        
            if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
                return back()->with('error', 'Invalid token!')->withInput();
            }
            
            // Optional: Check if token expired (valid for 60 minutes)
            if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
                return back()->with('error', 'The password reset link has expired.')->withInput();
            }

            // Find user and update password
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                // Delete the token after successful reset
                DB::table('password_resets')->where('email', $request->email)->delete();

                return redirect('/login')->with('success', 'Your password has been changed successfully!');
            } else {
                return back()->with('error', 'User not found!')->withInput();
            }

        } catch (\Exception $e) {
            Log::error('Error updating password: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating your password. Please try again later.');
        }
    }
    
}
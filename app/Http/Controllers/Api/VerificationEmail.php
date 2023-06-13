<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationEmail extends Controller
{
    public function verifyUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user && hash_equals($request->hash, sha1($user->getEmailForVerification()))) {
            $user->markEmailAsVerified();
            $request->user = $user;
            return response()->json(['message' => 'Email verified'], 201);
        } else {
            return response()->json(['error' => 'Error for verification email'], 400);
        }
    }

    public function checkStatusVerification(Request $request)
    {
        $user = User::where('login', $request->login)->first();
        if ($user->email_verified_at) {
            return response()->json(['message' => 'You already successfully verified account'], 201);
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = User::where('login', $request->login)->first();
        if (!$user->email_verified_at) {
            $user->sendEmailVerificationNotification();
            return response()->json(['message' => 'On your email resend verification link'], 201);
        }
        return response()->json(['message' => 'You already successfully verified account'], 201);
    }
}

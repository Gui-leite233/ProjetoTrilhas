<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        Log::info('Email verification attempt for user: ' . $request->user()->id);

        if ($request->user()->hasVerifiedEmail()) {
            Log::info('User already verified');
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        try {
            $result = $request->user()->forceFill([
                'email_verified_at' => now()
            ])->save();

            if ($result) {
                event(new Verified($request->user()));
                Log::info('User email verified successfully');
            } else {
                Log::error('Failed to save verification status');
            }
        } catch (\Exception $e) {
            Log::error('Error verifying email: ' . $e->getMessage());
            return redirect()->route('verification.notice')->with('error', 'Verification failed');
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}

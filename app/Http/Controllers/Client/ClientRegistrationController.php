<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientCredentialsMail;
use Illuminate\Support\Facades\DB;

class ClientRegistrationController extends Controller
{
    public function autoLoginExisting(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:15',
        ]);

        try {
            $userQuery = User::where('email', $request->email)
                ->where('role', 'client')
                ->where('status', 'active');

            $user = $userQuery->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'logged_in' => false,
                    'message' => 'No existing active client found.'
                ]);
            }

            if (!empty($request->mobile)) {
                $clientProfile = $user->client;
                $normalizedInputMobile = preg_replace('/\D+/', '', (string) $request->mobile);
                $normalizedSavedMobile = preg_replace('/\D+/', '', (string) ($clientProfile->mobile ?? ''));

                if (!empty($normalizedSavedMobile) && $normalizedInputMobile !== $normalizedSavedMobile) {
                    return response()->json([
                        'success' => false,
                        'logged_in' => false,
                        'message' => 'Existing client found, but mobile does not match.'
                    ]);
                }
            }

            // Explicitly login and regenerate session
            Auth::login($user, remember: false);
            $user->update(['last_login_at' => now()]);

            // Explicitly regenerate session ID for security
            request()->session()->regenerate();

            return response()->json([
                'success' => true,
                'logged_in' => true,
                'message' => 'Logged in successfully.'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'logged_in' => false,
                'message' => 'Auto-login failed.'
            ], 500);
        }
    }

    public function quickRegister(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:15',
            'pincode' => 'required|string|max:10',
        ]);

        $email = $request->email;

        try {
            // 1. Check if an active USER account already exists for this email with client role
            $existingUser = User::where('email', $email)->where('role', 'client')->where('status', 'active')->first();

            if ($existingUser) {
                // User already exists - attempt auto-login with mobile verification
                if (!empty($request->mobile)) {
                    $clientProfile = $existingUser->client;
                    $normalizedInputMobile = preg_replace('/\D+/', '', (string) $request->mobile);
                    $normalizedSavedMobile = preg_replace('/\D+/', '', (string) ($clientProfile->mobile ?? ''));

                    // If user has saved mobile and it doesn't match, return error
                    if (!empty($normalizedSavedMobile) && $normalizedInputMobile !== $normalizedSavedMobile) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Email exists but mobile number does not match. Please use the correct mobile number.'
                        ], 422);
                    }
                }

                // Auto-login the existing user
                Auth::login($existingUser, remember: false);
                $existingUser->update(['last_login_at' => now()]);
                request()->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'status' => 'success',
                    'message' => 'Welcome back! Redirecting...',
                    'redirect' => route('find.agents', ['pincode' => $request->pincode])
                ]);
            }

            // 2. Check if email exists for any other role (agent/admin)
            $anyUser = User::where('email', $email)->first();
            if ($anyUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered as ' . ucfirst($anyUser->role) . '. Please login with your account.'
                ], 422);
            }

            // 3. Email doesn't exist - create new user
            DB::beginTransaction();

            // Create User
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->email), // Password is same as email
                'role' => 'client',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            // Create Client Profile
            Client::create([
                'user_id' => $user->id,
                'mobile' => $request->mobile,
                'pincode' => $request->pincode,
            ]);

            // Send Email
            Mail::to($user->email)->send(new ClientCredentialsMail($user->fullname, $user->email, $user->email));

            DB::commit();

            // Auto-Login new user
            Auth::login($user, remember: false);
            request()->session()->regenerate();

            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'Registration successful! Redirecting...',
                'redirect' => route('find.agents', ['pincode' => $request->pincode])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Failed to process request: ' . $e->getMessage()
            ], 500);
        }
    }
}

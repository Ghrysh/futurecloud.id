<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        $user = User::where('email', $request->email)->first();
        $isGoogleUser = $user && !empty($user->google_id);

        return view('auth.reset-password', [
            'request' => $request,
            'isGoogleUser' => $isGoogleUser
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $user = User::where('email', $request->email)->first();
        if ($user && !empty($user->google_id)) {
            $rules['username'] = ['required', 'string', 'max:255', 'unique:users,username,'.$user->id];
            $rules['first_name'] = ['required', 'string', 'max:255'];
            $rules['last_name'] = ['required', 'string', 'max:255'];
        }

        $request->validate($rules);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $fillData = [
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ];

                if (!empty($user->google_id)) {
                    if ($request->filled('username')) {
                        $fillData['username'] = $request->username;
                    }
                    if ($request->filled('first_name')) {
                        $fillData['first_name'] = $request->first_name;
                    }
                    if ($request->filled('last_name')) {
                        $fillData['last_name'] = $request->last_name;
                    }
                }

                $user->forceFill($fillData)->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}

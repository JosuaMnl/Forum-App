<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    //
    public function show() {
        return view('pages.auth.sign-up');
    }

    public function signUp(SignUpRequest $request) {
        // Get request from form request
        // Make password to bcrypt
        // Add a dummy image according to the usename
        // Create user after validate request
        // If successful create user, then login and redirect to list discussion
        // If not successful, return 500

        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $validated['picture'] = config('app.avatar_generator_url').$validated['username'];

        $createUser = User::create($validated);

        if ($createUser) {
            Auth::login($createUser);
            return redirect()->route('discussions.index');
        }

        return abort(500);
    }
}

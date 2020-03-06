<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);

        $path = request()->file('avatar')->store('avatars', 'public');

        auth()->user()->update([
            'avatar_path' => $path
        ]);

        return response($path, 200);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($username) {

        $user = User::where('username', $username)->first();

        if(!$user) {
            abort(404);
        }

        $picture = filter_var($user->picture, FILTER_VALIDATE_URL)
            ? $user->picture : Storage::url($user->picture);

        $perPage = 5;
        $columns = ['*'];
        $discussionsPageName = 'discussions';
        $answersPageName = 'answers';

        return view('pages.users.show', [
            'user' => $user,
            'picture' => $picture,
            'discussions' => Discussion::where('user_id', $user->id)->paginate($perPage, $columns, $discussionsPageName),
            'answers' => Answer::where('user_id', $user->id)->paginate($perPage, $columns, $answersPageName),
        ]);
    }
}

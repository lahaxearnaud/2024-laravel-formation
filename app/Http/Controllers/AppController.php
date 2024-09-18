<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __invoke(Request $request): View
    {
        // ICI c'est magouille et cie mais c'est pour tester les appels dans le front
        /** @var User $user */
        $user = \Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('front')->plainTextToken;

        return view('welcome', [
            'userToken' => $token,
        ]);
    }
}

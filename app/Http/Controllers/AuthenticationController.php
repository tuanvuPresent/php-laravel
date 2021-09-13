<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function authentication($email, $password)
    {
        $user = User::where('email', $email)->get()->first();
        if ($user) {
            if (Hash::check($password, $user->password))
                return $user;
        }
    }

     /**
     * @SWG\Post(
     *     path="/api/auth/login",
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         type="string",
     *         required=true,
     *         @SWG\Schema(
     *            @SWG\Property(property="email", type="string", example="email@example.com"),
     *            @SWG\Property(property="password", type="string", example="string"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->authentication($email, $password);
        if ($user) {
            $token = $user->generateToken();
            $user->setRememberToken($token);
            $user->save();
            return response()->json($token);
        } else {
            return response()->json('invalid email or password');
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->setRememberToken(null);
        $user->save();

        return response()->json('logout success');
    }
}

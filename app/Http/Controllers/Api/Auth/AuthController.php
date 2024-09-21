<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $userRepository;
    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $this->userRepository->createUser($request->all());
        return Response::success('Registration successful', ['user'=>$user]);           
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = $this->userRepository->findWhereFirst('email', $request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return Response::error('اطلاعات ورود نامعتبر است', null, 400);  
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return Response::success('ورود موفقیت‌آمیز بود', [
            'token'=>$token,
            'user'=>$user,
        ]);  
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return Response::success('خروج موفقیت‌آمیز بود', null,200);  
    }
}

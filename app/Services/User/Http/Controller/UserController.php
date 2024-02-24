<?php

declare(strict_types=1);

namespace App\Services\User\Http\Controller;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\User\Database\Repository\UserRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $createUser = $this->userRepository->addUser($request);

        if ($createUser === false) {
            throw new Exception('Произошла ошибка регистрации пользователя');
        }

        $user = $this->userRepository->getUserByEmail($request);

        return ResponseBuilder::success([$user]);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return ResponseBuilder::success(['Успешный вход']);
        }

        return ResponseBuilder::error('Ошибка входа, неверная почта или пароль');
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return ResponseBuilder::success(['Успешно вышли из системы']);
    }

    public function testAuthApi(): JsonResponse
    {
        return ResponseBuilder::success(['qwe']);
    }
}

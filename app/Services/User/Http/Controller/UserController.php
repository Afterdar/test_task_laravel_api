<?php

namespace App\Services\User\Http\Controller;

use App\Http\Requests\RegisterUser;
use App\Services\User\Database\Repository\UserRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUser $request): JsonResponse
    {
        $user = $this->userRepository->addUser($request);

        if ($user === false) {
            throw new Exception('Произошла ошибка регистрации пользователя');
        }

        return ResponseBuilder::success();
    }

    public function login(): JsonResponse
    {
        return ResponseBuilder::success();
    }
}

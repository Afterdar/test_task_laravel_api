<?php

declare(strict_types=1);

namespace App\Services\User\Http\Controller;

use App\Http\Requests\User\AccessTokenRequest;
use App\Services\User\Database\Repository\UserRepository;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getToken(AccessTokenRequest $request): JsonResponse
    {
        $user = $this->userRepository->getUserByEmail($request);

        if (!$user || !Hash::check($request['password'], $user['password']))
        {
            throw ValidationException::withMessages([
               'password' => 'Неверный password',
            ]);
        }

        return ResponseBuilder::success([$user->createToken($request['device_name'])->plainTextToken]);
    }

    public function deleteToken(PersonalAccessToken $token): JsonResponse
    {
        $token->delete();

        return ResponseBuilder::success();
    }
}

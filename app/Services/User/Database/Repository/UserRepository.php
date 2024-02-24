<?php

declare(strict_types=1);

namespace App\Services\User\Database\Repository;

use App\Http\Requests\User\AccessTokenRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Services\User\Database\Models\User;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    protected $entity = User::class;

    public function addUser(RegisterUserRequest $request): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function getUserByEmail(AccessTokenRequest|RegisterUserRequest $request): Model|null
    {
        return $this->createQueryBuilder()
            ->where('email', '=', $request['email'])
            ->first();
    }
}

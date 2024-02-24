<?php

declare(strict_types=1);

namespace App\Services\Notions\Database\Repository;

use App\Http\Requests\Notions\AddNotionRequest;
use App\Http\Requests\Notions\UpdateNotionsRequest;
use App\Services\Notions\Database\Models\Notions;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NotionsRepository extends Repository
{
    protected $entity = Notions::class;

    public function addNotion(Model|Authenticatable $user, AddNotionRequest $request): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'title' => $request['title'],
                'content' => $request['content'],
                'active' => $request['active'],
                'user_id' => $user['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function getListNotions(Model|Authenticatable $user, int $paginate): LengthAwarePaginator
    {
        $listNotions = $this->createQueryBuilder()
            ->where('user_id', '=', $user['id'])
            ->where('active', '=', true);

        return $listNotions->paginate($paginate);

    }

    public function getNotionById(Model|Authenticatable $user, int $id): Model|Builder|null
    {
        return $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->where('user_id', '=', $user['id'])
            ->first();
    }

    public function updateNotion(Model|Authenticatable $user, UpdateNotionsRequest $request, int $id): bool
    {
        $updateNotion = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->where('user_id', '=', $user['id'])
            ->first();

        if ($updateNotion === false)
        {
            return false;
        }

        $result = $updateNotion->fill([
            'title' => $request['title'],
            'content' => $request['content'],
            'active' => $request['active'],
            'updated_at' => Carbon::now(),
        ]);

        return $result->save();
    }

    public function deleteNotion(Model|Authenticatable $user, int $id): bool
    {
        $deleteNotion = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->where('user_id', '=', $user['id'])
            ->first();

        if ($deleteNotion == null)
        {
            return false;
        }

        return $deleteNotion->delete();
    }

}

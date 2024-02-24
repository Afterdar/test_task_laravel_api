<?php

declare(strict_types=1);

namespace App\Services\Notions\Http\Controller;

use App\Http\Requests\Notions\AddNotionRequest;
use App\Http\Requests\Notions\UpdateNotionsRequest;
use App\Services\Notions\Database\Repository\NotionsRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class NotionsController extends BaseController
{
    private NotionsRepository $notionsRepository;

    public function __construct(NotionsRepository $repository)
    {
        $this->notionsRepository = $repository;
    }

    public function getListNotions(): JsonResponse
    {
        $user = Auth::user();
        $paginate = 10;

        $getListNotions = $this->notionsRepository->getListNotions($user, $paginate);

        if ($getListNotions['data'] == null)
        {
            throw new Exception('Нет заметок у пользователя');
        }

        return ResponseBuilder::success($getListNotions->toArray());
    }

    public function getNotionById(int $id): JsonResponse
    {
        $user = Auth::user();

        $getNotionById = $this->notionsRepository->getNotionById($user, $id);

        if ($getNotionById == null)
        {
            throw new Exception('Не найдено заметки по этому id');
        }
        return ResponseBuilder::success([$getNotionById]);
    }

    public function addNotion(AddNotionRequest $request): JsonResponse
    {
        $user = Auth::user();

        $createNotion = $this->notionsRepository->addNotion($user, $request);

        if ($createNotion === false)
        {
            throw new Exception('Произошла ошибка добавления заметки');
        }

        return ResponseBuilder::success();
    }

    public function updateNotion(UpdateNotionsRequest $request, int $id): JsonResponse
    {
        $user = Auth::user();

        $updateNotion = $this->notionsRepository->updateNotion($user, $request, $id);

        if ($updateNotion === false)
        {
            throw new Exception('Произошла ошибка обновления заметки, неверный id');
        }

        return ResponseBuilder::success();
    }

    public function deleteNotion(int $id): JsonResponse
    {
        $user = Auth::user();

        $deleteNotion = $this->notionsRepository->deleteNotion($user, $id);

        if ($deleteNotion === false)
        {
            throw new Exception('Произошла ошибка удаления заметки, неверный id');
        }

        return ResponseBuilder::success();
    }
}

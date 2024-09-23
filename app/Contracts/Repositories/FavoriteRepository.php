<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\FavoriteInterface;
use App\Models\Favorite;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository extends BaseRepository implements FavoriteInterface
{
    /**
     * Handle show method and update data instantly from models.
     *
     * @param Favorite
     *
     * @return void
     */

    public function __construct(Favorite $favorite)
    {
        $this->model = $favorite;
    }

    public function checkIfExists($userId, $diaryId)
    {
        return $this->model->where('user_id', $userId)
                    ->where('diaries_id', $diaryId)
                    ->first();
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->delete();
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->findOrFail($id);
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->where('user_id', Auth::id())
            ->get();
    }

    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->show($id)->update($data);
    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param Request
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model->query()->get();
    }

    public function where(mixed $id): mixed
    {
        return $this->model->query()->where('user_id', auth()->user_id)
        ->whereNotNull('diaries_id')
        ->where('diaries_id', $id)
        ->orderBy('created_at')
        ->first();
    }

    public function getByUserId($userId)
    {
        return $this->model->query()->where('user_id', $userId)->get();
    }
}

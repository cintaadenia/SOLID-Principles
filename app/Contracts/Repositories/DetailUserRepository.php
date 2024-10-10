<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\DetailUserInterface;
use App\Models\detailuser;
use Illuminate\Http\Request;

class DetailUserRepository extends BaseRepository implements DetailUserInterface
{
    /**
     * Handle show method and update data instantly from models.
     *
     * @param detailuser
     *
     * @return void
     */

    public function __construct(detailuser $detailUser)
    {
        $this->model = $detailUser;
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
        return $this->show($id)->delete($id);
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

    public function where(mixed $id)
    {
        return $this->model->query()->where('user_id', $id);
    }

    public function getByUserId($userId)
    {
        return $this->model->with("user")->where('user_id', $userId)->get();
    }

    public function getAuthDetailUser($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }
}

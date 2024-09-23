<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface FavoriteInterface extends GetInterface, StoreInterface, UpdateInterface, DeleteInterface, SearchInterface, ShowInterface
{
    public function where(mixed $id): mixed;
    public function getByUserId($userId);
    // public function destroy(mixed $id, mixed $diary): mixed;
}

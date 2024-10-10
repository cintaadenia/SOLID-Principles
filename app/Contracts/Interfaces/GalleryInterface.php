<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface GalleryInterface extends GetInterface, StoreInterface, UpdateInterface, DeleteInterface, SearchInterface, ShowInterface
{
    public function where(mixed $id);
    public function getByUserId($userId);
    public function getAuthGallery($userId);
}

<?php

namespace App\Services;

use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    use FileTrait;

    public function store(GalleryRequest $request)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $this->upload('gallery_photos', $request->file('photo'));
        }

        return $validatedData['photo'];
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo_update')) {
            $this->remove($gallery->photo);
            $validatedData['photo'] = $this->upload('gallery_photos', $request->file('photo_update'));

        }else{
            $validatedData['photo'] = $gallery->photo;
        }

        return $validatedData['photo'];
    }
}

<?php

namespace App\Services;

use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function store(GalleryRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('gallery_photos', 'public');
            $validatedData['photo'] = $filePath;
        }

        return $validatedData['photo'];
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo_update')) {
            if ($gallery->photo) {
                Storage::disk('public')->delete($gallery->photo);
            }

            $fotopath = $request->file('photo_update')->store('photo', 'public');
            $validatedData['photo'] = $fotopath;

        }else{
            $validatedData['photo'] = $gallery->photo;
        }

        return $validatedData['photo'];
    }
}

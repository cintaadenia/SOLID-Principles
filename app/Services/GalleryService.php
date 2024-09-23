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

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to add a gallery entry.');
        }

        return [
            'photo' => $validatedData['photo'],
            'user_id' => $validatedData['user_id']
        ];
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

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to add a diary entry.');
        }

        return [
            'photo' => $validatedData['photo'],
            'user_id' => $validatedData['user_id']
        ];
    }
}

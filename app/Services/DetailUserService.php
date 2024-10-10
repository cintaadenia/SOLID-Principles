<?php

namespace App\Services;

use App\Http\Requests\DetailUserRequest;
use App\Http\Requests\UpdateDetailUSerRequest;
use App\Models\detailuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DetailUserService
{
    public function store(DetailUserRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('detailuser_photos', 'public');
            $validatedData['photo'] = $filePath;
        }

        return $validatedData['photo'];
    }

    public function update(UpdateDetailUSerRequest $request, detailuser $detailuser)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo')) {
            if ($detailuser->photo) {
                Storage::disk('public')->delete($detailuser->photo);
            }

            $fotopath = $request->file('photo')->store('photo', 'public');
            $validatedData['photo'] = $fotopath;
        }else{
            $validatedData['photo'] = $detailuser->photo;
        }

        return $validatedData['photo'];
    }
}

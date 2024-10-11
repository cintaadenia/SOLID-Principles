<?php

namespace App\Services;

use App\Http\Requests\DetailUserRequest;
use App\Http\Requests\UpdateDetailUSerRequest;
use App\Models\detailuser;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DetailUserService
{
    use FileTrait;

    public function store(DetailUserRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $this->upload('detailuser_photos', $request->file('photo'));
        }

        return $validatedData['photo'];
    }

    public function update(UpdateDetailUSerRequest $request, detailuser $detailuser)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $this->remove($detailuser->photo);
            $validatedData['photo'] = $this->upload('detailuser_photos', $request->file('photo'));

        }else{
            $validatedData['photo'] = $detailuser->photo;
        }

        return $validatedData['photo'];
    }
}

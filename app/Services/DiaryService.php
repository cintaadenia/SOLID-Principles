<?php

namespace App\Services;

use App\Http\Requests\DiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiaryService
{
    use FileTrait;

    public function store(DiaryRequest $request)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $this->upload('gallery_photos', $request->file('photo'));
        }

        return $validatedData['photo'];
    }

    public function update(UpdateDiaryRequest $request, Diary $diary)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo_update')) {
            $this->remove($diary->photo);
            $validatedData['photo'] = $this->upload('diary_photos', $request->file('photo_update'));

        }else{
            $validatedData['photo'] = $diary->photo;
        }

        return $validatedData['photo'];
    }
}

<?php

namespace App\Services;

use App\Http\Requests\DiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiaryService
{
    public function store(DiaryRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('diary_photos', 'public');
            $validatedData['photo'] = $filePath;
        }

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to add a diary entry.');
        }

        return [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'photo' => $validatedData['photo'],
            'user_id' => $validatedData['user_id']
        ];
    }

    public function update(UpdateDiaryRequest $request, Diary $diary)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('photo_update')) {
            if ($diary->photo) {
                Storage::disk('public')->delete($diary->photo);
            }

            $fotopath = $request->file('photo_update')->store('photo', 'public');
            $validatedData['photo'] = $fotopath;
        }else{
            $validatedData['photo'] = $diary->photo;
        }

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to add a diary entry.');
        }

        return [
            'title' => $validatedData['title_update'],
            'description' => $validatedData['description_update'],
            'photo' => $validatedData['photo'],
            'user_id' => $validatedData['user_id']
        ];
    }
}

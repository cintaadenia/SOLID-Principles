<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\DiaryInterface;
use App\Http\Requests\DiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use App\Models\Favorite;
use App\Services\DiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DiaryController extends Controller
{
    private DiaryInterface $diary;
    private DiaryService $service;

    public function __construct(DiaryInterface $diary, DiaryService $service)
    {
        $this->diary = $diary;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $diaries = $this->diary->getByUserId($auth->id);
        $authdiary = $this->diary->getAuthDiary($auth->id);

        $service = $this->service;

        return view('diary.diary', compact('diaries', 'service', 'auth', 'authdiary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(DiaryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data["photo"] = $this->service->store($request);

        $this->diary->store($data);

        flash()->success('Berhasil Menambahakan data.');
        return to_route('diary.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diary $diary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diary $diary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiaryRequest $request, Diary $diary)
    {
        $data['user_id'] = Auth::id();

        $data = $request->validated();
        $data["photo"] = $this->service->update($request, $diary);

        $this->diary->update($diary->id, $data);

        flash()->success('Data berhasil Diperbarui.');
        return to_route('diary.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diary $diary)
    {
        if (!$this->diary->delete($diary->id)) {

            return back()->with('error');
        }

        return back();
    }

    public function calendar()
    {
        return view('calendar.calendar');
    }
}

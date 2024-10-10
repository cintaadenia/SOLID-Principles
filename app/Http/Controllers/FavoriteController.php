<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\FavoriteInterface;
use App\Contracts\Repositories\FavoriteRepository;
use App\Models\Diary;
use App\Models\Favorite;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    private FavoriteInterface $favorite;
    private FavoriteService $service;

    public function __construct(FavoriteInterface $favorite, FavoriteService $service)
    {
        $this->favorite = $favorite;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addFavorite = $this->favorite->getByUserId(auth()->id());
        $user = auth()->user();
        $favorite=$this->favorite->get();

        return view('Favorite.Favorite', compact('favorite', 'addFavorite', 'user'));
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
    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $existingFavorite = $this->favorite->checkIfExists($userId, $id);

        if ($existingFavorite) {

            flash()->warning('Favorit sudah ada nih...');
            return to_route('diary.index');
        }

        $this->favorite->store([
            'user_id' => $userId,
            'diaries_id' => $id,
        ]);

        flash()->success('Berhasil ditambahkan ke favorit.');
        return to_route('diary.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        if (!$this->favorite->delete($favorite->id)) {

            return back()->with('error');
        }

        flash()->success('Berhasil menghapus dari daftar favorit');
        return back();
    }
}

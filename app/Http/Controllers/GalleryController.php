<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\GalleryInterface;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GalleryController extends Controller
{
    private GalleryInterface $gallery;
    private GalleryService $service;

    public function __construct(GalleryInterface $gallery, GalleryService $service)
    {
        $this->gallery = $gallery;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $gallery = $this->gallery->getByUserId($auth->id);
        $authgallery = $this->gallery->getAuthGallery($auth->id);

        $service = $this->service;

        return view('gallery.gallery', compact( 'auth', 'gallery', 'authgallery', 'service' ));
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
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data["photo"] = $this->service->store($request);

        $this->gallery->store($data);

        flash()->success('Data berhasil Ditambahkan.');
        return to_route('gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $data["photo"] = $this->service->update($request, $gallery);

        $this->gallery->update($gallery->id, $data);

        flash()->success('Data berhasil Diperbarui.');
        return to_route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if (!$this->gallery->delete($gallery->id)) {

            return back()->with('error');
        }

        return back();
    }
}

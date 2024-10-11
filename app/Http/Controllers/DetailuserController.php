<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\DetailUserInterface;
use App\Http\Requests\DetailUserRequest;
use App\Http\Requests\UpdateDetailUSerRequest;
use App\Models\detailuser;
use App\Services\DetailUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DetailuserController extends Controller
{
    private DetailUserInterface $detailuser;
    private DetailUserService $service;

    public function __construct(DetailUserInterface $detailuser, DetailUserService $service)
    {
        $this->detailuser = $detailuser;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $profile = $this->detailuser->getByUserId($auth->id);
        $detailuser = $this->detailuser->getAuthDetailUser($auth->id);

        $service = $this->service;

        return view('detail.detailuser', compact('auth', 'profile', 'detailuser', 'service' ));
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

    public function store(DetailUserRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data["photo"] = $this->service->store($request);

        $this->detailuser->store($data);

        flash()->success('Berhasil Menambahkan data.');
        return to_route('detailuser.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(detailuser $diary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailuser $diary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailUSerRequest $request, detailuser $detailuser)
    {
        $data['user_id'] = Auth::id();

        $data = $request->validated();
        $data["photo"] = $this->service->update($request, $detailuser);

        $this->detailuser->update($detailuser->id, $data);

        flash()->success('Profil berhasil diperbarui.');
        return to_route('detailuser.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailuser $detailuser)
    {
        // if (!$this->detailuser->delete($detailuser->id)) {

        //     return back()->with('error');
        // }

        // return back();
    }
}

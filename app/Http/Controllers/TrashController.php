<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TrashInterface;
use App\Models\Trash;
use App\Services\TrashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class TrashController extends Controller
{

    private TrashInterface $Trash;
    private TrashService $service;

    public function __construct(TrashInterface $Trash, TrashService $service)
    {
        $this->Trash = $Trash;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $trash = $this->Trash->getByUserId($auth->id);
        $authtrash = $this->Trash->getAuthTrash($auth->id);
        $trashedDiaries = $this->Trash->getTrashedDiaries($auth->id);

        $service = $this->service;

        return view('trash.trash', compact('auth', 'trash', 'authtrash', 'trashedDiaries', 'service'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trash $trash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trash $trash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trash $trash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trash $trash)
    {
        //
    }

    public function restore($id)
    {
        $this->Trash->restore($id);

        flash()->success('Data berhasil dipulihkan!');
        return redirect()->route('trash.index');
    }

    public function forceDelete($id)
    {
        $this->Trash->forceDelete($id);

        flash()->success('Data berhasil Dihapus permanen!');
        return redirect()->route('trash.index');
    }

    /**
     * Display a listing of soft-deleted resources.
     */
}

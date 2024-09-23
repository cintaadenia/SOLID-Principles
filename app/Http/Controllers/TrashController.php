<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TrashInterface;
use App\Contracts\Repositories\TrashRepository;
use App\Models\Diary;
use App\Models\Trash;
use App\Services\TrashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class TrashController extends Controller
{

    private TrashInterface $Trash;
    private TrashService $service;
    private TrashRepository $diaryRepository;


    public function __construct(TrashInterface $Trash, TrashService $service, TrashRepository $diaryRepository)
    {
        $this->Trash = $Trash;
        $this->service = $service;
        $this->diaryRepository = $diaryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authtrash = $this->diaryRepository->where(Auth::user()->id);
        $auth = Auth::user();
        $trash=$this->diaryRepository->where($auth->id)->get();

        $trashedDiaries = $this->diaryRepository->getTrashedDiaries($auth->id);

        return view('trash.trash', compact('trashedDiaries', 'authtrash', 'auth', 'trash'));
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

    }


    public function restore($id)
    {
        $this->diaryRepository->restore($id);

        flash()->success('Data berhasil dipulihkan!');
        return redirect()->route('trash.index');
    }

    public function forceDelete($id)
    {
        $this->diaryRepository->forceDelete($id);

        flash()->success('Data berhasil Dihapus permanen!');
        return redirect()->route('trash.index');
    }

    /**
 * Display a listing of soft-deleted resources.
 */

}

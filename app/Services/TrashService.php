<?php

namespace App\Services;

use App\Models\Diary;

class TrashService
{
    // public function trash()
    // {
    //     $deletediary = Diary::onlyTrashed()->get();
    //     return view('trash.trash', compact('deletediary'));
    // }

    // public function restore($id = null)
    // {
    //     if($id != null ){
    //         $deletediary = Diary::onlyTrashed()
    //         ->where('id', $id)
    //         ->restore();
    //     } else {
    //         $deletediary = Diary::onlyTrashed()->restore();
    //     }
    // }

    // public function delete($id = null)
    // {
    //     if($id != null ){
    //         $deletediary = Diary::onlyTrashed()
    //         ->where('id', $id)
    //         ->forceDelete();
    //     } else {
    //         $deletediary = Diary::onlyTrashed()->forceDelete();
    //     }
    // }
}

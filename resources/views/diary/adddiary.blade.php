@extends('kerangka.master')
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambahkan Diary</h3>
            <p class="text-subtitle text-muted">Simpan Kenangan anda disini.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        {{-- <div class="card-header">
            <h4 class="card-title">Basic Inputs</h4>
        </div> --}}

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Judul</label>
                        <input type="text" class="form-control" id="basicInput" placeholder="Silahkan masukkan judul" name="title">
                    </div>

                    <div>
                        <label for="formFileLg" class="form-label">Photo</label>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo">
                    </div>
                </div>


                <div class="col-md-6">
                    <section class="section">
                        <div class="row">
                            <div class="col-12">
                                {{-- <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Deskripsi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="summernote"></div>
                                    </div>
                                </div> --}}
                                <label for="roundText">Deskripsi</label>
                                <textarea id="roundText" class="form-control round" placeholder="Ekspresikan disini" name="desription"></textarea>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

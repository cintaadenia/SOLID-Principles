@extends('kerangka.master')
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Upload Foto</h3>
            <p class="text-subtitle text-muted">Simpan Kenangan anda disini.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <label for="formFileLg" class="form-label">Upload Foto</label>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo[]" multiple>
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill">Upload</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

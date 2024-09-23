@extends('kerangka.master')

@section('style')
<!-- include libraries(jQuery, bootstrap) -->

<link rel="stylesheet" href="{{asset ('template/assets/extensions/summernote/summernote-lite.css') }}">
<link rel="stylesheet" crossorigin href="{{asset ('template/assets/compiled/css/form-editor-summernote.css') }}">
@endsection

@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambhkan Note</h3>
            <p class="text-subtitle text-muted">Silahkan tambahkan notes</p>
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

                        <br>
                        <label for="roundText">Deskripsi</label>
                        <textarea id="roundText" class="form-control round" placeholder="Ekspresikan disini" name="desription"></textarea>

                    </div>


                    {{-- <section class="section">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Default Editor</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="summernote"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> --}}

                    {{-- <section class="section"> --}}
                        {{-- <div class="row"> --}}
                            {{-- <div class="col-12"> --}}
                                {{-- <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Deskripsi</h4>
                                    </div>
                                    <textarea name="description" id="custom-summernote" class="custom-summernote" aria-label="With textarea"></textarea>
                                </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                    {{-- </section> --}}

                    {{-- <div>
                    <label for="formFileLg" class="form-label">Photo</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo">
                </div> --}}
                </div>
                {{-- <div class="col-md-6">
                    <section class="section">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Deskripsi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="summernote"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div> --}}
                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<!-- include summernote css/js -->
<script src="{{asset ('template/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
<script src="{{asset ('template/assets/static/js/pages/summernote.js') }}"></script>
{{-- <script>
    $(document).ready(function() {
        $('#custom-summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['insert', ['link', 'picture']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ],
        });
    });
</script> --}}
@endsection


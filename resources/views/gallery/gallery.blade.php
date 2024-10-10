@extends('kerangka.master')
@section('content')
    <style>
        .card-img-wrapper {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            opacity: 0;
            transition: opacity 0.3s ease;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .card-img-wrapper:hover .overlay {
            opacity: 1;
        }

        .edit-icon,
        .delete-icon {
            color: #fff;
            font-size: 1.3rem;
            margin-left: 10px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .edit-icon:hover {
            color: #ffcc00;
        }

        .delete-icon:hover {
            color: #ff0000;
        }
    </style>

    {{-- MODAL ADD --}}
    <div class="modal fade text-left w-100" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Upload Foto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <label for="formFileLg" class="form-label">Upload Foto</label>
                                        <input class="form-control form-control-lg" id="formFileLg" type="file"
                                            name="photo">
                                        @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Galeri Anda</h3>
                <p class="text-subtitle text-muted">Simpan Kenangan anda disini.</p>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: flex-end;">
        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#defaultSize">
            <i class="fa-solid fa-plus"></i> Tambah
        </button>
    </div>

    <br>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Semua Foto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery row">
                            @forelse ($gallery as $gallery)
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <div class="card-img-wrapper d-flex" style="position: relative;">
                                        <a href="#">
                                            <img class="w-100 active" src="{{ asset('storage/' . $gallery->photo) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0"
                                                style="display: block; height: auto;">
                                        </a>
                                        <div class="overlay">
                                            <i class="fa-solid fa-edit edit-icon" data-id="{{ $gallery->id }}"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $gallery->id }}"></i>

                                            <form id="deleteForm-{{ $gallery->id }}"
                                                action="{{ route('gallery.destroy', $gallery->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-link p-0 text-decoration-none delete-btn"
                                                    style="background: none; border: none;" data-id="{{ $gallery->id }}">
                                                    <i class="fa-solid fa-trash delete-icon"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="card-link">
                                        <small
                                            style="color: #435ebe">{{ Carbon\Carbon::parse($gallery->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        </small>
                                    </div>
                                </div>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade text-left w-100" id="editModal{{ $gallery->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="editModalLabel">Update Foto</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form action="{{ route('gallery.update', $gallery->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div>
                                                                    @if ($gallery->photo)
                                                                        <img src="{{ asset('storage/' . $gallery->photo) }}"
                                                                            alt="Current Photo" class="img-fluid mb-2"
                                                                            style="max-width: 450px;">
                                                                    @endif
                                                                    <div class="mb-3">
                                                                        <label for="photo" class="form-label">Update
                                                                            foto</label>
                                                                        <input class="form-control form-control-lg"
                                                                            id="photo" type="file"
                                                                            name="photo_update">
                                                                        @error('photo_update')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-sm-12 d-flex justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary rounded-pill">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 d-flex flex-column align-items-center">
                                    <img src="{{ asset('img/No data-amico.png') }}" alt="kosong"
                                        style="width: 200px; height: 200px;">
                                    <h5 class="text-center" style="color: #000000">Upss..</h5>
                                    <p class="text-center" style="color: #000000">Maaf, anda masih belum menambahkan data
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.edit-icon').forEach(icon => {
                    icon.addEventListener('click', function() {
                        const galleryId = this.dataset.id;
                        fetch(`/gallery/${galleryId}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('currentPhoto').src =
                                    `/storage/${data.photo}`;
                            });
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const galleryId = this.dataset.id;
                        Swal.fire({
                            title: 'Apa kamu yakin?',
                            text: "Kamu tidak dapat mengembalikannya!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: 'File Anda telah dihapus.',
                                    icon: 'success'
                                }).then(() => {
                                    document.getElementById(`deleteForm-${galleryId}`)
                                        .submit();
                                });
                            }
                        });
                    });
                });
            });
        </script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endsection

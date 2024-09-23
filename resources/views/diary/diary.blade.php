@extends('kerangka.master')
@section('content')
    <style>
        .card-img-wrapper {
            position: relative;
            height: 20rem;
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
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Tambahkan catatan anda hari ini</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('diary.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="basicInput">Judul</label>
                                        <input type="text" class="form-control" id="basicInput"
                                            placeholder="Silahkan masukkan judul" name="title">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="formFileLg" class="form-label">Upload Foto</label>
                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo">
                                        @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div>
                                        <section class="section">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="roundText">Deskripsi</label>
                                                    <textarea id="roundText" class="form-control round" placeholder="Ekspresikan disini" name="description"></textarea>
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </section>
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
                <h3>Diary</h3>
                <p class="text-subtitle text-muted">Tuliskan suasana hati anda hari ini</p>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: flex-end;">
        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#xlarge">
            <i class="fa-solid fa-plus"></i> Tambah
        </button>
    </div>
    <br>
    <br>

    <div class="row">
        @forelse($diaries as $diary)
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-img-wrapper" style="position: relative; height: 20rem;">
                            <img class="card-img-top img-fluid" src="{{ asset('storage/' . $diary->photo) }}"
                                alt="Diary Image" style="height: 100%; width: 100%; object-fit: cover;">

                            <div class="overlay">
                                <i class="fa-solid fa-edit edit-icon" data-id="{{ $diary->id }}" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $diary->id }}"></i>

                                <form action="{{ route('diary.destroy', $diary->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-decoration-none"
                                        style="background: none; border: none;">
                                        <i class="fa-solid fa-trash delete-icon"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">{{ $diary->title }}</h4>
                                <form action="{{ route('favorite.update', $diary->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-link p-2 m-1 text-decoration-none">
                                        <i class="bi bi-star d-flex align-items-center justify-content-center text-secondary"></i>
                                    </button>
                                </form>
                            </div>

                            <p class="card-text"> {{ $diary->description }}</p>
                            <div class="card-link">
                                <small
                                    style="color: #435ebe">{{ Carbon\Carbon::parse($diary->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL EDIT --}}
            <div class="modal fade text-left w-100" id="editModal{{ $diary->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel">Edit Diary Anda</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <form action="{{ route('diary.update', $diary->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Judul</label>
                                                <input type="text" class="form-control" id="title"
                                                    name="title_update" placeholder="Silahkan masukkan judul"
                                                    value="{{ old('title_update', $diary->title) }}">
                                                @error('title_update')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                @if ($diary->photo)
                                                    <img src="{{ asset('storage/' . $diary->photo) }}"
                                                        alt="Current Photo" class="img-fluid mb-2"
                                                        style="max-width: 450px;">
                                                @endif
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Update foto</label>
                                                    <input class="form-control form-control-lg" id="photo" type="file" name="photo_update">
                                                    @error('photo_update')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div>
                                                <section class="section">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="description">Deskripsi</label>
                                                            <textarea id="description" class="form-control round" placeholder="Ekspresikan disini" name="description_update">{{ old('description_update', $diary->description) }}</textarea>
                                                            @error('description_update')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
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
        @empty
        <div class="col-lg-12 d-flex flex-column align-items-center">
            <img src="{{ asset('img/No data-amico.png') }}" alt="kosong"
                style="width: 200px; height: 200px;">
            <h5 class="text-center" style="color: #000000">Upss..</h5>
            <p class="text-center" style="color: #000000">Maaf, anda masih belum menambahkan data</p>
        </div>
        @endforelse
    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const diaryId = this.dataset.id;

                    fetch(`/diary/${diaryId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('currentPhoto').src =
                                `/storage/${data.photo}`;
                            document.getElementById('title').value = data.title;
                            document.getElementById('description').textContent = data
                                .description;
                        });
                });
            });
        });
    </script>
@endsection

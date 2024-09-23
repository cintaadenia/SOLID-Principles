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

    <div class="row">
        @forelse($addFavorite as $diary)
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-img-wrapper" style="position: relative; height: 20rem;">
                            <img class="card-img-top img-fluid" src="{{ asset('storage/' . $diary->diary->photo) }}"
                                alt="Diary Image" style="height: 100%; width: 100%; object-fit: cover;">

                            <div class="overlay">
                                <form action="{{ route('favorite.destroy', $diary->id) }}" method="POST"
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
                            <h4 class="card-title">{{ $diary->diary->title }}</h4>
                            <p class="card-text"> {{ $diary->diary->description }}</p>
                            <div class="card-link">
                                <small
                                    style="color: #435ebe">{{ Carbon\Carbon::parse($diary->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12 d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
                <img src="{{ asset('img/No data-amico.png') }}" alt="kosong" style="width: 200px; height: 200px;">
                <h5 class="text-center" style="color: #000000">Upss..</h5>
                <p class="text-center" style="color: #000000">Tidak ada daftar favorit</p>
            </div>
        @endforelse
    </div>
@endsection

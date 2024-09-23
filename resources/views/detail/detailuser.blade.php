@extends('kerangka.master')
@section('content')
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .align-right {}

        .action-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .action-container a,
        .action-container form {
            margin-left: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Profil</h3>
                    <p class="text-subtitle text-muted">Lengkapi Detail informasi diri anda</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    @isset($detailuser->photo)
                                        <img src="{{ asset('storage/' . $detailuser->photo) }}" alt="No picture">
                                    @endisset
                                </div>
                                @isset($detailuser)
                                    <h3 class="mt-3">{{ $detailuser->user->name }}</h3>
                                    <p class="text-small">{{ $detailuser->user->email }}</p>
                                @endisset
                            </div>
                            <div class="container">
                                <h6 class="align-right">
                                    @isset($detailuser->gender)
                                        <i class="fa-solid fa-genderless"></i> {{ $detailuser->gender }}
                                    @endisset
                                </h6>
                                <h6 class="align-right">
                                    @isset($detailuser->birthday)
                                        <i class="fas fa-birthday-cake"></i>
                                        {{ \Carbon\Carbon::parse($detailuser->birthday)->format('d M Y') }}
                                    @endisset
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-8">
                    <div class="card">
                        <form
                            action="{{ isset($detailuser) ? route('detailuser.update', $detailuser->id) : route('detailuser.store') }}"
                            method="POST" id="food" enctype="multipart/form-data">
                            @csrf
                            @if (isset($detailuser))
                                @method('PUT')
                            @endif
                            <div class="card-header">
                                <h5 class="card-title"> <span
                                        class="emoji"></span>{{ isset($detailuser) ? 'Perbarui' : 'Buat' }} Profil</h5>
                                <p style="color: #435ebe">Silahkan isi dengan data yang lengkap.</p>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="contact-info-horizontal-icon">Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="date" class="form-control" placeholder="Birthday"
                                                            id="contact-info-horizontal-icon" name="birthday"
                                                            value="{{ old('birthday', isset($detailuser->birthday) ? $detailuser->birthday : '') }}">
                                                        <div class="form-control-icon">
                                                            <i class="fa-solid fa-cake-candles"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="gender">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <select class="form-control" id="gender" name="gender">
                                                            <option value="" selected disabled>Jenis Kelamin</option>
                                                            <option value="Laki-laki"
                                                                {{ old('gender', isset($detailuser->gender) ? $detailuser->gender : '') == 'Laki-laki' ? 'selected' : '' }}>
                                                                Laki-Laki</option>
                                                            <option value="Perempuan"
                                                                {{ old('gender', isset($detailuser->gender) ? $detailuser->gender : '') == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="fa-solid fa-genderless"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="photo">Foto</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary rounded-pill">{{ isset($detailuser) ? 'Perbarui Profil' : 'Buat Profil' }}</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary rounded-pill">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

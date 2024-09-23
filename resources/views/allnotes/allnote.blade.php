@extends('kerangka.master')
@section('content')
    {{-- NOTES --}}
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Semua catatan</h3>
                <p class="text-subtitle text-muted">Semua catatan anda</p>
            </div>
        </div>
    </div>
    <div class="row match-height">

        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{ asset('template/assets/images/samples/building.jpg') }}"
                        alt="Card image cap" style="height: 20rem" />
                    <div class="card-body">
                        <h4 class="card-title">Social Media</h4>
                        <p class="card-text">
                            Candy Cupcake sugar plum oat cake wafer marzipan jujubes.
                            Jelly-o sesame snaps cheesecake topping. Cupcake fruitcake macaroon donut pastry gummies
                            tiramisu chocolate bar muffin.
                        </p>
                        <div class="card-link">
                            <small>Tanggal</small>
                        </div>
                    </div>
                    <div class="btn-group align-items-center mx-2 px-1">
                        <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                            <i class="bi bi-star d-flex align-items-center justify-content-center text-secondary"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

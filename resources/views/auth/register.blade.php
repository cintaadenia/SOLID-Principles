@extends('auth.layouts.layout')

@section('title', 'Register | QuillPad')

@section('content')
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <img src="{{ asset('img/avatarsaya.png') }}" alt="Avatar">
        <h2 class="title">Register</h2>

        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Username</h5>
                <input type="text" class="input" name="name" id="name" @error('name') is-invalid @enderror>
            </div>
        </div>
        @error('name')
            <small class="input" style="color: red">{{ $message }}</small>
        @enderror

        <div class="input-div pass">
            <div class="i">
                <i class="far fa-envelope"></i>
            </div>
            <div class="div">
                <h5>Email</h5>
                <input type="email" class="input" name="email" id="email" @error('email') is-invalid @enderror>
            </div>
        </div>
        @error('email')
            <small class="input" style="color: red">{{ $message }}</small>
        @enderror

        <div class="input-div pass">
            <div class="i">
                <i class="fas fa-lock"></i>
            </div>
            <div class="div">
                <h5>Password</h5>
                <input type="password" class="input" name="password" id="password"
                    @error('password') is-invalid @enderror>
            </div>
        </div>
        @error('password')
            <small class="input" style="color: red">{{ $message }}</small>
        @enderror

        <br>
        <p class="text-center">
            <span class="align-text">Sudah punya Akun ?</span>
            <a href="{{ route('login') }}" class="align-text">Masuk disini!</a>
        </p>
        <input type="submit" class="btn" value="Daftar">
    </form>
@endsection

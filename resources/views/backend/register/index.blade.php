@extends('backend.layout.login')
@section('judul','Register')
@section('content')

<header class="header">
    <h1 class="title">FlipBook</h1>
    <a href="#" class="sign-in">Sign In</a>
</header>

<div class="register-page">
    <div class="register-box">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <h2>Register</h2>
        <form class="form" method="post" action="{{route('register.index')}}">
            @csrf
            @if(session()->has('pesan'))
                <div class="alert alert-{{session()->get('pesan')[0]}}">
                    {{session()->get('pesan')[1]}}
                </div>
            @endif
            <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="string" name="name" placeholder="Name" required>
            </div>
            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="options">
                <label><input type="checkbox">I Agree to the terms & conditions</label>
            </div>
            <button type="submit" class="register-btn">Registrasi</button>
        </form>
        <p class="register">Already have an account? <a href="/login">Login</a></p>
    </div>
</div>

<div class="close-icon">
    <button aria-label="Close">
        &#8592;
    </button>
</div>

<script>
    document.querySelector('.close-btn').addEventListener('click', () => {
        document.querySelector('.login-page').style.display = 'none';
    });
</script>

@endsection

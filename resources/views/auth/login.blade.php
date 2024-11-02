@extends('backend.layout.login')
@section('judul', 'Login')
@section('content')

{{--    <header class="header">--}}
{{--        <h1 class="title">FlipBook</h1>--}}
{{--        <a href="#" class="sign-in">Sign In</a>--}}
{{--    </header>--}}

    <div class="login-page">
        <div class="login-box">
{{--            <div class="close-btn">--}}
{{--                <i class="fas fa-times"></i>--}}
{{--            </div>--}}
            <h2>Login</h2>
            <form class="form" style="text-align: center;" method="post" action="{{ route('auth.verify') }}">
                @csrf
                @if(session()->has('pesan'))
                    <div class="alert alert-{{ session()->get('pesan')[0] }}">
                        {{ session()->get('pesan')[1] }}
                    </div>
                @endif
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="{{ route('password.request') }}">Forget Password</a>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <p class="register">Don’t have an account? <a href="{{ route('register.index') }}">Registrasi</a></p>
        </div>
    </div>

{{--    <div class="close-icon">--}}
{{--        <button aria-label="Close">--}}
{{--            &#8592;--}}
{{--        </button>--}}
{{--    </div>--}}

    <script>
        document.querySelector('.close-btn').addEventListener('click', () => {
            document.querySelector('.login-page').style.display = 'none';
        });
    </script>

@endsection

@extends('backend.layout.login')

@section('title', 'Reset Password')

@section('content')
    <h2 class="text-2xl font-bold text-center mb-6">Reset Your Password</h2>
    <form action="{{ route('password.update', ['token' => $email]) }}" method="POST">
        @csrf
        <div class="text-sm text-gray-500 text-center mb-4">
            @if (session('pesan'))
                <span class="inline-block bg-{{ session('pesan')[0] }}-100 text-{{ session('pesan')[0] }}-700 rounded text-center">{{ session('pesan')[1] }}</span>
            @endif
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-4 relative">
            <span class="absolute left-3 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <input type="password" name="password" placeholder="New Password (min 6)" class="auth-input" required minlength="6">
        </div>
        <div class="mb-4 relative">
            <span class="absolute left-3 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm New Password" class="auth-input" required autocomplete="new-password">
        </div>
        <button type="submit" class="auth-button mb-4">
            Reset Password
        </button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('auth.verify') }}" class="auth-link">Back to Login</a>
    </div>
@endsection

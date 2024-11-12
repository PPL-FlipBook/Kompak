@extends('backend.layout.login')

@section('title', 'Forgot Password')

@section('content')
    <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="text-sm text-gray-500 text-center mb-4">
            @if (session('pesan'))
                <span class="inline-block bg-{{ session('pesan')[0] }}-100 text-{{ session('pesan')[0] }}-700 rounded text-center">{{ session('pesan')[1] }}</span>
            @endif
        </div>
        <div class="mb-4 relative">
            <span class="absolute left-3 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
            </span>
            <input type="email" name="email" placeholder="Enter your email" class="auth-input" required>
        </div>
        <button type="submit" class="auth-button mb-4">Send Reset Link</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('auth.verify') }}" class="auth-link">Back to login</a>
    </div>
@endsection

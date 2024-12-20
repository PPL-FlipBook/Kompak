<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('user')->user();

            // Check if the user is active
            if (!$user->is_active) {
                Auth::guard('user')->logout();
                return redirect()->route('auth.index')->with('pesan', ['danger', 'Akun belum diaktivasi. Silakan cek email Anda untuk aktivasi akun.']);
            }
            Auth::login($user);
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('auth.index')->with('pesan', ['danger', 'Kombinasi Email dan Password salah']);
        }
    }

    public function register()
    {
        return view('backend.register.index');
    }

    public function registerProceed(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password tidak boleh kosong.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return back()->with('pesan', ['danger', 'Email sudah terdaftar.']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = 0;
        $user->token_activation = Str::random(60);
        $user->save();

        Mail::to($user->email)->queue(new RegisterMail($user));
        return redirect('/login')->with('pesan', ['success', 'Registrasi Berhasil, cek email anda untuk aktivasi']);
    }

    public function registerVerify($token)
    {
        $user = User::where('token_activation', $token)->first();
        if (!$user) {
            return redirect('/login')->with('pesan', ['danger', 'Token tidak ditemukan']);
        }
        $user->token_activation = null;
        $user->is_active = 1;
        $user->save();
        return redirect('/login')->with('pesan', ['success', 'Aktivasi Berhasil, anda sudah bisa login']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword');
    }

    public function resetPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('pesan', ['success', 'Link reset password sudah terkirim ke email anda.']);
        } else {
            return back()->with('pesan', ['danger', 'Email tidak ditemukan.']);
        }
    }

    public function showResetPasswordForm($token, Request $request)
    {
        $email = $request->email;
        return view('auth.reset_password_confirmation', ['token' => $token, 'email' => $email]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.index')->with('pesan', ['success', 'Password berhasil diperbarui.'])
            : back()->with('pesan', ['danger', 'Token reset tidak valid.']);
    }
}

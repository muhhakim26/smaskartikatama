<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AutentikasiController extends Controller
{
    public function loginFormPage()
    {
        return view('auth/login');
    }

    public function loginForm(Request $request)
    {
        $credentials = $request->validateWithBag('login', [
            'surel' => ['required', 'string', 'email:rfc,dns'],
            'kata-sandi' => ['required', 'string'],
        ]);

        $key = Str::transliterate(Str::lower($request->input('surel')) . '|' . $request->ip());
        $maxAttemps = 3;

        if (RateLimiter::retriesLeft($key, $maxAttemps) !== 0 && RateLimiter::availableIn($key) === 0) {
            $kredensial = [
                'email' => $credentials['surel'],
                'password' => $credentials['kata-sandi'],
            ];
            if (Auth::guard('admin')->attempt($kredensial)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        }
        // Menambah hitungan percobaan yang dilakukan.
        RateLimiter::hit($key, 120);
        // Memeriksa jumlah percobaan yang dilakukan.
        if (RateLimiter::tooManyAttempts($key, $maxAttemps)) {
            event(new Lockout($request));
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'status' => 'terlalu banyak percobaan login. silakan coba lagi dalam ' . Carbon::now()->addSeconds($seconds)->diffForHumans(['parts' => 2]) . '.',
            ]);
        }

        return back()->with(['message' => 'email atau password salah', 'status' => 'tersisa ' . RateLimiter::retriesLeft($key, $maxAttemps) . ' percobaan login'])->withErrors($credentials)->onlyInput('surel');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($request->ajax()) {
            return response()->json(['status' => 'redirect', 'url' => route('admin.login')]);
        }
        return redirect()->route('admin.login');
    }

    public function changePasswordPage()
    {
        return view('auth/change-password');
    }

    public function changePassword(Request $request, string $id)
    {
        $rules = [
            'kata-sandi-lama' => ['required', 'string', 'max:255'],
            'kata-sandi-baru' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'max:255'],
            'kata-sandi-baru_confirmation' => ['required', 'string', 'max:255'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah kata sandi.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        $admin = auth()->user();

        if (!Hash::check($validated['kata-sandi-lama'], $admin->password)) {
            return response()->json(['status' => false, 'errors' => ['message' => ['Terjadi kesalahan kata sandi lama tidak cocok']]]);
        }
        $data = [
            'password' => bcrypt($validated['kata-sandi-baru']),
        ];
        Admin::where('id', $admin->id)->update($data);
        return redirect()->route('profil')->with(['message' => 'sukses mengubah kata sandi.', 'isActive' => true, 'hasError' => false]);
    }
}
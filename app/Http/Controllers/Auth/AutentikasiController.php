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
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'nisn';
        $data = [
            'login' => ['required', 'string'],
            'kata-sandi' => ['required', 'string'],
        ];
        $validated = $request->validateWithBag('login', $data);

        $key = Str::transliterate(Str::lower($validated['login']) . '|' . $request->ip());
        $maxAttemps = 3;

        if (RateLimiter::retriesLeft($key, $maxAttemps) !== 0 && RateLimiter::availableIn($key) === 0) {
            $credentials = [
                $field => $validated['login'],
                'password' => $validated['kata-sandi'],
            ];
            if ($field === 'nisn') {
                if (Auth::guard('siswa')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended(route('siswa.dashboard'));
                }
            } else {
                if (Auth::guard('admin')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('dashboard');
                }
                if (Auth::guard('siswa')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended(route('siswa.dashboard'));
                }
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

        return back()->with(['message' => 'identitas pengguna tidak dikenali. silakan periksa kembali.', 'status' => 'tersisa ' . RateLimiter::retriesLeft($key, $maxAttemps) . ' percobaan login'])->withErrors($credentials)->onlyInput('surel');
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
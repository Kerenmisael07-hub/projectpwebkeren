<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function __invoke(Request $request, int $id, string $hash): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Tautan verifikasi tidak valid atau sudah kedaluwarsa.');
        }

        $user = User::findOrFail($id);

        if (! hash_equals($hash, sha1($user->email))) {
            abort(403, 'Tautan verifikasi tidak valid.');
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login ke akunmu.');
    }
}
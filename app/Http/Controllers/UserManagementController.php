<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Simpan user baru dari modal form di halaman Manajemen User.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
            'role'       => 'required|in:admin,anggota',
            'nip'        => 'nullable|string|max:30',
            'unit_kerja' => 'nullable|string|max:100',
        ]);

        User::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'password'         => Hash::make($validated['password']),
            'role'             => $validated['role'],
            'nip'              => $validated['nip'] ?? null,
            'unit_kerja'       => $validated['unit_kerja'] ?? null,
            'email_verified_at'=> now(),
        ]);

        return redirect('/dashboards/users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Hapus user dari modal konfirmasi di halaman Manajemen User.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect('/dashboards/users')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect('/dashboards/users')
            ->with('deleted', 'User berhasil dihapus.');
    }
}

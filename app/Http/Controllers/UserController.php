<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Form tambah user.
     */
    public function create()
    {
        $roles = [
            User::ROLE_ADMIN         => 'Admin',
            User::ROLE_KEPALA_GUDANG => 'Kepala Gudang',
            User::ROLE_TEKNISI       => 'Teknisi',
            User::ROLE_HELPER        => 'Helper',
        ];

        return view('users.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $roles = [
            User::ROLE_ADMIN,
            User::ROLE_KEPALA_GUDANG,
            User::ROLE_TEKNISI,
            User::ROLE_HELPER,
        ];

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role'     => ['required', Rule::in($roles)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with([
            'type'    => 'success',
            'message' => 'User berhasil ditambahkan.',
        ]);
    }


    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        $roles = [
            User::ROLE_ADMIN         => 'Admin',
            User::ROLE_KEPALA_GUDANG => 'Kepala Gudang',
            User::ROLE_TEKNISI       => 'Teknisi',
            User::ROLE_HELPER        => 'Helper',
        ];

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, User $user)
    {
        $roles = array_keys([
            User::ROLE_ADMIN,
            User::ROLE_KEPALA_GUDANG,
            User::ROLE_TEKNISI,
            User::ROLE_HELPER,
        ]);

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'role'     => ['required', Rule::in($roles)],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with([
            'type'    => 'info',
            'message' => 'User berhasil diperbarui.',
        ]);
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with([
            'type'    => 'error',
            'message' => 'User berhasil dihapus.',
        ]);
    }
}

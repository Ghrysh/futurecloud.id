<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // 1. List User
    public function index(Request $request)
    {
        $query = User::query();

        // Fitur Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // 2. Form Edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 3. Update Data
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'nullable|string|unique:users,username,'.$id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|min:8', // Password opsional
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Hanya update password jika diisi admin
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    // 4. Ban / Unban User
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        
        // Toggle status (Jika 0 jadi 1, jika 1 jadi 0)
        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'dibanned' : 'diaktifkan kembali';
        
        return back()->with('success', "User berhasil $status.");
    }

    // 5. Hapus User (Optional, hati-hati karena ada relasi order)
    public function destroy($id)
    {
        // Sebaiknya jangan hapus user yg sudah punya transaksi, cukup di-ban.
        // Tapi jika ingin fitur hapus, gunakan ini:
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User dihapus permanen.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HelpdeskManageController extends Controller
{
    /**
     * List helpdesk users for the authenticated client
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $licenseKey = $request->query('license');

        if (!$licenseKey) {
            return response()->json(['error' => 'License key required'], 400);
        }

        $helpdeskUsers = HelpdeskUser::where('user_id', $user->id)
            ->where('license_key', $licenseKey)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $helpdeskUsers]);
    }

    /**
     * Create a new helpdesk user
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        // Check duplicate email within same license
        $exists = HelpdeskUser::where('license_key', $request->license_key)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Email sudah digunakan untuk helpdesk di lisensi ini.'], 422);
        }

        $helpdesk = HelpdeskUser::create([
            'user_id' => $user->id,
            'license_key' => $request->license_key,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Auto hashed by cast
        ]);

        return response()->json(['success' => true, 'data' => $helpdesk]);
    }

    /**
     * Update helpdesk user
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $helpdesk = HelpdeskUser::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
        ]);

        // Check duplicate email (exclude self)
        $exists = HelpdeskUser::where('license_key', $helpdesk->license_key)
            ->where('email', $request->email)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Email sudah digunakan.'], 422);
        }

        $helpdesk->name = $request->name;
        $helpdesk->email = $request->email;

        if ($request->filled('password')) {
            $helpdesk->password = $request->password;
        }

        $helpdesk->save();

        return response()->json(['success' => true, 'data' => $helpdesk]);
    }

    /**
     * Delete helpdesk user
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $helpdesk = HelpdeskUser::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $helpdesk->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Toggle active/inactive
     */
    public function toggleStatus($id)
    {
        $user = auth()->user();
        $helpdesk = HelpdeskUser::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $helpdesk->is_active = !$helpdesk->is_active;
        $helpdesk->save();

        return response()->json(['success' => true, 'is_active' => $helpdesk->is_active]);
    }
}

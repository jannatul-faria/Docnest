<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Enums\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by Name or Email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by Role
        if ($request->filled('role')) {
            $role = $request->input('role');
            $query->role($role);
        }

        $users = $query->with('roles')->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = UserRoleEnum::cases();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [
                'required',
                Rule::in(array_column(UserRoleEnum::cases(), 'value')),
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // Assign role
            $user->assignRole($validated['role']);
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = UserRoleEnum::cases();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => [
                'required',
                Rule::in(array_column(UserRoleEnum::cases(), 'value')),
            ],
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Sync role (Spatie method)
            $user->syncRoles([$validated['role']]);

            // If user has a doctor profile, keep the doctor email/name synchronized
            $doctor = Doctor::where('user_id', $user->id)->first();
            if ($doctor) {
                $doctor->update([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                ]);
            }
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete yourself.');
        }

        DB::transaction(function () use ($user) {
            // Delete associated doctor profile if any
            $doctor = Doctor::where('user_id', $user->id)->first();
            if ($doctor) {
                $doctor->delete();
            }

            // Wishlists will be cascade deleted if foreign key cascade is set,
            // otherwise delete them manually.
            $user->wishlists()->delete();

            // Finally delete the user
            $user->delete();
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'User and associated data deleted successfully.');
    }
}

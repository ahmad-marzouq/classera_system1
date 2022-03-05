<?php

namespace App\Http\Controllers;

use App\Models\MainUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{

    public function addUser()
    {
        return view('admin.add-user');
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:main_users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);
        $user = MainUser::create([
            'id' => \Str::random(26),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        toast('User Added', 'success');
        return back();
    }

    public function syncUser()
    {
        $response = Http::asForm()->post(config('config.system2_host') . '/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('config.system2_client_id'),
            'client_secret' => config('config.system2_client_secret'),
            'scope' => '*',
        ]);
        $token = $response->json()['access_token'];

        $users = MainUser::all(['id', 'name', 'email', 'role']);
        $userGroups = $users->groupBy('role')->toArray();
        $response = Http::withToken($token)->asJson()->acceptJson()
            ->post(config('config.system2_host') . '/api/sync-user', [
                    'admins' => $userGroups['admin'] ?? [],
                    'users' => $userGroups['user'] ?? []
                ]
            );
        toast('User Synced', 'success');
        return back();
    }
}

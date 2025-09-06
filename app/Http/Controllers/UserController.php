<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            UserRepository::store($request->validated());   
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil disimpan');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            UserRepository::update($user, $request->validated());
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil disimpan');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            UserRepository::delete($user);
            return redirect()->route('users.index')->with('success', 'Data pengguna berhasil dihapus');
        } catch (Exception $exception) {
            return redirect()->route('users.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update user password
     */
    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        try {
            UserRepository::update($user, $request->validated());
            return redirect()->route('users.index')->with('success', 'Password pengguna berhasil diubah');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

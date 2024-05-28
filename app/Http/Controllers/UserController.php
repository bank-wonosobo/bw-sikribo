<?php

namespace App\Http\Controllers;

use App\Exceptions\UserPasswordNotSame;
use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserChangePasswordRequest;
use App\Http\Requests\Users\UserCreatePasswordRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = User::paginate(20);

        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        $role = Role::all();
        return view('admin.users.create', compact('role'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            $user = $this->userService->add($request);
            return redirect()->route('admin.users.create')->with([
                'success' => 'User Berhasil dibuat',
                'password-show' => true,
                'user' => $user
            ]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function generatePassword($id)
    {
        try {
            $user = $this->userService->generatePassword($id);
            return redirect()->route('admin.users.index')->with([
                'success' => 'Password Berhasil dibuat',
                'password-show' => true,
                'user' => $user
            ]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function createPassword(UserCreatePasswordRequest $request, $id)
    {
        try {
            $this->userService->createPassword($request, $id);
            return redirect()->route('admin.users.index')->with([
                'success' => 'Password Berhasil dibuat',
            ]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function changePassword(UserChangePasswordRequest $request, $id)
    {
        try {
            $this->userService->changePassword($id, $request);
            return redirect()->route('admin.users.index')->with([
                'success' => 'Password Berhasil dibuat',
            ]);
        } catch (UserPasswordNotSame $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function edit($id) {
        $user = User::find($id);
        $role = Role::all();
        return view('admin.users.edit', compact('user', 'role'));
    }

    public function update($id, UserUpdateRequest $request) {
        try {
            $user = $this->userService->update($request, $id);
            return redirect()->route('admin.users.index')->with([
                'success' => 'User Berhasil diubah',
            ]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function delete($id) {
        try {
            $this->userService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
}

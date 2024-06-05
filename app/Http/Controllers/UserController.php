<?php

namespace App\Http\Controllers;

use App\Exceptions\UserPasswordNotSame;
use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserChangePasswordRequest;
use App\Http\Requests\Users\UserCreatePasswordRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Mail\AccountCredentialMail;
use App\Models\KodeSlik;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = User::all();

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
            return redirect()->back()->with('success', 'Password berhasil diubah');
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

    public function sendCredential(Request $request) {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $details = [
                'nama' => $nama,
                'email' => $email,
                'password' => $password
            ];

            Mail::to($email)->send(new AccountCredentialMail($details));

            return redirect()->back()->with('success', 'Berhasil Mengirim User Credential ');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function detail($id) {
        $kode = [
            "GRG" => "GRG - GARUNG",
            "WTM" => "WTM - WATUMALANG",
            "WSB" => "WSB - INDUK",
            "PST" => "PST - PUSAT",
            "KRT" => "KRT - KERTEK",
            "SPR" => "SPR - SAPURAN",
            "KPL" => "KPL - KEPIL",
            "SLM" => "SLM - SELOMERTO",
            "SKHJ" => "SKHJ - SUKOHARJO",
            "WDS" => "WDS - WADASLINTANG",
            "LKS" => "LKS - LEKSONO",
        ];

        $kode_slik = KodeSlik::where('user_id', $id)->first();

        $user = User::find($id);

        return view('admin.users.detail', compact('user', 'kode', 'kode_slik'));
    }

}

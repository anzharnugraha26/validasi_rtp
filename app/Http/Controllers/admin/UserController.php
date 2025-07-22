<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = User::orderBy('id' , 'desc')->get();
            return DataTables::of($data)
                ->addColumn('role_label', function ($data) {
                    return $data->role == 1 ? 'Admin' : 'User';
                })
                ->addColumn('actions', function ($data) {
                return '
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-success icon-btn btn-edit"
                                data-id="'.$data->id.'"
                            >
                               <i class="fas fa-pencil-alt text-white"></i>
                            </button>
                            <button class="btn btn-sm btn-danger  btn-delete  icon-btn"
                            data-id="'.$data->id.'"
                            >
                                <i class="fas fa-trash text-white"></i>
                            </button>
                        </div>
                        ';
                })
            ->rawColumns([ 'actions'])
            ->make(true);
        }
        return view('pages.admin.user');
    }

    public function store(Request $request){
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

         return response()->json([
            'message' => 'User berhasil disimpan.',
            'data' => $user
        ], 200);
    }

    public function storeCek(Request $request){
        $emailExists = User::where('email', $request->email)->exists();
        $usernameExists = User::where('username', $request->username)->exists();

        if ($emailExists) {
            return response()->json(['exists' => true, 'message' => 'Email sudah digunakan.']);
        }

        if ($usernameExists) {
            return response()->json(['exists' => true, 'message' => 'Username sudah digunakan.']);
        }

        return response()->json(['exists' => false]);
    }

    public function getUser($id){
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
                // Jangan kirim password atau token!
        ]);
    }

    public function update(Request $request){
        $id = $request->id;
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => [
                'required',
                'regex:/^\S*$/u', // Tidak boleh ada spasi
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => ['required', 'in:0,1'],
            'password' => ['nullable', 'min:6'],
        ]);

        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }

}

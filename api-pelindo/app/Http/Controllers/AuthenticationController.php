<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $users,
            ], 200);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_karyawan' => 'required|string|unique:users,nama_karyawan|alpha_dash',
            'nrp' => 'required|integer',
            'divisi' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            return $this->responseFailed('Error Validation', $validator->errors(), 400);
        }

        $user = User::create([
            'nama_karyawan' => $input['nama_karyawan'],
            'email' => $input['email'],
            'nrp' => $input['nrp'],
            'divisi' => $input['divisi'],
            'role_id' => $input['role_id'] ?? 1,
            'password' => bcrypt($input['password']),
        ]);
        /**
         * @enum karyawan | operator | manager
         */

        if (!empty($input['role_id'])) {
            $user->assignRole($input['role_id']);
        } else {
            $user->assignRole('karyawan');
        }

        $token = $user->createToken('token')->plainTextToken;
        $data = [
            'user' => User::where('id', $user->id)->with('roles')->first(),
            'token' => $token
        ];

        return $this->responseSuccess('Registration Successful', $data, 201);
    }

    public function login(Request $request)
    {
        $input = $request->only('nrp', 'password');
        if (!Auth::attempt($input)) {
            return $this->responseFailed('Unauthorized', '', 401);
        }

        try {
            $user = User::where('nrp', $input['nrp'])->with('roles')->first();
            $token = $user->createToken('token')->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token
            ];
            Auth::logoutOtherDevices($input['password']);
            return $this->responseSuccess('Login Successful', $data, 200);
        } catch (\Exception $e) {
            return $this->responseFailed('Internal Server Error', '', 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->responseSuccess('Logout Successfuly!', null, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

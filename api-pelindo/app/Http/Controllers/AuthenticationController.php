<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\Divisi;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::all();
        // return response()
        //     ->json([
        //         'status' => 'Success',
        //         'data' => $users,
        //     ], 200);
        // Get all query parameters
        $queryParams = $request->query();

        // Create a query builder object
        $query = User::query()->with('roles','divisi');

        $fillable = User::first()->getFillable();

        // Loop through all query parameters
        foreach ($queryParams as $key => $value) {
            // If the key exists in the fillable property, add a where clause to the query
            if (in_array($key, $fillable)) {
                $query->where($key, $value);
            }
        }

        // Get the filtered users
        $users = $query->get();

        // Return the filtered users as JSON
        return response()
            ->json([
                'status' => 'Success',
                'data' => $users,
            ], 200);
    }

    public function getListOperator()
    {
        $users = User::where('role_id', '=', 2)->get();
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
            'nama_karyawan' => 'required|string|unique:users,nama_karyawan',
            'nrp' => 'required|integer',
            'divisi_id' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            return $this->responseFailed('Error Validation', $validator->errors(), 400);
        }
        $divisiId = $request->input('divisi_id');
        $user = Divisi::find($divisiId);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Divisi not found!'
            ], 404);
        };

        $user = User::create([
            'nama_karyawan' => $input['nama_karyawan'],
            'email' => $input['email'],
            'nrp' => $input['nrp'],
            'divisi_id' => $input['divisi_id'],
            'password' => bcrypt($input['password']),
        ]);
        /**
         * @enum karyawan | operator | manager
         */

        if (!empty($input['role'])) {
            $user->assignRole($input['role']);
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

    public function roles()
    {
        $users_role = Role::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $users_role,
            ], 200);
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan' => 'string|unique:users,nama_karyawan',
            'nrp' => 'integer',
            'divisi_id' => 'string',
            'email' => 'string|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_user = User::find($id);
        if (!$data_user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_user->fill($request->all());
        $data_user->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        $user->delete();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $user,
            ], 200);
    }
}

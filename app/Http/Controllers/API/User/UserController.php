<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\{UserCreateRequest, UserUpdateRequest};
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\API\User\UserRepository;
use App\Models\User as UserModel;

class UserController extends Controller
{

    public function __construct(UserRepository $userRepository) {
        $this->middleware('is_auth')->only('update');
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->findAll();
        return response()->json(['data' => $users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->only('email', 'username', 'password');
        $data['password'] = Hash::make($request->password);
        $user = UserModel::create($data);
        $token = auth('api')->login($user);
        return response()->json(['token' => $token, 'user' => $user, 'message' => 'Account Created Successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        $user = $this->userRepository->findById($id);
        if(!$this->isOwner($id)) {
            return response()->json([
                'message' => 'Permission Denied',
            ], 403);
        }
        $user->update(["password" => Hash::make($request->password)]);
        return response()->json(['message' => 'password updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function isOwner($id) {
        return auth('api')->user()->id == $id;
    }
}

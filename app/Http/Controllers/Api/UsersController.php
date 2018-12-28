<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json(
            [
                'success' => true,
                'users' => $users->toArray()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->userName;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'user' => $user,
                'created' => true,
            ], 201);
        }
        return response()->json(['error' => $validator->errors()->all(), 'created' => false,]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request)
    {
        $validator = $request->validate([
            'userName' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$request->validated()){
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $user = new User();
        $user->name = $request->userName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'user' => $user,
            'message' => 'Success'
        ], 201);
        //return response()->json(['success'=> 'User Created'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try{
            $user->delete();
            return response()->json([
                'message' => 'User Deleted',
            ]);
        }catch (\Throwable $e){
            return response()->json([
                'error' => 'User Not Deleted',
            ]);
        }

    }
}

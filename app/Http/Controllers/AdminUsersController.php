<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    {   $password = Hash::make($request->password);
        $adminUser = new AdminUsers();
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->password = $password;
        $adminUser->save();

        $request->session()->put('sessionAdminUserId', $password);
        return redirect()->back()->with('status', 'register');
        
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUsers $adminUsers)
    {
        //
    }
    public function login(Request $request)
{
    $email = $request->email;
    $password = $request->password;
    $adminUser = \DB::table('admin_users')->where('email', $email)->get();

    // dd($adminUser);
    if (!empty($adminUser[0])) {
        if (Hash::check($password, $adminUser[0]->password)) {
            $request->session()->put('sessionAdminUserId', $adminUser[0]->password);
            $request->session()->save();    // This will actually store the value in session and it will be available then all over
            return redirect('/dashboard');
        } else {
            return Redirect::back()->withErrors(['password' => 'Sorry ! Your input password is wrong.']);
        }
    } else {
        return Redirect::back()->withErrors(['email' => 'Sorry ! Your input email is wrong']);
    }
}
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/user/list", 'name' => "Pengguna"], ['name' => "Daftar Pengguna"]
        ];

        $users = User::withCount('orders')->get();
        // dd($users);

        return view('/content/user/list', [
            'breadcrumbs' => $breadcrumbs,
            'users' => $users
        ]);
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
        //
    }

    public function profile()
    {
        //
        $loggedUserId = Auth::user()->id;
        $user = User::where('id', $loggedUserId)->first();

        return view('/content/user/profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $loggedUserId = Auth::user()->id;
        $user = User::find($loggedUserId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Selamat! Profil kamu sudah berhasil di update!');
    }
    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/profile/#account-vertical-password')->withInput()->withErrors($validator);
        }

        $loggedUserId = Auth::user()->id;
        $user = User::find($loggedUserId);

        if (Hash::check($request->password, $user->password)) {
            $hashed = Hash::make($request->new_password);
            $user->password = $hashed;
            $user->save();
            return redirect('/profile/#account-vertical-password')->with('success', 'Selamat! Password kamu sudah berhasil di update!');
        } else {
            return redirect('/profile/#account-vertical-password')->with('error', 'Maaf pasword lama kamu salah, coba ingat kembali!');
        }

        return redirect('/profile/#account-vertical-password')->with('error', 'Whoops! Ada yang tidak beres, silakan kontak admin!');
    }
}

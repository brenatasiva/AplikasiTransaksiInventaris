<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //code...
            if(Auth::user()->role != "Admin") return redirect()->back();
            $data = User::all();
            return view('user.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
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
        try {
            //code...
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->save();
            Alert::success('SUKSES', 'Berhasil Mengubah User');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Mengubah User');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            //code...
            $user->delete();
            Alert::success('SUKSES', 'Berhasil Menghapus User');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal Menghapus User');
            return back();
        }
    }

    public function showEditModal(Request $request)
    {
        try {
            //code...
            $id = $request->get('userId');
            $data = User::find($id);
            return response()->json(array(
                'msg' => view('user.modalEdit', compact('data'))->render()
            ), 200);
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }
}

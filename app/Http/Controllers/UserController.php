<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //halaman index
        $users         = User::all();
        $datapengguna  = 'active';
        $titlepage     = 'Data Pengguna';
        return view('user.index', compact('datapengguna', 'titlepage', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //form add
        $datapengguna  = 'active';
        $titlepage     = 'Data Pengguna';
        return view('user.create', compact('datapengguna', 'titlepage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            User::create($request->validated());

            return redirect()->back()->with(['success' => 'Data pengguna baru berhasil ditambahkan']);
        }

        catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Data telah ada. Silahkan dicek kembali']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //fomr edit
        $datapengguna  = 'active';
        $titlepage     = 'Data Pengguna';
        $edit = User::find($id);
        return view('user.edit', compact('datapengguna', 'titlepage', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {

        try {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->status;

            if ($request->passowrd != '') {
                # code...
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with(['success' => 'Data pengguna berhasil diubah']);

        }

        catch ( Exception $e) {
            //throw $th;
            return redirect()->back()->with(['failed' => 'Data pengguna tidak berhasil diubah']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete
        $user = User::find($id);

        if ($user) {
            # code...
            $user->delete();
            return redirect()->route('users.index')->with(['success' => 'Data pengguna berhasil dihapus']);
        }

        else {
            return redirect()->route('users.index')->with(['success' => 'Data pengguna tidak berhasil dihapus']);
        }
    }
}

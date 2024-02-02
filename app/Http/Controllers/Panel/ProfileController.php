<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('panel.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
        ]);

        $data = $request->only(['name', 'phone', 'cpf']);

        if(!empty($request->old_password)) {
            if (Hash::check($request->old_password, auth()->user()->password))
            {
                $request->validate([
                    'new_password' => 'required|min:6',
                ]);

                $data['password'] = $request->new_password;
            }else{
                return back()->with('error', 'Senha não confere')->withInput();
            }
        }

        if(auth()->user()->update()) {
            return back()->with(['success' => 'Dados alterados com sucesso'])->withInput();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

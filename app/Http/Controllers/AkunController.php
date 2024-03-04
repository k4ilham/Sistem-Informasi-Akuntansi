<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Akun;

class AkunController extends Controller
{

    public function index()
    {
        $akun = Akun::all();

        return view('admin.akun.index',[
            'akun'=>$akun
        ]);
    }

    public function create()
    {
       //
    }

    public function store(Request $request)
    {
        $akun           = new Akun;
        $akun->no_akun  = $request->no_akun;
        $akun->nm_akun  = $request->nm_akun;
        $akun->save();

        Alert::success('Pesan ','Data berhasil disimpan');
        return redirect('/akun');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $akun = Akun::findOrFail($id);
        return view('admin.akun.edit',['akun'=>$akun]);
    }

    public function update(Request $request, string $id)
    {
        $akun           = Akun::findOrFail($id);
        $akun->no_akun  = $request->no_akun;
        $akun->nm_akun  = $request->nm_akun;
        $akun->save();

        return redirect()->route('akun.index');
    }

    public function destroy(string $id)
    {
        $akun=Akun::findOrFail($id);
        $akun->delete();
        
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect()->route('akun.index');
    }
}

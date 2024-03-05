<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Akun;
use Alert;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        $akun = Akun::all();

        return view('admin.setting.index',[
            'setting'=>$setting,
            'akun'=>$akun
        ]);
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
    public function simpan(Request $request)
    {
        $kode = $request->kode;
        $akun = $request->akun;
        foreach($akun as $key => $no)
        {
            $input['no_akun'] = $akun[$key]; 
            Setting::where('id_setting',$kode[$key])->update($input);
        }
        Alert::warning('Pesan ','Setting Akun telah dilakukan ');
        return redirect('setting');
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

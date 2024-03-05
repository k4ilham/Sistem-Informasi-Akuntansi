<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPesan;
use App\Models\Pemesanan;
use Alert;


class DetailPesanController extends Controller
{
    public function simpan(Request $request)
    {
        //Simpan ke table pemesanan
        $pemesanan            = new Pemesanan;
        $pemesanan->no_pesan  = $request->no_pesan;
        $pemesanan->tgl_pesan = $request->tgl;
        $pemesanan->total     = $request->total;
        $pemesanan->kd_supp    = $request->supp;
        $pemesanan->save();

        //Simpan data ke table detail pesan
        $kd_brg     = $request->kd_brg;
        $qty        = $request->qty_pesan;
        $sub_total  = $request->sub_total;

        foreach($kd_brg as $key => $no){
            $input['no_pesan']    = $request->no_pesan;
            $input['kd_brg']      = $kd_brg[$key];
            $input['qty_pesan']   = $qty[$key];
            $input['subtotal']    = $sub_total[$key];
            DetailPesan::insert($input); 
        }
        
        Alert::success('Pesan ','Data berhasil disimpan');
        return redirect('/transaksi');
    }

}
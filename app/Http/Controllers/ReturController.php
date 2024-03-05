<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Retur;
use App\Models\DetailRetur;
use App\Models\Pembelian;
use App\Models\Jurnal;
use DB;
use Alert;
class ReturController extends Controller
{

    public function index()
    {
        $pembelian = Pembelian::All();
        
        return view('retur.index',[
            'pembelian'=>$pembelian
        ]);
    }

    public function edit($id){

        $AWAL        = 'RTR';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = Retur::max('no_retur');
        $no          = 1; 
        $format=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/'. $bulanRomawi[date('n')] .'/' . date('Y');

        //No otomatis untuk jurnal
        $AWALJurnal   = 'JRU';
        $bulanRomawij = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhirj = Jurnal::max('no_jurnal');
        $noj          = 1;
        $formatj=sprintf("%03s", abs((int)$noUrutAkhirj + 1)). '/' . $AWALJurnal .'/' . $bulanRomawij[date('n')] .'/' . date('Y');
        
        $decrypted   = Crypt::decryptString($id);
        $detail      = DB::table('tampil_pembelian')->where('no_beli',$decrypted)->get();
        $pemesanan   = DB::table('pemesanan')->where('no_pesan',$decrypted)->get();
        $akunkas     = DB::table('setting')->where('nama_transaksi','Kas')->get();
        $akunretur   = DB::table('setting')->where('nama_transaksi','Retur')->get();

        return view('retur.beli',[
            'beli'=>$detail,
            'format'=>$format,
            'no_pesan'=>$decrypted,
            'pemesanan'=>$pemesanan,
            'formatj'=>$formatj,
            'kas'=>$akunkas,
            'retur'=>$akunretur
        ]);
    }
    public function simpan(Request $request)
    {
        if (Retur::where('no_retur', $request->no_retur)->exists()) {
            Alert::warning('Pesan ','Retur sudah dilakukan ');
            return redirect('retur');
        }else{

            //SIMPAN DATA KE TABEL DETAIL RETUR
            $kdbrg    = $request->kd_brg;
            $qtyretur = $request->jml_retur;
            $harga    = $request->harga;
            $total    = 0;

            foreach($kdbrg as $key => $no){
                $input['no_retur']  = $request->no_retur;
                $input['kd_brg']    = $kdbrg[$key];
                $input['qty_retur'] = $qtyretur[$key];
                $input['sub_retur'] = $harga[$key]*$qtyretur[$key];
                DetailRetur::insert($input);
                $total = $harga[$key] * $qtyretur[$key];
            }

            //Simpan ke table retur
            $retur              = new Retur;
            $retur->no_retur    = $request->no_retur;
            $retur->tgl_retur   = $request->tgl;
            $retur->total_retur = $total;
            $retur->save();

            //SIMPAN ke table jurnal bagian debet
            $jurnal             = new Jurnal;
            $jurnal->no_jurnal  = $request->no_jurnal;
            $jurnal->keterangan = 'Kas';
            $jurnal->tgl_jurnal = $request->tgl;
            $jurnal->no_akun    = $request->kas;
            $jurnal->debet      = $total;
            $jurnal->kredit     = '0';
            $jurnal->save();
            
            //SIMPAN ke table jurnal bagian kredit
            $jurnal             = new Jurnal;
            $jurnal->no_jurnal  = $request->no_jurnal;
            $jurnal->keterangan = 'Retur Pembelian';
            $jurnal->tgl_jurnal = $request->tgl;
            $jurnal->no_akun    = $request->retur;
            $jurnal->debet      ='0';
            $jurnal->kredit     = $total;
            $jurnal->save();

            Alert::success('Pesan ','Data berhasil disimpan');
            return redirect('/retur');
        }
    }

}

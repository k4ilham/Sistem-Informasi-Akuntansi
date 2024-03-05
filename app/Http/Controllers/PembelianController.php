<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Pemesanan;
use App\Models\Jurnal;
use DB;
use Alert;
use PDF;
class PembelianController extends Controller
{
//
    public function index(){
        $pemesanan = Pemesanan::All();
        $pemesanan = DB::select('SELECT * FROM pemesanan where not exists (select * from pembelian where pemesanan.no_pesan=pembelian.no_pesan)');
        return view('pembelian.index',['pemesanan'=>$pemesanan]);
    }
    public function edit($id){

        $AWAL        = 'FKT';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = Pembelian::max('no_beli');
        $no          = 1; 
        $format      = sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    
        $AWALJurnal   = 'JRU';
        $bulanRomawij = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhirj = Jurnal::max('no_jurnal');
        $noj          = 1;
        $formatj      = sprintf("%03s", abs((int)$noUrutAkhirj + 1)). '/' . $AWALJurnal.'/' . $bulanRomawij[date('n')] .'/' . date('Y');
        
        $decrypted     = Crypt::decryptString($id);
        $detail        = DB::table('tampil_pemesanan')->where('no_pesan',$decrypted)->get();
        $pemesanan     = DB::table('pemesanan')->where('no_pesan',$decrypted)->get();
        $akunkas       = DB::table('setting')->where('nama_transaksi','Kas')->get();
        $akunpembelian = DB::table('setting')->where('nama_transaksi','Pembelian')->get();

        return view('pembelian.beli',[
            'detail'=>$detail,
            'format'=>$format,
            'no_pesan'=>$decrypted,
            'pemesanan'=>$pemesanan,
            'formatj'=>$formatj,
            'kas'=>$akunkas,
            'pembelian'=>$akunpembelian
        ]);
    }

    public function pdf($id){
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pemesanan')->where('no_pesan',$decrypted)->get();
        $supplier = DB::table('supplier')->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan',$decrypted)->get();

        $pdf = PDF::loadView('laporan.faktur',[
            'detail'=>$detail,
            'order'=>$pemesanan,
            'supp'=>$supplier,
            'noorder'=>$decrypted
        ]);

        return $pdf->stream();
    }
    public function simpan(Request $request)
    {
        if (Pembelian::where('no_pesan', $request->no_pesan)->exists()) {
            Alert::warning('Pesan ','Pembelian Telah dilakukan ');
            return redirect('pembelian');
        }else{

            //Simpan ke table pembelian
            $pembelian             = new Pembelian;
            $pembelian->no_beli    = $request->no_faktur;
            $pembelian->tgl_beli   = $request->tgl;
            $pembelian->no_faktur  = $request->no_faktur;
            $pembelian->total_beli = $request->total;
            $pembelian->no_pesan   = $request->no_pesan;
            $pembelian->save();


            //SIMPAN DATA KE TABEL DETAIL PEMBELIAN
            $kdbrg   = $request->kd_brg;
            $qtybeli = $request->qty_beli;
            $subbeli = $request->sub_beli;

            foreach($kdbrg as $key => $no){
                $input['no_beli']   = $request->no_faktur;
                $input['kd_brg']    = $kdbrg[$key];
                $input['qty_beli']  = $qtybeli[$key];
                $input['sub_beli']  = $subbeli[$key];
                DetailPembelian::insert($input);
            }

            //SIMPAN ke table jurnal bagian debet
            $jurnal             = new Jurnal;
            $jurnal->no_jurnal  = $request->no_jurnal;
            $jurnal->keterangan = 'Utang Dagang ';
            $jurnal->tgl_jurnal = $request->tgl;
            $jurnal->no_akun    = $request->pembelian;
            $jurnal->debet      = $request->total;
            $jurnal->kredit     = '0';
            $jurnal->save();
            
            //SIMPAN ke table jurnal bagian kredit
            $jurnal             = new Jurnal;
            $jurnal->no_jurnal  = $request->no_jurnal;
            $jurnal->keterangan = 'Kas';
            $jurnal->tgl_jurnal = $request->tgl;
            $jurnal->no_akun    = $request->akun;
            $jurnal->debet      ='0';
            $jurnal->kredit     = $request->total;
            $jurnal->save();

            Alert::success('Pesan ','Data berhasil disimpan');
            return redirect('/pembelian');
        }
    } 

}
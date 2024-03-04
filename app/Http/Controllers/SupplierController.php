<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $supplier = Supplier::all();

        return view('admin.supplier.index',[
            'supplier'=>$supplier
        ]);
    }

    public function create()
    {
        return view('admin.supplier.input');
    }

    public function store(Request $request)
    {
        $supplier             = new Supplier;
        $supplier->kd_supp    = $request->kd_supp;
        $supplier->nm_supp    = $request->nm_supp;
        $supplier->alamat     = $request->alamat;
        $supplier->telepon    = $request->telepon;
        $supplier->save();

        Alert::success('Pesan ','Data berhasil disimpan');
        return redirect('/supplier');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $supplier_edit = Supplier::findOrFail($id);
        return view('admin.supplier.edit',['supplier'=>$supplier_edit]);
    }

    public function update(Request $request, string $id)
    {
        $supplier             = Supplier::findOrFail($id);
        $supplier->kd_supp    = $request->kd_supp;
        $supplier->nm_supp    = $request->nm_supp;
        $supplier->alamat     = $request->alamat;
        $supplier->telepon    = $request->telepon;
        $supplier->save();

        return redirect()->route('supplier.index');
    }

    public function destroy(string $id)
    {
        $supplier=Supplier::findOrFail($id);
        $supplier->delete();
        
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect()->route('supplier.index');
    }
}

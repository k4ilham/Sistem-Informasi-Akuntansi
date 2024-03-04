@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
</div>

<hr>

<div class="card-header py-3" align="right">
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn￾primary shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
    </button>
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered table￾striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $brg)
                    <tr>
                        <td>{{ $brg->kd_brg}}</td>
                        <td>{{ $brg->nm_brg}}</td>
                        <td>{{ number_format($brg->harga)}}</td>
                        <td>{{ number_format($brg->stok)}}</td>
                        <td align="center">
                            <a href="{{route('barang.edit',[$brg->kd_brg])}}"class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>

                            <a href="/barang/hapus/{{$brg->kd_brg}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d￾none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>


<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>


        <form action="#" method="POST">
        @csrf

            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleFormControlInput1">Kode Barang</label>
                    <input type="text" name="addkdbrg" id="addkdbrg" class="form-control" maxlegth="5" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Barang</label>
                    <input type="text" name="addnmbrg" id="addnmbrg" class="form-control" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Harga Barang</label>
                    <input type="number" name="addharga" id="addharga" class="form-control" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Stok Barang</label>
                    <input type="number" name="addstok" id="addstok" class="form-control" id="exampleFormControlInput1" >
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary btn-send" value="Simpan">
            </div>


        </form>

        </div>
    </div>
</div>
@endsection
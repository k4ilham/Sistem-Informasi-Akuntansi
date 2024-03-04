@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
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
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supplier as $data)
                    <tr>
                        <td>{{ $data->kd_supp }}</td>
                        <td>{{ $data->nm_supp }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->telepon }}</td>

                        <td align="center">
                            <a href="{{route('supplier.edit',[$data->kd_supp])}}"class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>

                            <a href="/supplier/hapus/{{$data->kd_supp}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d￾none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>


        <form action="#" method="POST">
        @csrf

            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleFormControlInput1">Kode Supplier</label>
                    <input type="text" name="kd_supp" id="kd_supp" class="form-control" maxlegth="5" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Suppler</label>
                    <input type="text" name="nm_supp" id="nm_supp" class="form-control" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" id="exampleFormControlInput1" >
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" maxlegth="20" id="exampleFormControlInput1" >
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
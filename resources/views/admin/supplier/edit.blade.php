@extends('layouts.app')
@section('content')
    <form action="{{route('supplier.update', [$supplier->kd_supp])}}" method="POST">

        @csrf
        <input type="hidden" name="_method" value="PUT">

        <fieldset>
            <legend>Ubah Data Barang</legend>

                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="kd_supp">Kode Supplier</label>
                        <input class="form-control" type="text" name="kd_supp" value="{{$supplier->kd_supp}}" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="nm_supp">Nama Supplier</label>
                        <input id="nm_supp" type="text" name="nm_supp" class="form-control" value="{{$supplier->nm_supp}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="alamat">Alamat</label>
                        <input id="alamat" type="text" name="alamat" class="form-control" value="{{$supplier->alamat}}">
                    </div>
                    <div class="col-md-5">
                        <label for="telepon">Telepon</label>
                        <input id="telepon" type="text" name="telepon" class="form-control" value="{{$supplier->telepon}}">
                    </div>
                </div>
        </fieldset>

        <div class="col-md-10">
            <input type="submit" class="btn btn-success btn-send" value="Update">
            <a href="{{ route('supplier.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
        </div>
        <hr>
    </form>
@endsection
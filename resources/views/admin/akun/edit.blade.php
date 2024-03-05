@extends('layouts.app')
@section('content')
    <form action="{{route('akun.update', [$akun->no_akun])}}" method="POST">

        @csrf
        <input type="hidden" name="_method" value="PUT">

        <fieldset>
            <legend>Ubah Data Akun Rekening</legend>

                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="no_akun">Kode Supplier</label>
                        <input class="form-control" type="text" name="no_akun" value="{{$akun->no_akun}}" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="nm_akun">Nama Supplier</label>
                        <input id="nm_akun" type="text" name="nm_akun" class="form-control" value="{{$akun->nm_akun}}">
                    </div>
                </div>
        </fieldset>

        <div class="col-md-10">
            <input type="submit" class="btn btn-success btn-send" value="Update">
            <a href="{{ route('akun.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
        </div>
        <hr>
    </form>
@endsection
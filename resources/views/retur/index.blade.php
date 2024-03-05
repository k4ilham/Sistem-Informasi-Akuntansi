@extends('layouts.app')
@section('content')
@include('sweetalert::alert')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Retur </h1>
</div>

<hr>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table￾striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th width="15%">No Pemesanan</th>
                        <th>Tanggal Pesan</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($pembelian as $beli)
                <tr>
                    <td width="15%">{{ $beli->no_faktur }}</td>
                    <td>{{ $beli->tgl_beli }}</td>
                    <td>Rp. {{ number_format($beli->total_beli) }}</td>
                    <td width="30%">
                        <a href="{{url('/retur-beli/'.Crypt::encryptString($beli->no_faktur))}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow￾sm"><i class="fas fa-recycle fa-sm text-white-50"></i> Retur</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
</form>
@endsection
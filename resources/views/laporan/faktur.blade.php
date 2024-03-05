<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice PT XYZ</title>

        <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }
            .invoice-box table {
                width: 100%;
                line-height: normal; /* inherit */
                text-align: left;
            }
            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }
            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }
            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }
            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }
            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }
            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }
            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }
            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }
            .invoice-box table tr.item.last td {
                border-bottom: none;
            }
            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }
            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            }
            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
            .rtl table {
                text-align: right;
            }
            .rtl table tr td:nth-child(2) {
                text-align: left;
            }
        </style>
    </head>
    <body>

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">

                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title"><img src="asset/img/logo_ubsi.png" width="80px"></td> 
                                <td>Invoice : <strong>#{{ $noorder }}</strong><br></td>
                            </tr>
                        </table>
                    </td>
                </tr> 

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    @foreach($order as $pesan)
                                        @foreach($supp as $sp)
                                            @if($pesan->kd_supp==$sp->kd_supp)
                                                <strong>PENERIMA</strong><br>
                                                {{ $sp->nm_supp }}<br>
                                                {{ $sp->alamat }}<br>
                                                {{ $sp->telepon }}<br>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>

                                <td>
                                    <strong>PENGIRIM</strong><br>
                                    BSI Sukabumi<br>
                                    026689788<br>
                                    Jl Cemerlang No.8 <br>
                                    Sukakarya, Kota Sukabumi<br>
                                    Jawa Barat
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Produk</td>
                    <td>Subtotal</td>
                </tr>

                    @php($total = 0)
                @foreach ($detail as $row)
                <tr class="item">
                    <td>
                        {{$row->nm_brg}}<br><strong>Harga</strong>: Rp {{ number_format($row->sub_total/$row->qty_pesan) }} x {{ $row->qty_pesan }}
                    </td>
                    <td>Rp {{ number_format($row->sub_total) }}</td>
                </tr>
                    @php($total += $row->sub_total)
                @endforeach

                <tr class="total">
                    <td></td>
                    <td>Total: Rp {{ number_format($total) }}</td>
                </tr> 

                <tr>
                    <td colspan="3">Mohon segera dikirim permintaan barang yang tertera diatas</td> 
                </tr>
            </table>
        </div>
    </body>
</html>
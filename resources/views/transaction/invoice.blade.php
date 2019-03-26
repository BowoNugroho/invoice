@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title">Detail Transaksi</h3></div>
                                    <div class="panel-body">
                                        <form action="" >
                                            <table class="table table-condensed">
                                            @foreach($dataInvoice as $datas)
                                                <tbody>
                                                    <tr><td>No. Invoice</td><td class="text-primary strong">{{ $datas->transaction_code }}</td></tr>
                                                    <tr><td>Tanggal</td><td>{{ $datas->date }}</td></tr>
                                                    <tr><td>Nama Customer</td><td>{{ $datas->name }}</td></tr>
                                                    <tr><td>Hp/Telp.</td><td>{{ $datas->phone_number }}</td></tr>
                                                    <tr><td>Total</td><td class="text-right strong">{{ $datas->total_payment }}</td></tr>
                                                    <tr><td>Jumlah Dibayar</td><td class="text-right">{{ $datas->payment }}</td></tr>
                                                    <tr><td>Kembalian</td><td class="text-right">{{ $datas->change_payment }}</td></tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Barang Belanja</h3></div>
                                        <div class="panel-body">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Produk</th>
                                                        <th class="text-right">Harga Satuan</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-right">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($dataInvoice1 as $data)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $data->item_name }} </td>
                                                        <td class="text-right">{{ $data->price }}</td>
                                                        <td class="text-center">{{ $data->quantity }}</td>
                                                        <td class="text-right">{{ $data->subtotal }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                @foreach($dataInvoice as $data1)
                                                    <tr>
                                                        <th colspan="4" class="text-right">Subtotal :</th>
                                                        <th class="text-right">{{ $data1->subtotal1 }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="4" class="text-right">Total Diskon :</th>
                                                        <th class="text-right">{{ $data1->discount }}%</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="4" class="text-right">Total :</th>
                                                        <th class="text-right">{{ $data1->total_payment }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
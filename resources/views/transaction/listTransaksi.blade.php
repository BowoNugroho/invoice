@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center">List Transaksi</h2> &ensp;
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                            @foreach($listTransaksi as $datas)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->transaction_code }}</td>
                                    <td>{{ $datas->date }}</td>
                                    <td>{{ $datas->name }}</td>
                                    <td>{{ $datas->total_payment }}</td>
                                    <td>
                                        <form action="" method="post">
                                            <a href="{{ route('home.show',$datas->id) }}" class=" btn btn-sm btn-primary">Lihat</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
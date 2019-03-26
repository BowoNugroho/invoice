@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center">Data Item</h2> &ensp;
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode Item</th>
                                    <th>Kode Penjual</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                            @foreach($dataitem as $datas)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->item_name }}</td>
                                    <td>{{ $datas->item_code }}</td>
                                    <td>{{ $datas->seller_code }}</td>
                                    <td>{{ $datas->weight }}</td>
                                    <td>{{ $datas->price }}</td>
                                    <td>{{ $datas->stock }}</td> 
                                    <td>
                                        <form action="{{ route('item.destroy',$datas->id) }}" method="post">
                                            {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                            <a href="{{ route('item.edit',$datas->id) }}" class=" btn btn-sm btn-info">Edit</a>
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
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
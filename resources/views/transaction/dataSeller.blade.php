@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center">Data Penjual</h2> &ensp;
                        <a href="/showFormInsertSeller" class=" btn btn-sm btn-primary">Tambah Penjual</a>
                        <a href="/showItem" class=" btn btn-sm btn-primary">Lihat Item</a> 
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                            @foreach($data as $datas)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->seller_name }}</td>
                                    <td>{{ $datas->seller_code }}</td>
                                    <td>{{ $datas->address }}</td>
                                    <td>{{ $datas->phone_number }}</td>
                                    <td>
                                        <form action="{{ route('home.destroy',$datas->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                            <a href="{{ route('home.edit',$datas->id) }}" class=" btn btn-sm btn-info">Edit</a>
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                            <a href="{{ route('item.show',$datas->id) }}" class=" btn btn-sm btn-primary">Tambah Item</a>
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
@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Data Penjual</h3>
                    @foreach($data as $datas)
                        <form action="{{ route('home.update',$datas->id) }}" method="post">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control" type="text" name="nama" value="{{ $datas->seller_name }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Kode</label>
                                <input class="form-control" type="text" name="kode" value="{{ $datas->seller_code }}">
                            </div>
                            <div class="form-group">
                                <label for="usia">Alamat</label>
                                <input class="form-control" type="text" name="alamat" value="{{ $datas->address }}">
                            </div>
                            <div class="form-group">
                                <label for="usia">No Telepon</label>
                                <input class="form-control" type="text" name="telepon" value="{{ $datas->phone_number }}">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
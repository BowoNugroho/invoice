@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Data Item</h3>
                        <br/>
                        @if(count($errors)> 0)
                            <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error}} </li>
                            @endforeach
                            </div>
                        @endif
                        <br/>
                        @foreach($data as $datas)
                            <form action="/insertItem" method="post">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <input class="form-control" type="hidden" name="id" value="{{ $datas->id }}">
                                <div class="form-group">
                                    <label for="nama">Nama Item</label>
                                    <input class="form-control" type="text" name="namaitem" value="">
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Kode Item</label>
                                    <input class="form-control" type="text" name="kodeitem" value="">
                                </div>
                               <div class="form-group">
                                    <label for="pekerjaan">Kode Penjual</label>
                                    <input class="form-control" type="text" name="kodepenjual" readonly="readonly" value="{{ $datas->seller_code }}">
                                </div>
                                <div class="form-group">
                                    <label for="usia">Berat</label>
                                    <input class="form-control" type="text" name="berat" value="">
                                </div>
                                <div class="form-group">
                                    <label for="usia">Harga</label>
                                    <input class="form-control" type="text" name="harga" value="">
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Stok</label>
                                    <input class="form-control" type="text" name="stok" value="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Tambah">
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
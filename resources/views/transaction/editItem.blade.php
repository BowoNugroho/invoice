@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Data Item</h3>
                    @foreach($dataitem as $datas)
                        <form action="{{ route('item.update',$datas->id) }}" method="post">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input class="form-control" type="hidden" name="id" value="{{ $datas->id }}">
                            <div class="form-group">
                                <label for="nama">Nama Item</label>
                                <input class="form-control" type="text" name="namaitem" value="{{ $datas->item_name }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Kode Item</label>
                                <input class="form-control" type="text" name="kodeitem" value="{{ $datas->item_code }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Kode Penjual</label>
                                <input class="form-control" type="text" name="kodepenjual" readonly="readonly" value="{{ $datas->seller_code }}">
                            </div>
                            <div class="form-group">
                                <label for="usia">Berat</label>
                                <input class="form-control" type="text" name="berat" value="{{ $datas->weight }}">
                            </div>
                            <div class="form-group">
                                <label for="usia">Harga</label>
                                <input class="form-control" type="text" name="harga" value="{{ $datas->price }}">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Stok</label>
                                <input class="form-control" type="text" name="stok" value="{{ $datas->stock }}">
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
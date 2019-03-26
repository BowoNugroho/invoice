@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Form Penjual</h3>
                        <br/>
                        @if(count($errors)> 0)
                            <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error}} </li>
                            @endforeach
                            </div>
                        @endif
                        <br/>
                            <form action="/insertSeller" method="post">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input class="form-control" type="text" name="nama" id="nama" value="">
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Kode</label>
                                    <input class="form-control" type="text" name="kode" value="">
                                </div>
                                <div class="form-group">
                                    <label for="usia">Alamat</label>
                                    <input class="form-control" type="text" name="alamat" value="">
                                </div>
                                <div class="form-group">
                                    <label for="usia">No Telepon</label>
                                    <input class="form-control" type="text" name="telepon" value="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Tambah">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
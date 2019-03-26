@extends('layout.layout')

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Form Invoice</h3>
                        <form action="/insertTransaction" method="post">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <div class="row justify-content-center">
                                <div class="col-lg-14">
                                    <div class="card-body">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Berat @</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $no = 1; @endphp
                                            @for ($i=1; $i <= 5; $i++) 
                                                <tr id="tr_{{$i}}">
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                    <select id="optionItem_{{$i}}" name="optionItem_" onchange="getDetailItem({{$i}})"> 
                                                    <option value="-">select bellow</option>
                                                    @foreach($dataitem as $datas) 
                                                    <option value = '{{ $datas->id }}'> {{ $datas->item_name }} </option>
                                                    @endforeach
                                                    </select>
                                                    </td>
                                                    <td><input  type="text"  name="quantity[]" id="quantity_{{$i}}" value="" onkeyup="getQuantity({{$i}})"><input type="hidden" name="itemId[]" id="itemId_{{$i}}" value=""></td>
                                                    <td><input type="text" name="weight[]" id="weight_{{$i}}" value="" readonly> </td>
                                                    <td><input type="text" name="price[]" id="price_{{$i}}" value="" readonly></td>
                                                    <td><input type="text" name="subtotal[]" id="subtotal_{{$i}}" value="" onclick="getSubtotal({{$i}})" readonly></td>
                                                    <td>
                                                    <div>
                                                        <button class="btn btn-sm btn-danger" type="button" id="delete_{{$i}}" onclick="getDelete({{$i}})"> Delete</button>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                                <tr>
                                                    <td colspan="5">
                                                    <div style="text-align:right">Subtotal : </div>
                                                    </td>
                                                    <td style="text-align:left" colspan="2">
                                                    <input type="text" name="subtotal1" id="subtotal1_{{$i}}" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                    <div style="text-align:right">Diskon : </div>
                                                    </td>
                                                    <td style="text-align:left" colspan="2">
                                                    <input type="text" required="" name="diskon" id="diskon" onkeyup="getDiskon()">&ensp;%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                    <div style="text-align:right">Total : </div>
                                                    </td>
                                                    <td style="text-align:left" colspan="2">
                                                    <input type="text" name="total" id="total" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                                <input class="form-control" required="" type="text" name="nama" value="">
                            </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                                <input class="form-control" required="" type="text" name="alamat" value="">
                            </div>
                        <div class="form-group">
                            <label for="tlp">No Telepon</label>
                                <input class="form-control" required="" type="text" name="telepon" value="">
                            </div>
                        <div class="form-group ">
                            <div class="col-md-6">
                                <label for="payment" >Jumlah Dibayar</label>&nbsp;
                                    <div class="input-group"><span class="input-group-addon">Rp</span>
                                        <input class="form-control text-right"  name="payment" type="text" id="payment" onkeyup="getPayment()" value="">
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="payment1" class="control-label">Kembalian</label>&nbsp;
                                        <div class="input-group"><span class="input-group-addon">Rp</span>
                                            <input class="form-control" name="changePayment" type="text" id="changePayment" readonly=" " value=" ">
                                        </div>
                                    </div>
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
<script type="text/javascript">
    function getDetailItem(param){
       var id = $("#optionItem_"+param).val();
       if(id != '-') {

        $.ajax({
          url: "<?php echo route('selectAjax') ?>",
          method: 'GET',
          data: {id:id},
          success: function(data) {
            $('#weight_'+param).val(data[0].weight);
           $('#price_'+param).val(data[0].price);
           $('#itemId_'+param).val(data[0].id);
            
          }
      });
    }
    else{
        $('#quantity_'+param).val('');
        $('#weight_'+param).val('');
        $('#price_'+param).val('');
        $('#subtotal_'+param).val('');
    }
    }
    function getDelete(param){
        $("#optionItem_"+param).val('-')
        $('#quantity_'+param).val('');
        $('#weight_'+param).val('');
        $('#price_'+param).val('');
        $('#subtotal_'+param).val(''); 
    }
	
    function getQuantity(param) {
		var quantity = document.getElementById('quantity_'+param).value;
		var price = document.getElementById('price_'+param).value;
		var subtotal = quantity * price;
		document.getElementById('subtotal_'+param).value = subtotal;
        var subtotal1 = document.getElementById('subtotal_1').value;
        if(subtotal1 ==''){
            subtotal1=0;
        }
        var subtotal2 = document.getElementById('subtotal_2').value;
        if(subtotal2 ==''){
            subtotal2=0;
        }
        var subtotal3 = document.getElementById('subtotal_3').value;
        if(subtotal3 ==''){
            subtotal3=0;
        }
        var subtotal4 = document.getElementById('subtotal_4').value;
        if(subtotal4 ==''){
            subtotal4=0;
        }
        var subtotal5 = document.getElementById('subtotal_5').value;
        if(subtotal5 ==''){
            subtotal5=0;
        }
        var hasil = parseInt(subtotal1)+parseInt(subtotal2)+parseInt(subtotal3)+parseInt(subtotal4)+parseInt(subtotal5);
        document.getElementById('subtotal1_6').value=hasil;
		}
    function getDiskon(param){
        var subtotal1 =  document.getElementById('subtotal1_6').value;
        var diskon = document.getElementById('diskon').value;
        var hasildiskon = diskon * subtotal1 / 100;
        var hasil = subtotal1 - hasildiskon;
        document.getElementById('total').value=hasil;
    }
    function getPayment(){
        var total = document.getElementById('total').value;
        var payment = document.getElementById('payment').value;
        var changePayment = payment-total;
        document.getElementById('changePayment').value=changePayment;
    }
</script>
@endsection
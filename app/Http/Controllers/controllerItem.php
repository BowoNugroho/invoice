<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\ModelSeller;
use App\ModelItem;
use App\ModelInvoice;
use App\ModelDetailInvoice;
use App\ModelCustomer;
use App\ModelPayment;
use DB;


class controllerItem extends Controller
{
    public function index() 
    {
        $dataitem = DB::table('master_item')->join('seller','master_item.seller_id','=','seller.id')
        ->select('master_item.id', 'master_item.item_name','master_item.item_code','seller.seller_code','master_item.price','master_item.weight','master_item.stock')
        ->get();
        return view('transaction.dataItem',compact('dataitem',$dataitem));
    }
    
    public function show($id) // Untuk menampikan view yang berisi data produk dari database
    {
        $data = ModelSeller::where('id',$id)->get();
        return view('transaction.item',compact('data'));
    }
    public function insertItem(Request $request) // function untuk memasukan produk ke database
    {
        $this->validate($request, [
            'namaitem' => 'required',
            'kodeitem' => 'required',
            'berat' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $data = new ModelItem;
        $data->item_name = $request->namaitem;
        $data->item_code = $request->kodeitem;
        $data->weight = $request->berat;
        $data->price = $request->harga;
        $data->stock = $request->stok;
        $data->seller_id = $request->id;
        $data->save();
        return redirect()->route('home.index');
    }
    public function edit($id) // function untuk edit data produk
    {
        $dataitem = DB::table('master_item')->join('seller','master_item.seller_id','=','seller.id')
        ->select('master_item.id', 'master_item.item_name','master_item.item_code','seller.seller_code','master_item.price','master_item.weight','master_item.stock')
        ->where('master_item.id', $id)
        ->get();
        return view('transaction.editItem',compact('dataitem', $dataitem));
    }
    public function update(Request $request, $id) // function untuk update data produk
    {
        $data =  ModelItem::where('id',$id)->first();
        $data->item_name = $request->namaitem;
        $data->item_code = $request->kodeitem;
        $data->weight = $request->berat;
        $data->price = $request->harga;
        $data->stock = $request->stok;
        $data->save();
        return redirect()->route('item.index')->with('alert-success','Berhasil Menambahkan Data!');
    }
    public function destroy($id) // function untuk menghapus data produk
    {
        $data = ModelItem::where('id',$id)->first();
        $data->delete();
        return redirect()->route('item.index')->with('alert-success','Data berhasi dihapus!');
    }
    public function getDetailItem(Request $request) // function untuk ajax javascript
    {
        $id = $request->id;
        $dataitem = DB::table('master_item')
        ->select('master_item.id','master_item.seller_id', 'master_item.item_name','master_item.item_code','master_item.price','master_item.weight','master_item.stock')
        ->where('master_item.id', $id)
        ->get();
        return response ()->json ( $dataitem );
    }
}

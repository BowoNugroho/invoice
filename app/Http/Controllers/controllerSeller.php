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
use PDF;

class controllerSeller extends Controller
{
    public function index() 
    {
       $data = ModelSeller::all();
        return view('transaction.dataSeller', compact('data',$data));
    }
    public function home() // Untuk menampikan view yang berisi data seller dari database 
    {
        $data = ModelSeller::all();
        return view('transaction.dataSeller', compact('data',$data));
    }
    public function transaction() // Untuk menampikan view form transaksi
    {
        $dataitem = ModelItem::all();
        return view('transaction.transaction', compact('dataitem', $dataitem));
    }
    public function ListTransaksi() // Untuk menampikan view list transaksi
    {       
        $listTransaksi = DB::table('transaction')
                        ->join('customer','transaction.customer_id','=','customer.id')
                        ->join('payment','payment.customer_id','=','customer.id')
                        ->select('transaction.id','transaction.transaction_code','transaction.date','customer.name','payment.total_payment')
                        ->ORDERBY 	('transaction.id', 'DESC')
                        ->get();
        return view('transaction.listTransaksi', compact('listTransaksi', $listTransaksi));
    }
    public function showFormInsertSeller() // Untuk menampikan view form penambahan penjual
    {
        return view('transaction.seller');
    }
    public function showItem() // Untuk menampikan view yang berisi data produk dari database 
    {
        $dataitem = DB::table('master_item')
        ->join('seller','master_item.seller_id','=','seller.id')
        ->select('master_item.id','master_item.seller_id', 'master_item.item_name','master_item.item_code','seller.seller_code','master_item.price','master_item.weight','master_item.stock')
        ->get();
        return view('transaction.dataItem',compact('dataitem',$dataitem));
    }
    public function insertSeller(Request $request) // function untuk memasukan penjual ke database
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $data = new ModelSeller;
        $data->seller_name = $request->nama;
        $data->seller_code = $request->kode;
        $data->address = $request->alamat;
        $data->phone_number = $request->telepon;
        $data->save();

        return redirect()->route('home.index');
    }
   public function insertTransaction(Request $request) // memasukan data transaksi ke database
    {
        $data = new ModelCustomer();
        $data->name = $request->nama;
        $data->address = $request->alamat;
        $data->phone_number = $request->telepon;
        $data->save();
            $insertIdCustomer = $data->id;

        $subtotal1s = $request->subtotal;
        $jumlahSubtotal1s = array_sum($subtotal1s);
            $discounts = $request->diskon;
            $jumlahDiscount = $discounts * $jumlahSubtotal1s / 100;
            $totalPayment = $jumlahSubtotal1s -  $jumlahDiscount;
           
        $transaction = new ModelInvoice;
        $transaction->transaction_code = $this->getNewInvoiceNo();
        $transaction->date = date('Y-m-d');
        $transaction->customer_id =  $insertIdCustomer;
        $transaction->save();
            $insertIdTransaction = $transaction->id;  

        $payment = new ModelPayment;
        $payment->customer_id = $insertIdCustomer;
        $payment->subtotal1 =  $jumlahSubtotal1s;
        $payment->discount = $request->diskon;
        $payment->total_payment = $totalPayment;
        $payment->payment = $request->payment;
        $payment->change_payment = $request->changePayment;
        $payment->save();
        
        $prices = $request->price;
        $quantitys = $request->quantity;
        $subtotals = $request->subtotal;
        $itemIds  = $request->itemId;

        for ($i = 0; $i < count($prices); $i++) {
            
            $price = $prices[$i];
            $quantity = $quantitys[$i];
            $subtotal = $subtotals[$i];
            $itemId = $itemIds[$i];
            
            if($price > 0) { 
                $detail = new ModelDetailInvoice;
                $detail->transaction_id =  $insertIdTransaction;
                $detail->item_id = $itemId;
                $detail->price = $price;
                $detail->quantity =  $quantity;
                $detail->subtotal =$subtotal;
                $detail->save();
            }
        }
        return redirect()->route('home.show',$insertIdTransaction);
    }
    public function edit($id) // function untuk edit data penjual
    {
        $data = ModelSeller::where('id',$id)->get();
        return view('transaction.editSeller',compact('data'));
    }
    public function update(Request $request, $id) // function untuk update data penjual
    {
        $data =  ModelSeller::where('id',$id)->first();
        $data->seller_name = $request->nama;
        $data->seller_code = $request->kode;
        $data->address = $request->alamat;
        $data->phone_number = $request->telepon;
        $data->save();
        return redirect()->route('home.index');
    }
    public function destroy($id) // function untuk menghapus data penjual
    {
        $data = ModelSeller::where('id',$id)->first();
        $data->delete();
        return redirect()->route('home.index');
    }
    public function getNewInvoiceNo() // function untuk membuat nomor invoice
    {
        $prefix = date('dmy');
        $lastTransaction = ModelInvoice::orderBy('transaction_code', 'desc')->first();
       if (!is_null($lastTransaction)) {
            $lastInvoiceNo = $lastTransaction->transaction_code;
            if (substr($lastInvoiceNo, 0, 6) == $prefix) {
                return ++$lastInvoiceNo;
            }
        }
        return $prefix.'0001';
    }
  public function show($id) // function untuk menampilkan view invoice
    {
        $dataInvoice = DB::table('customer')
                        ->join('payment','payment.customer_id','=','customer.id')
                        ->join('transaction','transaction.customer_id','=','customer.id')
                        ->select('customer.name','customer.phone_number','payment.customer_id','payment.subtotal1','payment.discount','payment.total_payment',
                                'payment.payment','payment.change_payment','transaction.customer_id','transaction.date','customer.id','transaction.transaction_code',
                                'transaction.id')
                        ->where('transaction.id',$id)->get();
        $dataInvoice1 = DB::table('transaction')
                        -> join('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
                        -> join('master_item','transaction_detail.item_id','=','master_item.id')
                        ->select('transaction.id', 'transaction_detail.transaction_id', 'transaction_detail.item_id', 'transaction_detail.price', 
                                'transaction_detail.quantity', 'transaction_detail.subtotal', 'master_item.id',
                                'master_item.item_name')
                        ->where('transaction.id',$id)->get();
                        
        return view('transaction.invoice',compact(['dataInvoice',$dataInvoice],['dataInvoice1',$dataInvoice1]));
    }
   
}

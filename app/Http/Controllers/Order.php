<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use PDF;

class Order extends Controller
{
    public function createOrder(Request $request)
    {
        $userObj = new OrderModel();
        $userObj->order_id = isset($request->order_id) ? $request->order_id : '';      
        $userObj->customer_name = isset($request->customer_name) ?  $request->customer_name : '';
        $userObj->phone = isset($request->phone) ? $request->phone : '';
        $userObj->product_name = isset($request->product_name) ? $request->product_name : '';   
        $userObj->net_amount = isset($request->net_amount) ?  $request->net_amount : '';
        $userObj->order_date = isset($request->order_date) ?  \Carbon\Carbon::parse($request->order_date)->format('Y-m-d') : '';
        $userObj->save();
        \Session::flash('success', 'Product Details added successfully.');
        return redirect('/list-order');
    }

    public function listOrder()
    {
        $data = env('DATA_PER_PAGE');
        $order = OrderModel::paginate($data);
        return view('order/list', compact('order'));
    }

    public function destroyOrder(Request $request)
    {
        $orderId = $request->orderId;
        if ($orderId) {
            $user = OrderModel::where('id', $orderId)->first();
            if ($user->id) {
                OrderModel::destroy($orderId);
                $msg = "Success";
            } else {
                $msg = "Error";
            }
        } else {
            $msg = "Error";
        }
        return $msg;
    }

    public function editOrder(Request $request,$id)
    {
      $order = OrderModel::where('id', decrypt($id))->first();
      return view('order/edit', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $userObj = OrderModel::where('id', decrypt($id))->first();
        $userObj->order_id = isset($request->order_id) ? $request->order_id : '';      
        $userObj->customer_name = isset($request->customer_name) ?  $request->customer_name : '';
        $userObj->product_name = isset($request->product_name) ? $request->product_name : '';   
        $userObj->phone = isset($request->phone) ? $request->phone : '';
        $userObj->net_amount = isset($request->net_amount) ?  $request->net_amount : '';
        $userObj->order_date = isset($request->order_date) ?  \Carbon\Carbon::parse($request->order_date)->format('Y-m-d') : '';
        $userObj->save();
        if ($userObj) {
          \Session::flash('success', 'Policy Application details updated successfully.');
          return redirect('/list-order');
        } else {
          \Session::flash('error', 'Error updating  Policy Application Portal details.');
          return Redirect::back();
        }
    }

    public function generateOrderPDF($id)
    {
        // dd($id);
    $invoice = OrderModel::where('tbl_order.id', decrypt($id))->leftJoin('tbl_product', 'tbl_order.product_name', '=', 'tbl_product.id')->first();
    //  dd($invoice);

        // $invoice = OrderModel::where('id', decrypt($id))->first();
        $pdf = PDF::loadView('order/invoice', compact('invoice'));
        return $pdf->stream('Invoice.pdf');
    }
}

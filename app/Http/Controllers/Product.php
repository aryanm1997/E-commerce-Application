<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class Product extends Controller
{
    public function createproduct(Request $request)
    {
        $userObj = new ProductModel();
        $product_name = isset($request->product_name) ? $request->product_name : ''; 
        $category = isset($request->category) ?  $request->category : '';   
        $price = isset($request->price) ? $request->price : ''; 
        foreach($product_name as $key => $value)
        {
            $data = [
                'product_name' => $product_name[$key],
                'category' =>$category[$key],
                'price' => $price[$key]
            ];
            $userObj->insert($data);

        }

        // $userObj->category = isset($request->category) ?  $request->category : '';
        // $userObj->price = isset($request->price) ? $request->price : '';
        \Session::flash('success', 'Product Details added successfully.');
        return redirect('/list-product');
    }

    public function listProduct()
    {
        $data = env('DATA_PER_PAGE');
        $product = ProductModel::paginate($data);
        return view('list', compact('product'));
    }

    public function destroyProduct(Request $request)
    {
        $productId = $request->productId;
        if ($productId) {
            $user = ProductModel::where('id', $productId)->first();
            if ($user->id) {
                ProductModel::destroy($productId);
                $msg = "Success";
            } else {
                $msg = "Error";
            }
        } else {
            $msg = "Error";
        }
        return $msg;
    }
    public function editProduct(Request $request,$id)
    {
      $product = ProductModel::where('id', decrypt($id))->first();
      return view('edit', compact('product'));
    }
  
    public function updateProduct(Request $request, $id)
    {
        $userObj = ProductModel::where('id', decrypt($id))->first();
        $userObj->product_name = isset($request->product_name) ? $request->product_name : '';      
        $userObj->category = isset($request->category) ?  $request->category : '';
        $userObj->price = isset($request->price) ? $request->price : '';
        $userObj->save();
        if ($userObj) {
          \Session::flash('success', 'Policy Application details updated successfully.');
          return redirect('/list-product');
        } else {
          \Session::flash('error', 'Error updating  Policy Application Portal details.');
          return Redirect::back();
        }
    }
}

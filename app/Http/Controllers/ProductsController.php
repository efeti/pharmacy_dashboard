<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductsController extends Controller
{
    public function add_product_submit(Request $request)
    {
        // return $request->all();
        Validator::validate($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);
        $check_name = $request->name;
        $exist = Product::where('name', $check_name)->exists();
        if ($exist) {
            return redirect()->back()->withInput()->withErrors(['error' => 'product already exixt']);
        }
        product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);

        return redirect()->back()->with('success', 'product added successfully');
    }

    public function manage_products()
    {
        $products = Product::all();

        return view('/manage_products', ['products' => $products]);
    }

    public function edit_product($id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'product could not be edited');
        }
        return view('/edit_product', ['product' => $product]);
    }

    public function edit_product_submit(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'product could not be edited');
        }
        Product::where('id', $request->id)->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);
        return redirect()->route('manage_products')->with('success', 'product edited successfully');
    }

    public function delete_product($id)
    {
        try {
            $product = Product::findOrFail($id); //throws exception if not found
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'product not deleted');
        }
    }

    public function check(Request $request)
    {
        Validator::validate($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        
        $product = Product::where('name', $request->name)->first();
        if (!$product) {
            return response()->json(['failed', 'product not available']);
        }
        logger($product->name);
        $data = [
            'Drug' => $product->name,
            'quantity' => $product->quantity,
            'status' => 'available'
        ];
        return response()->json($data);
    }
}

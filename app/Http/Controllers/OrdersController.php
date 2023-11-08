<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Support\Facades\DB;
use Unicodeveloper\Paystack\Paystack;
// use Illuminate\Contracts\Validation\Rule;

class OrdersController extends Controller
{
    public function add_orders()
    {
        $products = Product::all();
        if (!$products) {
            return view('add_orders');
        }
        return view('add_orders', ['products' => $products]);
    }

    public function find_customer($phone_number)
    {
        $data = Customer::where('phone_number', $phone_number)->first();
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Number not found']);
        }
        logger($data);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function add_order_submit(Request $request)
    {
        validator($request->all(), [
            'phone_number' => ['required', 'regex:/^0[0-9]{10}$/'],
            'full_name' => ['required'],
            'age' => ['required'],
            'product_name' => ['required', Rule::exists('products', 'name')],
            'quantity' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required'],

        ])->validate();

        logger($request);


        $product = Product::where('name', $request->product_name)->first();
        if ($request->quantity > $product->quantity) {
            return redirect()->back()->withInput()->withErrors(['error' => 'requested quantity not avialable']);
        }

        $quantity = $product->quantity - $request->quantity;
        $customer = Customer::where('phone_number', $request->phone_number)->first();
        if (!$customer) {
            $customer = Customer::create([
                'phone_number' => $request->phone_number,
                'full_name' => $request->full_name,
                'age' => $request->age,
            ]);
        }
        $status = $request->payment_method == 'cash' ? 'paid' : 'unpaid';

        $order = Order::create([
            'customer_id' => $customer->id,
            'prescription' => $request->prescription,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'payment_method' => $request->payment_method,
            'status' => $status
        ]);  

        if ($request->payment_method == 'cash') {
            $product->update([
                'quantity' => $quantity,
            ]);
            return redirect()->back()->with('success', 'Order created successfully');
        }

        $amount = $request->quantity * $product->unit_price *100;
        $data = (new Paystack)->getAuthorizationResponse([
            'amount' => $amount,
            'reference' => \Illuminate\Support\Str::uuid(),
            'email' => 'admin@gmail.com',
            'currency' => 'NGN',
            'orderID' => $order->id,
        ]);

       $order->update([
        'status' => 'unpaid',
        'payment_link' => $data['data']['authorization_url']
       ]);

       return redirect($data['data']['authorization_url']);
        // return redirect()->back()->with(['success' => 'Order created successfully', 'data' => $data['data']['authorizattion_url']]);

        
    }

    public function manage_orders()
    {
        // $orders = Order::all();
        // return view('/manage_orders', ['orders' => $orders]);

        $orders = Order::select('orders.id', 'customers.full_name', 'name', 'orders.quantity', 'orders.payment_method', 'orders.status')->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')->leftJoin('products', 'orders.product_id', '=', 'products.id')->get();
        return view('/manage_orders', ['orders' => $orders]);
    }

    public function delete_order($id)
    {
        try {
            $Order = Order::findOrFail($id); //throws exception if not found
            $Order->delete();
            return redirect()->back()->with('success', 'Order deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Order not deleted');
        }
    }

    public function paid_order($id)
    {
        $order = Order::where('id', $id)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not updated');
        }
        $order->update([
            'status' => 'paid',
        ]);
        return redirect()->back()->with('success', 'status updated successfully');
    }

    public function prescriptions()
    {
        $prescriptions = Order::select('customers.full_name', 'orders.prescription', 'name')->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')->leftJoin('products', 'orders.product_id', '=', 'products.id')->get();
        return view('/prescriptions', ['prescriptions' => $prescriptions]);
    }
}

<?php

namespace App\Http\Controllers;
use Auth ; 
use App\Models\{order,food,category, order_food};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    /**
     * Check booking vacancy on the date
     */
    public function CheckBooking(Request $request)
    {
        // Check from db 
        $total_people = order::where('booking_date', $request->booking_date)
        ->where('booking_time', $request->booking_time)
        ->sum('total_people');

        $vacancy = 50; 
        $empty_seats = 0;

        $empty_seats = $vacancy - $total_people ;
        
        if($request->total_people + $total_people > $vacancy){
            return redirect()->back()->with([
                'error'=> 'No vacancy. Please select another date.',
            ]);
        }else{
            
            $order = [
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'total_people' => $request->total_people
            ];
            Session::put('order' , $order);
            $data = food::with('category')->get();
            // dd($data);
            return redirect()->back()->with(['success' => 'Have vacancy. Please proceed with your order.', 'data' => $data]);
        }
        
    }
    

    /**
     * Cancel booking 
     */
    public function CancelBooking()
    {
        Session::forget('order');
        Session::forget('cart');
        return redirect()->back()->with('success', 'Reservation cancelled.');
    }

    /**
     * Display all food in cart. 
     */
    public function DisplayCart()
    {
        $data = Session::get('cart', []); // Get the current cart from the session
        $food_details = [];

        // $data = session('cart');
        // $data = [];

        foreach ($data as $food) {
            // dd($food['quantity']);
            $food_id = $food['food_id'];
            // Retrieve the food details based on the food_id
            $food_details[] = [
               'food' => food::find($food_id),
               'quantity' => $food['quantity'],
            ];
            // echo $foodDetails->name;
        }
        // dd($foodDetails);
        // dd();
        return view('user.cart', compact('food_details'));
    }

    /**
     * Add food to the cart or update the quantity if it already exists.
     */
    public function AddCart(Request $request)
    {
        $foodId = $request->food_id;

        $cart = Session::get('cart', []); // Get the current cart from the session

        // Check if the food item already exists in the cart
        if (isset($cart[$foodId])) {
            // If it exists, update the quantity
            $cart[$foodId]['quantity'] += 1;
        } else {
            // If it doesn't exist, add it to the cart
            $cart[$foodId] = [
                'food_id' => $foodId,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart); // Store the updated cart in the session
        // dd($cart);

        return redirect()->back()->with('success', 'Food quantity updated.');

    }
    /**
     * Remove food from the cart or update the quantity.
     */
    public function DecreaseCart(Request $request)
    {
        $foodId = $request->food_id;

        $cart = Session::get('cart', []); // Get the current cart from the session

        // Check if the food item already exists in the cart
        if (isset($cart[$foodId])) {
            $cart[$foodId]['quantity'] -= 1;
            // If it exists, update the quantity
            if ($cart[$foodId]['quantity'] <= 0) {
                unset($cart[$foodId]); // Remove the food item from the cart
            } 
        } 

        Session::put('cart', $cart); // Store the updated cart in the session
        return redirect()->back()->with('success', 'Food quantity updated.');

    }

    
    /**
     * Display a listing of the resource.
     */
    public function DisplayBooking(Request $request)
    {
        
        if(session()->has('order')){
            $data = food::with('category')->get();
            $categories = category::all();

            // Check if id parameter is present
            if ($request->has('id')) {
                $id = $request->input('id');
                $data = food::where('category_id', $id)->with('category')->get();
            } else {
                $data = food::with('category')->get();
            }
        
            return view('user.booking', compact('data', 'categories'));
        }else{
            return view('user.booking');
        }
    }

    /**
     * Display checkout page
     */
    public function Checkout(Request $request)
    {
        if ($request->has('order_id')) {
            $data = order_food::where('order_id' , $request->order_id)->get();
            $total_food = 0;
            foreach ($data as $item) {
                $total_food += $item->price * $item->quantity;
            }            
        }else{

            $data = Session::get('cart', []); // Get the current cart from the session
            $food_details = [];
            $total_food = 0;
            // $data = session('cart');
            // $data = [];

            foreach ($data as $food) {
                $food_id = $food['food_id'];
                // Retrieve the food details based on the food_id
                $food_details[] = [
                    'food' => Food::find($food_id),
                    'quantity' => $food['quantity'],
                ];
                $total_food += $food['quantity'] * $food_details[count($food_details) - 1]['food']->price;
                // echo $food_details[count($food_details) - 1]['food']->name;
            }
        }
        return view('user.checkout', compact('total_food'));
    }

    /**
     * Upload receipt 
     */
    public function UploadReceipt(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'receipt' => 'required|mimes:jpeg,png,bmp,gif,pdf|max:2048', // Allow image (jpeg, png, bmp, gif) and PDF files, maximum size 2MB
        ]);

        if ($request->file('receipt')->isValid()) {
            $file = $request->file('receipt');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            // Move the uploaded file to a specific location
            $path = Storage::putFileAs('public', $file, $fileName);

            // Perform any additional processing or database operations if needed

            //Redirect to dashboard. 

            //Store to db all of the order details.
            $session_order = Session::get('order');
            $booking_date = $session_order['booking_date'];
            $booking_time = $session_order['booking_time'];
            $total_people = $session_order['total_people'];

            $order_id = order::insertGetId([
                'user_id' => Auth::user()->id ,
                'status' => '0' , /// 0 = waiting for approval , 1 = succcess, 2 = failed
                'total_people' => $total_people,
                'booking_date' => $booking_date,
                'booking_time' => $booking_time, 
                'receipt' => $fileName,
                'paid_at' => now(),
                'created_at' => now(),
            ]);

            // Retrieve all of food from cart. 
            $data = Session::get('cart', []); // Get the current cart from the session
            $food_details = [];
            
            foreach ($data as $food) {
                $food_id = $food['food_id'];
                // Retrieve the food details based on the food_id
                $food_details[] = [
                    'food' => Food::find($food_id),
                    'quantity' => $food['quantity'],
                ];
            }

            foreach ($food_details as $detail ){
                order_food::insert([
                    'order_id' => $order_id , 
                    'food_id' => $detail['food']->id, 
                    'quantity' => $detail['quantity'],
                    'price' => $detail['food']->price,
                    'created_at' => now()
                ]);
            }

            Session::forget('cart');
            Session::forget('order');
            
            return redirect()->route('reservation')->with('success', 'Reservation succesfully processed. Please wait for admin to approve your order. Thank you');
        }else{
            return redirect()->back()->with('error', 'Upload receipt failed.');

        }
    }
    /**
     * Update receipt 
     */
    public function UpdateReceipt(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'receipt' => 'required|mimes:jpeg,png,bmp,gif,pdf|max:2048', // Allow image (jpeg, png, bmp, gif) and PDF files, maximum size 2MB
        ]);

        if ($request->file('receipt')->isValid()) {
            if ($request->has('order_id')) {

                $file = $request->file('receipt');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                // Move the uploaded file to a specific location
                $path = Storage::putFileAs('public', $file, $fileName);
                order::where('id', $request->order_id)
                ->update([
                    'receipt' => $fileName,
                    'status' => 0,
                    'feedback' => null,
                ]);
            
            }
            return redirect()->route('reservation')->with('success', 'Reservation succesfully processed. Please wait for admin to approve your order. Thank you');
        }else{
            return redirect()->back()->with('error', 'Upload receipt failed.');

        }
    }

    /**
     * Display reservation history page
     */
    public function ReservationDetail()
    {
        $user_id = Auth::user()->id ;
        $data = order::with('orders.food')
        ->where('user_id' , $user_id)
        ->orderBy('created_at','desc')
        ->get();
        return view('user.reservation' , compact('data'));
    }
    /**
     * Review
     */
    public function Review(Request $request)
    {
        $order_id = $request->order_id;
        $review = $request->review; 
        $update_review = order::find($order_id)->update(['feedback' => $review]);
        $message = "Review updated for Order ID: $order_id. Thank you for sharing your feedback! We appreciate you choosing our services.";

        return redirect()->back()->with('success', $message);
    }

    /**
     * Admin Reservation
     */
    public function AdminReservation()
    {
        $data = Order::with('user_detail','orders.food')
        ->orderBy('created_at', 'desc')
        ->get();    
        return view('admin.reservation' , compact('data'));
    }


    public function UpdateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    if ($request->has('status') && in_array($request->status, [1, 2])) {
        $order->status = $request->status;
        $order->save();

        // Add any additional logic or redirects as needed

        $message = "Order status updated for Order ID: $id";

    }

    return redirect()->back()->with('success', $message);
}
    
}

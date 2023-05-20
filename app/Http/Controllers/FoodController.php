<?php

namespace App\Http\Controllers;

use App\Models\{food,category,food_category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();
        $data = food::with('category')->get();
        return view('admin.DisplayFood' , compact('data' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'food_name' => 'required',
                'price' => 'required',
                'category' => 'required',
                'image' => 'required'
            ]);

  
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::putFileAs('public', $file, $fileName);
            // Save the path to the database or do something else with it
            // $file = Storage::put('public', $file, $fileName);

            // Create a new category in the database
            $food = food::insertGetId([
                'food_name' => $request->input('food_name'),
                'status' => '1',
                'price' => $request->price,
                'category_id' => $request->category,
                'image'=> $fileName,
            ]);
            // Redirect the user back to the categories index page with a success message
            return redirect()->back()->with('success', 'Food created successfully.');
        }

    /**
     * Display the specified resource.
     */
    public function show(food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        // Get the food record to update
        $food = food::findOrFail($request->food_id);

        // Update the fields with new values
        $food->food_name = $request->food_name;
        $food->price = $request->price;
        $food->category_id = $request->category;
        $food->status = $request->status;

        // Check if a new image file was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image file
            Storage::delete('public/' . $food->image);

            // Upload the new image file
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);

            // Update the image field with the new file name
            $food->image = $fileName;
        }

        // Save the updated food record to the database
        $food->save();
        // Redirect the user back to the categories index page with a success message
        return redirect()->back()->with('success', 'Food updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(food $food)
    {
        //
    }

    public function UserView(Request $request)
    {
        $categories = category::all();

        // Check if id parameter is present
        if ($request->has('id')) {
            $id = $request->input('id');
            $data = food::where('category_id', $id)->with('category')->get();
        } else {
            $data = food::with('category')->get();
        }
    
        return view('user.menu', compact('data', 'categories'));
    }
}

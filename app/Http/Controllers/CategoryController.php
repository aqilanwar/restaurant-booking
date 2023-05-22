<?php

namespace App\Http\Controllers;

use App\Models\{category , food};
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::where('is_deleted', false)
        ->withCount(['foods' => function ($query) {
            $query->where('is_deleted', false);
        }])
        ->get();

        // dd(json_decode($data));
        return view('admin.DisplayCategory' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.CreateCategory');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Create a new category in the database
        $category = category::create([
            'name' => $request->input('name'),
            'status' => '1',
        ]);

        // Redirect the user back to the categories index page with a success message
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $category = category::findOrFail($request->category_id);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        if($request->status){
            food::where('category_id', $request->category_id)->update(['status' => true]);
        }else{
            food::where('category_id', $request->category_id)->update(['status' => false]);
        }

        return redirect()->back()->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        category::where('id', $request->id)->update(['is_deleted' => true]);
        food::where('category_id' , $request->id)->update(['is_deleted' => true]);
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Category;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index(Request $request)
    {
        $categories = Category::tree()->get()->toTree();

        return view('categories', compact('categories'));
    }


    public function getData(Request $request)
    {
        // Your logic to fetch the data goes here
        // For example, you could fetch data from the database
        $data = Category::all();
        return response()->json($data);
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
        //

            Category::updateOrCreate(['category'=>$request->category],['parent_id'=>$request->parent_id]);
    
    
            return response()->json(['success'=>'added']);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Category::find($id)->delete($id);
    
        Category::where('parent_id','=',$id)->delete();
        return response()->json([
    
            'success' => 'Record deleted successfully!'
    
        ]);

    }

    
}

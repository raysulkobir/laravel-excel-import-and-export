<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    //TODO supreem_court_bar_association 
    // supreem_court_bar_association
    // 0- 1250

    //TODO dhaka_university_accounting_alumni
    // 0-840

    //TODO Army Golf Club, Dhaka 2021
    // 0-1000
    // 1000-1300
    // 5000
    // SELECT * FROM `contacts` WHERE directory_id = 22 and home_address_line_1 != '';
    // SELECT * FROM `contacts` WHERE directory_id = 22 AND (home_address_line_1 IS NULL OR home_address_line_1 = '');

    public function letter(){
        $data = DB::table('contacts')
            ->where('directory_id', 22)
            ->where('home_address_line_1', '!=', '')
            ->whereBetween('id', [5401, 20000]) 
            ->get();
        // return $data;
        return view('letter', compact('data'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());

        toastr()->success('Product created');
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());

        toastr()->success('Product updated');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toastr()->success('Product deleted');
        return redirect()->route('products.index');
    }
}

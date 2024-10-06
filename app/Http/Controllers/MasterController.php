<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    public function importProductIndex()
    {
        return view('products.import');
    }

    public function importProduct(Request $request)
    {

        $upload = $request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if ($ext != 'csv')
        return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
        $filename =  $upload->getClientOriginalName();
        $filePath = $upload->getRealPath();
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        //validate
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        $data = [];
        while ($columns = fgetcsv($file)) {
            if ($columns[0] == "")
                continue;
            foreach ($columns as $key => $value) {
                $value = preg_replace('/\D/', '', $value);
            }
            array_push($data, array_combine($escapedHeader, $columns));
        }




    }



    public function exportProduct()
    {
        return Excel::download(new ProductsExport, 'products_' . now()->toDateTimeString() . '.xlsx');
    }
}

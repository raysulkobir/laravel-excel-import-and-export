<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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

        return $data;
        return $this->saleAdd($data);
        // return $this->saleProductAdd($data);

    }

    private function saleAdd($sales){
        // return $sales;
        // $sponsorshipCheck = [];
        foreach($sales as $sale){
            $salesById = DB::table('product_sales')
                ->select('sale_id', 'created_at', DB::raw('SUM(total) as total_price'), DB::raw('SUM(qty) as qty_sum'), DB::raw('SUM(subsidy) as total_discount'))
                ->groupBy('sale_id', 'created_at')
                ->where('sale_id', $sale['saleinv'])
                ->first();

            $subsidy_amount = $salesById->total_discount;
            $total_price = $salesById->total_price;
            $grand_total = $total_price - $subsidy_amount;

            $paid_amount = $sale['cashone'] + $sale['cashtwo'];

            $sponsorshipData = $this->sponsorshipCheck($sale);
            // array_push($sponsorshipCheck, $a);

            $date = \DateTime::createFromFormat('d/m/Y', $sale['date']);

            if ($date) {
                // $date->setTime(4, 0, 50);
                $formattedDate = $date->format('Y-m-d H:i:s');
            } else {
                $formattedDate = date('Y-m-d H:i:s'); // Use current date-time as a fallback
            }

            DB::table('sales')->insert([
                'reference_no' => $sale['saleinv'],
                'sales_date' => $formattedDate,
                'financial_year_id' => 1,
                'patient_id' => $sale['ptid'],
                'user_id' => 1,
                'warehouse_id' => 1,
                'item' => 0,
                'total_qty' => $salesById->qty_sum,
                'subsidy_amount' => $subsidy_amount,
                'order_discount' => 0,
                'total_discount' => 0,
                'sponsorship_id' => $sponsorshipData[1],
                'sponsorship_amount' => $sponsorshipData[0],
                'total_price' => $total_price,
                'grand_total' => $grand_total,
                'paid_amount' => $sponsorshipData[1] ? $sponsorshipData[0] : $paid_amount,
                'sale_status' => 1,
                'payment_status' => 1,
            ]);
        }
    }

    private function sponsorshipCheck($sale){
        if ($sale['zakat'] > 0) {
            return [$sale['zakat'], 1];
        }else if($sale['monowara'] > 0){
            return [$sale['monowara'], 2];
        }else if($sale['enosis'] > 0){
            return [$sale['enosis'], 3];
        }else if($sale['sponsor'] > 0){
            return [$sale['sponsor'], 4];
        }else if($sale['poorfund'] > 0){
            return [$sale['poorfund'], 5];
        }else if($sale['prenatal'] > 0){
            return [$sale['prenatal'], 6];
        }else{
            return [0, 0];
        }
        return $sale;
    }


    //TODO Sale Produc
    private function saleProductAdd($products){
        // return count($products);
        $rAllData = [];
        foreach($products as $product){
            $date = \DateTime::createFromFormat('d/m/Y', $product['saledate']);

            if ($date) {
                // $date->setTime(4,0,50);
                $formattedDate = $date->format('Y-m-d H:i:s');
            } else {
                $formattedDate = date('Y-m-d H:i:s'); // Use current date-time as a fallback
            }

            $discount = $product['comm'] + $product['mswsubsid'];

            $total = $product['ttlprice'] - $discount;


            // $rData = [
            //     'sale_id' => $product['saleinv'],
            //     'purchase_id' => 0,
            //     'product_id' => $product['itemid'],
            //     'qty' => $product['quantity'],
            //     'sale_unit_id' => 1,
            //     'product_purchase_price' => 1,
            //     'product_sell_price' => $product['unitrate'],
            //     'subsidy' => $product['mswsubsid'],
            //     'total' => $product['ttlprice'],
            //     'created_at' => $formattedDate,
            // ];

            // array_push($rAllData, $rData);


            DB::table('product_sales')->insert([
                'sale_id' => $product['saleinv'],
                'purchase_id' => 0,
                'product_id' => $product['itemid'],
                'qty' => $product['quantity'],
                'sale_unit_id' =>1,
                'product_purchase_price' => 1,
                'product_sell_price' => $product['unitrate'],
                'subsidy' => $product['mswsubsid'],
                'total' => $product['ttlprice'],
                'created_at' => $formattedDate,
            ]);
        }

        // Insert data into the product_sales table
        // DB::table('product_sales')->insert($rAllData);
        return "done";
        // return $rAllData;
        // return count($rAllData);
    }


    public function saleIdChange(){
        return "ok";
        $sales = DB::table('sales')
        ->skip(0)
        ->take(1)
        ->get();

        foreach($sales as $sale){
            $product_sales = DB::table('product_sales')->where('sale_id', $sale->reference_no)->get();
            foreach($product_sales as $product){
                DB::table('product_sales')->where('sale_id', $sale->reference_no)->update([
                    'sale_id' => $sale->id,
                ]);
            }
        }

        return "done 1300-1700";
    }

    public function exportProduct()
    {
        return Excel::download(new ProductsExport, 'products_' . now()->toDateTimeString() . '.xlsx');
    }
}

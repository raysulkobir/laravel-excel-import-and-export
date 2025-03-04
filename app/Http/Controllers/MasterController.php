<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use PhpParser\Node\Expr\FuncCall;
use App\Services\VicidialServices;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    protected $vicidialServices;

    public function __construct(VicidialServices $vicidialServices)
    {
        $this->vicidialServices = $vicidialServices;
    }
    public function importProductIndex()
    {
        return view('products.import');
    }

    public function importProduct(Request $request)
    {
        // $jsonFilePath = public_path('db/supreem_court_bar_association.json');
        // $jsonFilePath = public_path('db/institute_of_engineers.json');
        // $jsonFilePath = public_path('db/chittrong-district-bar-association.json');
        // $jsonFilePath = public_path('db/Bangladesh-Association-of-Publicly-Listed-Companies-(BAPLC).json');
        // $jsonFilePath = public_path('db/Bangladesh-college-of-physician-and-surgeons.json');
        $jsonFilePath = public_path('db/dhaka-university-accounting-alumni1.json');
 
 

        // Check if the file exists
        if (!File::exists($jsonFilePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read the JSON file
        $jsonContent = File::get($jsonFilePath);

        // Decode JSON to an associative array
        $data = json_decode($jsonContent, true);

        // Return JSON response
        // return $this->supreem_court_bar_association($data);
        // return $this->institute_of_engineers($data);
        // return $this->chittrong_district_bar_association($data);
        // return $this->bangladesh_Association_of_Publicly_Listed_Companies($data['Sheet1']);
        // return $this->Bangladesh_college_of_physician_and_surgeons($data);
        return $this->dhaka_university_accounting_alumni($data);
        // return $data;
    }


    public function dhaka_university_accounting_alumni($data)
    {
        // return $data;
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    $insertData[] = [
                        'type' => 'dhaka_university_accounting_alumni',
                        'web-scraper-orde' => @$d['web-scraper-orde'],
                        'web-scraper-start-url' => @$d['web-scraper-start-url'],
                        'image-src' => @$d['image-src'],
                        'id_no' => @$d['id_no'],
                        'batch' => @$d['batch'],
                        'designation' => @$d['designation'],
                        'orgnization' => @$d['orgnization'],
                        'link' => @$d['link'],
                        'link-href' => @$d['link-href'],
                        'name1' => @$d['name1'],
                        'designation1' => @$d['designation1'],
                        'organization1' => @$d['organization1'],
                        'address' => @$d['address'],
                        'telephone_office' => @$d['telephone_office'],
                        'telephone_res' => @$d['telephone_res'],
                        'mobile' => @$d['mobile'],
                        'email' => @$d['email'],
                        'name' => @$d['name'],
                       
                    ];

                }
                // return $insertData;
                Product::insert($insertData);  // Bulk insert
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "okdd";
    }
    public function Bangladesh_college_of_physician_and_surgeons($data)
    {
        // return $data;
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    $insertData[] = [
                        'type' => 'bangladesh_Association_of_Publicly_Listed_Companies',
                        'subject' => @$d['subject'],
                        'fellow_id' => @$d['fellow_id'],
                        'year_of_fellowship' => @$d['year_of_fellowship'],
                        'name' => @$d['name'],
                        'institute' => @$d['institute'] ? $d['institute'] : '',
                    ];

                }
                // return $insertData;
                Product::insert($insertData);  // Bulk insert
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "okdd";
    }

    public function bangladesh_Association_of_Publicly_Listed_Companies($data)
    {
        // return $data;
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    $insertData[] = [
                        'type' => 'bangladesh_Association_of_Publicly_Listed_Companies',
                        'web-scraper-order' => $d['web-scraper-order'],
                        'web-scraper-start-url' => $d['web-scraper-start-url'],
                        'cid' => $d['cid'],
                        'company_name' => $d['company_name'],
                        'address' => $d['address'],
                        'phone' => $d['phone'],
                        'link' => $d['link'],
                        'link-href' => $d['link-href'],
                        'contact_person' => $d['contact_person'],
                        'designation' => $d['designation'],
                        'phone1' => $d['phone1'],
                        'mobile' => $d['mobile'],
                        'fax' => $d['fax'],
                        'emails' => $d['emails'],
                        'website' => $d['website'],
                    ];
                }
                Product::insert($insertData);  // Bulk insert
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "okdd";
    }

    public function chittrong_district_bar_association($data)
    {
        // return $data;
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    $insertData[] = [
                        'type' => 'chittrong-district-bar-association',
                        'memberId' => $d['memberId'],
                        'memberName' => $d['memberName'],
                        'spouseName' => $d['spouseName'],
                        'fatherName' => $d['fatherName'],
                        'motherName' => $d['motherName'],
                        'mobile' => $d['mobile'],
                        'email' => $d['email'],
                        'linNo' => $d['linNo'],
                        'picture' => $d['picture'],
                        'dateOfBirth' => $d['dateOfBirth'],
                        'nid' => $d['nid'],
                        'bloodGroup' => $d['bloodGroup'],
                        'maritalStatus' => $d['maritalStatus'],
                        'religion' => $d['religion'],
                        'presentAddress' => $d['presentAddress'],
                        'parmanentAddress' => $d['parmanentAddress'],
                        'chamberAddress' => $d['chamberAddress'],
                        'status' => $d['status'],
                        'barDateOfEnrollment' => $d['barDateOfEnrollment'],
                        'barCourtType' => $d['barCourtType'],
                        'sanadNo' => $d['sanadNo'],
                    ];
                }
                Product::insert($insertData);  // Bulk insert
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "okdd";
    }

    public function institute_of_engineers($data)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    if (!empty($d['name'])) {
                        $insertData[] = [
                            'type' => 'institute_of_engineers',
                            'name' => $d['name'],
                            'address' => $d['address'],
                            'email' => $d['email'],
                            'division' => $d['division'],
                            'center' => $d['center'],
                            'institution' => $d['institution'],
                            'passingYear' => $d['passingYear'],
                            'membershipNo' => $d['membershipNo'],
                            'imageSrc' => $d['imageSrc'],
                            'mobile' => $d['mobile'],
                    
                        ];
                    }
                }

                Product::insert($insertData);  // Bulk insert
                // return __LINE__;
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "ok";
    }
    
    public function supreem_court_bar_association($data)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            $chunkSize = 100;
            $chunks = array_chunk($data, $chunkSize);

            foreach ($chunks as $chunk) {
                $insertData = [];

                foreach ($chunk as $d) {
                    $insertData[] = [
                        'type' => 'supreem_court_bar_association',
                        'memberId' => $d['memberId'],
                        'memberName' => $d['memberName'],
                        'spouseName' => $d['spouseName'],
                        'fatherName' => $d['fatherName'],
                        'motherName' => $d['motherName'],
                        'mobile' => $d['mobile'],
                        'email' => $d['email'],
                        'picture' => $d['picture'],
                        'dateOfBirth' => $d['dateOfBirth'],
                        'nid' => $d['nid'],
                        'bloodGroup' => $d['bloodGroup'],
                        'maritalStatus' => $d['maritalStatus'],
                        'religion' => $d['religion'],
                        'presentAddress' => isset($d['presentAddress']) ? $d['presentAddress'] : '',
                        'parmanentAddress' => isset($d['parmanentAddress']) ? $d['parmanentAddress'] : '',
                        'chamberAddress' => $d['chamberAddress'],
                        'status' => $d['status'],
                        'barDateOfJoining' => $d['barDateOfJoining'],
                        'barDateOfEnrollment' => $d['barDateOfEnrollment'],
                        'barCourtType' => $d['barCourtType'],
                        'starMark' => $d['starMark'],
                        'chamberStatus' => $d['chamberStatus'],
                    ];
                }

                Product::insert($insertData);  // Bulk insert
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return "ok";
    }



    private function saleAdd($sales)
    {
        // return $sales;
        // $sponsorshipCheck = [];
        foreach ($sales as $sale) {
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

    private function sponsorshipCheck($sale)
    {
        if ($sale['zakat'] > 0) {
            return [$sale['zakat'], 1];
        } else if ($sale['monowara'] > 0) {
            return [$sale['monowara'], 2];
        } else if ($sale['enosis'] > 0) {
            return [$sale['enosis'], 3];
        } else if ($sale['sponsor'] > 0) {
            return [$sale['sponsor'], 4];
        } else if ($sale['poorfund'] > 0) {
            return [$sale['poorfund'], 5];
        } else if ($sale['prenatal'] > 0) {
            return [$sale['prenatal'], 6];
        } else {
            return [0, 0];
        }
        return $sale;
    }


    //TODO Sale Produc
    private function saleProductAdd($products)
    {
        // return count($products);
        $rAllData = [];
        foreach ($products as $product) {
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
                'sale_unit_id' => 1,
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


    public function saleIdChange()
    {
        return "ok";
        $sales = DB::table('sales')
            ->skip(0)
            ->take(1)
            ->get();

        foreach ($sales as $sale) {
            $product_sales = DB::table('product_sales')->where('sale_id', $sale->reference_no)->get();
            foreach ($product_sales as $product) {
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

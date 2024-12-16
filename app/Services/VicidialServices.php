<?php

namespace App\Services;

use App\Models\Donor;
use Illuminate\Support\Facades\Log;

class VicidialServices
{
    /**
     * Import donor data from a JSON object.
     *
     * @param array $data
     * @return Donor|null
     */
    public function mongoData(array $data)
    {
        // return $data;
        try {
            foreach ($data as $key => $value) {
                // return $value;
                // return $value['mobileno'];
                $donor = new Donor();
                $donor->donor_name = $value['donorname'];
                $donor->mobile_no = $value['mobileno'];
                $donor->blood_group = $value['bloodgroup'];
                $donor->email_address = $value['emailaddress'];
                $donor->address_line_1 = $value['addressline'];
                $donor->address_line_2 = $value['addresslindistrict'];

                // $donor->donor_id = $value['donorId'];
                // $donor->date_of_last_donation = $value['dateOfLastDonation'];
                // $donor->old_donor_id = $value['oldDonorId'];
                // $donor->sort = $value['sort'];
                $donor->save();
            }
            return "success";
        } catch (\Exception $e) {
            return $e;
            // Log any errors for debugging
            Log::error('Error importing donor data: ' . $e->getMessage());
            return null;
        }
    }
}

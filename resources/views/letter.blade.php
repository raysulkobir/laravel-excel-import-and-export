<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>www.thals.org</title>
    <style>
        /* Set page size to A4 for printing */
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .label {
            /* Adjust width to fit the page */
            width: 600px;
            /* Set a maximum width for the label */
            /* border: 2px solid black; */
            /* padding: 15px; */
            margin: 0 auto;
            /* Center the label on the page */
            text-align: left;
            display: grid;
        
        }

        .recipient {
            margin-top: 100px;
            margin-left:150px; 
            padding: 0 10px;
            /* margin: 5px; */
        }

        .bold {
            font-weight: bold;
        }

         /* Ensure page break works */
        .page-break {
            page-break-before: always;  /* Ensures new page starts */
            display: block;
            width: 100%;
            height: 0px;  /* Prevents unwanted spacing */
        }

 

        /* For printing only */
        @media print {
            body {
                margin: 0;
                padding: 0;
                margin: 0 auto;
            }

            .label {
                margin: 0;
                padding: 2mm;
                /* Adjust padding for print */
            }
            /* Ensure proper page breaks */
        .page-break {
            page-break-before: always; /* Older browsers */
            break-before: page; /* Modern browsers */
            display: block;
            width: 100%;
            height: 0px; /* Prevents unwanted extra space */
            clear: both;
        }

        }
    </style>
</head>

<body>
    <div class="label">
        @php
        function removed($d) {
            // Remove the phone numbers (CELL, TEL, or any phone number like 01719-687726)
            $data = preg_replace('/(CELL:\s*\d{5}-\d{6},?\s*)|(TEL:\s*\d{6},?\s*)|(\d{5}-\d{6})/', '', $d);
            
            // Remove the trailing comma, if there is one, at the end of the string
            $data = rtrim($data, ','); 

            return trim($data); // Remove any extra spaces left after replacement
        }


        $count = count($data);
        $i = 0;

        @endphp
            @foreach ($data as $index => $d)
        @php
            $i++;
        @endphp
            <div class="recipient">
                <p><strong>{{ $d->first_name }}</strong></p>
                {{-- <p>{{ removed($d->presentAddress) }}</p> --}}
                <p>{{ $d->home_address_line_1 }}</p>
            </div>

            @if($count > $i)
                <div class="page-break"></div> 
            @endif
        @endforeach
    </div>

</body>

</html>

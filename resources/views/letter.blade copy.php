<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailing Label</title>
    <style>
        /* Set page size to A4 for printing */
        @page {
            size: A4;
            margin: 20mm;
            border: 1px solid black;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .label {
            width: 90%; /* Adjust width to fit the page */
            max-width: 300px; /* Set a maximum width for the label */
            border: 2px solid black;
            padding: 15px;
            margin: 10mm auto; /* Center the label on the page */
            text-align: left;
        }

        .recipient {
            margin-bottom: 10px;
        }

        .bold {
            font-weight: bold;
        }

        /* For printing only */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .label {
                margin: 0;
                padding: 10mm; /* Adjust padding for print */
            }
        }
    </style>
</head>
<body>
    <div class="label">
        <div class="recipient">
            @foreach($data as $d)
            <p><strong>{{ $d->memberName }}</strong> </p>
            <p>{{ $d->presentAddress }}</p>
            @endforeach
        </div>
    </div>
</body>
</html>

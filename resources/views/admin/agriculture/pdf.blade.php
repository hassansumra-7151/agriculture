<!DOCTYPE html>
<html>
<head>
    <title>Agriculture Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Ensure there's no margin on the body */
        }
        .container {
            width: 100%;
            margin: 0 auto; /* Center the content horizontally */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        @page {
            size: A3;
            margin: 10mm; /* Adjust margins as needed */
        }
    </style>
</head>
<body>

    <h3>Agriculture Data Report</h3>

    <table>
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Crop Name</th>
                <th>Total Area</th>
                <th>Plow Name</th>
                <th>See</th>
                <th>Plow Price</th>
                <th>Fertilizer Name</th>
                <th>Fertilizer Quantity</th>
                <th>Fertilizer Price</th>
                <th>Spray Name</th>
                <th>Spray Price</th>
                <th>Labour Work</th>
                <th>Labour Price</th>
                <th>Total Bill</th> <!-- New column for Total Bill -->
            </tr>
        </thead>
        <tbody>
            @php $subtotal = 0; @endphp
            @foreach ($agricultures as $index => $agriculture)
                @php
                    $totalBill = $agriculture->plow_price + 
                                 $agriculture->fertilizer_price + 
                                 $agriculture->sapray_price + 
                                 $agriculture->labour_price;
                    $subtotal += $totalBill;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $agriculture->agriculture_name }}</td>
                    <td>{{ $agriculture->total_area }}</td>
                    <td>{{ $agriculture->plow_name }}</td>
                    <td>{{ $agriculture->see }}</td>
                    <td>{{ $agriculture->plow_price }}</td>
                    <td>{{ $agriculture->fertilizer_name }}</td>
                    <td>{{ $agriculture->fertilizer_qty }}</td>
                    <td>{{ $agriculture->fertilizer_price }}</td>
                    <td>{{ $agriculture->sapray_name }}</td>
                    <td>{{ $agriculture->sapray_price }}</td>
                    <td>{{ $agriculture->labour_work }}</td>
                    <td>{{ $agriculture->labour_price }}</td>
                    <td>{{ $totalBill }}</td> <!-- Display Total Bill -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="13" class="subtotal">Sub Total:</td>
                <td>{{ $subtotal }}</td> <!-- Display Sub Total -->
            </tr>
        </tfoot>
    </table>

</body>
</html>

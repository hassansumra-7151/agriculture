
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="PDF, HTML, meta tags, document">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="pdf:page-orientation" content="portrait">
    <meta name="pdf:page-size" content="A4">
    <title>Amazon Invoice</title>

    <style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <img style="width: 200px; height: auto;" src="{{ public_path('amazon_invoice/Amazon.png') }}" alt="">
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;">
                    <span>Invoice Number: <b>8713175-8353952</b></span>
                    <br>
                    <span>Invoice Date: <b>{{ $product->product_name }}</b></span>
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <span>Invoice Number: <b>8713175-8353952</b></span>
                    <br>
                    <span>Invoice Date: <b>10 Aug 2024</b></span>
                </td>
                <td style="width: 50%;"></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <span>BILL TO: <b>Abdulmohsen</b></span>
                    <br>
                    <span>Billing Currency: <b>{{ $product->price }}</b></span>

                </td>
                <td style="width: 50%;"></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <tbody>
            <tr>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">S No</th>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">Producy Name</th>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">Product Unit Price</th>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">Discount</th>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">Product Quantity</th>
                <th style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">Gross Price</th>
            </tr>
            <tr>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">0001</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">{{ $product->product_name }}</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">{{ $product->price }}</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">0</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">1</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">{{ $product->price }}</td>
            </tr>
            <tr>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
            </tr>
            <tr>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
            </tr>
            <tr>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 15px 5px;"></td>
            </tr>
            <tr>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;" colspan="5">Total Amount</td>
                <td style="border: 1px black solid; text-align: center; vertical-align: center; padding: 5px;">21.00</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <div><b>Terms and Conditions</b></div>
    <br><br>
    <div style="text-align: center;"><b>Thank you for your business</b></div>

</body>
</html>
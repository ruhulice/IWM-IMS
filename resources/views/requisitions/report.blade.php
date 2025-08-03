<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisition Report</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }
            #printPageButton {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20mm;
            width: 210mm;
            height: auto;
            box-sizing: border-box;
        }

        .main_container {
            width: 100%;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .content p {
            margin: 4px 0;
            font-size: 14px;
        }

        table.table-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.table-container th,
        table.table-container td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 14px;
            text-align: left;
        }

        table.table-container th {
            background-color: #f0f0f0;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .printButton {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <button id="printPageButton" class="printButton" onclick="window.print()">Print</button>

    <div class="main_container">
        <div class="header">
            <img src="{{ asset('assets/landing/images/iwm2024.png') }}" alt="Logo">
            <h1>INSTITUTE OF WATER MODELLING</h1>
            <p>IWM BHABAN, House 06, Road 3C, Block H, Sector 15, Uttara, Dhaka 1230, Bangladesh</p>
            <p><strong>Requisition (User's Copy)</strong></p>
            <p>Sl No. <strong>{{ $items[0]->id }}</strong></p>
        </div>
        <div class="content">
            <p><strong>TO:</strong> DED</p>
            <p><strong>Through:</strong> Director, {{ $items[0]->divisionname }} Division</p>
            <p><strong>From:</strong> {{ $items[0]->name }}</p>
            <p><strong>Subject:</strong> Procuring items for {{ $items[0]->divisionname }} Division from Project-{{ $items[0]->projectno }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($items[0]->requisitiondate)->format('d M Y') }}</p>
            <br>
            <hr>
            <br>
            <p><strong>Purpose of Requisition:</strong> {{ $items[0]->reqpurpose }}</p>
            <br>
        </div>

        <table class="table-container">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Technical Specification</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Price (incl. VAT & IT)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPrice = 0; @endphp
                @foreach($items as $key => $item)
                    @php $totalPrice += $item->price; @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->categoryname }}</td>
                        <td>{{ $item->subcategoryname }}</td>
                        <td>{{ $item->techspecification }}</td>
                        <td>{{ number_format($item->rate, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="6" style="text-align: right;">Total Amount (BDT):</td>
                    <td>{{ number_format($totalPrice, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="content" style="margin-top: 30px;">
            <p>
                <strong>
                I request your kind approval to procure the above items at a total cost of TK: {{ number_format($totalPrice, 2) }}
                </strong>(<span id="totalInWords"></span>) <strong> including VAT & IT under {{ $items[0]->divisionname }} Division from Project-{{ $items[0]->projectno }}.
                </strong>
            </p>
            <br>
            <p>Recommended by the procurement committee:</p>
        </div>

    </div>
    <script>
    function numberToWords(num) {
        const a = [
            '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven',
            'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen',
            'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen',
            'Nineteen'
        ];
        const b = [
            '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty',
            'Sixty', 'Seventy', 'Eighty', 'Ninety'
        ];

        function convert(n) {
            if (n < 20) return a[n];
            if (n < 100) return b[Math.floor(n / 10)] + (n % 10 ? ' ' + a[n % 10] : '');
            if (n < 1000) return a[Math.floor(n / 100)] + ' Hundred' + (n % 100 ? ' and ' + convert(n % 100) : '');
            if (n < 100000) return convert(Math.floor(n / 1000)) + ' Thousand' + (n % 1000 ? ' ' + convert(n % 1000) : '');
            if (n < 10000000) return convert(Math.floor(n / 100000)) + ' Lakh' + (n % 100000 ? ' ' + convert(n % 100000) : '');
            return convert(Math.floor(n / 10000000)) + ' Crore' + (n % 10000000 ? ' ' + convert(n % 10000000) : '');
        }

        return convert(num) + ' Taka only';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const total = parseFloat("{{ $totalPrice }}");
        const inWords = numberToWords(Math.round(total));
        document.getElementById('totalInWords').innerText = inWords;
    });
</script>

</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisition</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }
            #printPageButton {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            box-sizing: border-box;
        }

        .main_container {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 310mm;
            padding: 20mm;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            margin: 5px 0;
            font-size: 14px;
        }

        .table-container {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 14px;
            text-align: left;
        }

        .footer {
            /* margin-top: 20px; */
            border-top: 1px solid #000;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .footer div {
            width: 48%;
        }
        
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature div {
            width: 48%;
        }

        .printButton {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <button id="printPageButton" class="printButton" onclick="window.print()">Print</button>
 
        <div class="main_container">
            <div class="header">
                <img src="{{ asset('assets/landing/images/iwm2024.png') }}" alt="Logo">
                <h1>INSTITUTE OF WATER MODELLING</h1>
                <p>Plot # 06, Road-3/C, Block-H, Sector-15, Uttara, Dhaka-1230, BANGLADESH</p>
       
                <p>Requisition (user's Copy)</p>


                <p>Sl No. <strong>{{ $items[0]->id }}</strong></p>
            </div>

            <div class="content">
                <div>
                   <strong>
                   <p>TO      : DED</p>
                   <p>Through : Director,{{ $items[0]->divisionname}} Division</p>
                   <p>From    : {{ $items[0]->name }}</p>
                   <p>Subject : Procuring items for {{ $items[0]->divisionname }} division from project-{{ $items[0]->projectno }}</p>
                   <p>Date    : {{ \Carbon\Carbon::parse($items[0]->requisitiondate)->format('d M Y') }}</p>
                   </strong>              
                </div>
                 <hr>
                 <div>
                    <p><strong>Purpose of Requisition: </strong>{{ $items[0]->reqpurpose }}</p>
                 </div>
                
            </div>

            <table class="table-container">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Technical Specification</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Price(including VAT & IT)</th>
                </tr>
                @foreach($items  as $key=>$item)
                    <tr> 
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->categoryname }}</td>
                        <td>{{ $item->subcategoryname }}</td>
                        <td>{{ $item->techspecification }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                          
                    </tr>
                @endforeach
            </table>
            <br><br>

            <div class="content">
                <div>
                    <strong><p>I request your kind approval to procure above items at a total cost of including VAT & IT under {{ $items[0]->divisionname}} Division from project-{{ $items[0]->projectno }}</p></strong>
                </div>
                <div>
                    <p>Recommended by the procerement committee:</p>
                </div>
            </div>
        </div>
        <br><br/>
  
</body>


</html> --}}


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate Pass</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }
            #printPageButton {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            box-sizing: border-box;
        }

        .main_container {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 310mm;
            padding: 20mm;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            margin: 5px 0;
            font-size: 14px;
        }

        .table-container {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 14px;
            text-align: left;
        }

        .footer {
            /* margin-top: 20px; */
            border-top: 1px solid #000;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .footer div {
            width: 48%;
        }
        
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature div {
            width: 48%;
        }

        .printButton {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <button id="printPageButton" class="printButton" onclick="window.print()">Print</button>
    @for($i = 0; $i < 3; $i++)
        <div class="main_container">
            <div class="header">
                <img src="{{ asset('assets/landing-assets/img/iwm2024.png') }}" alt="Logo">
                <h1>INSTITUTE OF WATER MODELLING</h1>
                <p>Plot # 06, Road-3/C, Block-H, Sector-15, Uttara, Dhaka-1230, BANGLADESH</p>

                @if($i == 0)
                    <p>GATE PASS (Gate keeper's Copy)</p>
                @elseif($i == 1)
                    <p>GATE PASS (Equipment Holder's Copy)</p>
                @elseif($i == 2)
                    <p>GATE PASS (Office Copy)</p>
                @endif

                <p>Sl No. <strong>{{ $items[0]->gate_pass_no }}</strong></p> 
            </div>

            <div class="content">
                <p>Mr. <strong>{{ $items[0]->name }}</strong> is allowed to take the following items of equipment / computer for repair / use in the field / rental for external use.</p>
                <p>Project No: <strong>{{ $items[0]->projectno }}</strong></p>
            </div>

            <table class="table-container">
                <tr>
                    <th>ID</th>
                    <th>Equipment Name</th>
                    <th>Equipment ID</th>
                    <th>Quantity</th>
                    <th>Expected date of return</th>
                    <th>Remarks</th>
                </tr>
                @foreach($items  as $key=>$item)
                    <tr> 
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->categoryname }}</td>
                        <td>{{ $item->subcategoryname }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->requisitiondate)->format('d M Y') }}</td>
                       <td>{{ $item->techspecification }}</td>
                    </tr>
                @endforeach
            </table>

             <div class="footer">
                <div>
                    <p>Received by:</p>
                    <p>Name: {{ $items[0]->received_by }}</p>
                    <p>Address: {{ $items[0]->receiver_address }}</p>
                    <p>Signature:</p>
                    <p>Date: {{ \Carbon\Carbon::parse($items[0]->received_date)->format('d M Y') }}</p>
                </div>
                <div>
                    <p>Issued by: {{ $items[0]->issued_by }}</p>
                    <p>Date: {{ \Carbon\Carbon::parse($items[0]->issued_date)->format('d M Y') }}</p>
                    <p>Equipment Manager / Store Keeper</p>
                </div>
            </div>

            <div class="signature">
                <div>
                    <p>Actual date of return: __________________</p>
                </div>
                <div>
                    <p>Received by: {{ $items[0]->received_by }}</p>
                </div>
            </div> 
        </div>
        <br><br/>
    @endfor
</body>


</html>

 --}}

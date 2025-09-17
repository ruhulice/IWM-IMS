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
                margin: 10mm;
            }

            #printPageButton {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10mm;
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
            <p><strong>Internal Memo</strong></p>
            <p>Sl No. <strong>{{ $items[0]->id }}</strong></p>
        </div>
        <div class="content">
            <p><strong>TO: </strong>Executive Director</p>
            <p><strong>Through:</strong> DED (Operation)</p>
            <p><strong>Through:</strong> Director, {{ $items[0]->divisionname }} Division</p>
            <p><strong>From:</strong>{{ $items[0]->name }} ({{ $items[0]->user_name }})</p>
            <p><strong>Subject:</strong> Procuring items under ICT Systems.</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($items[0]->requisitiondate)->format('d M Y') }}</p>
            <br>
            <hr>
            <br>
            <p><strong>Purpose of Memo:</strong> {{ $items[0]->reqpurpose }}</p>
            <br>
        </div>

        <table class="table-container">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Technical Specification</th>
                    <th>Division</th>
                    <th>Project</th>
                    <th>Initial</th>
                    <th>Unit Price(Approx.)</th>
                    <th>Quantity</th>
                    <th>Price (incl. VAT & IT)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPrice = 0; @endphp
                @foreach ($items as $key => $item)
                    @php $totalPrice += $item->price; @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->categoryname }}</td>
                        <td>{{ $item->subcategoryname }}</td>
                        <td>{{ $item->techspecification }}</td>
                        <td>{{ $item->divisionname }}</td>
                        <td>{{ $item->projectno }}</td>
                        <td>{{ $item->empinitial }}</td>
                        <td>{{ number_format($item->rate, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="9" style="text-align: right;">Total Amount (BDT):</td>
                    <td>{{ number_format($totalPrice, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="content" style="margin-top: 30px;">
            <p>
                <strong>
                    I request your kind approval to procure the above items at a total cost of TK:
                    {{ number_format($totalPrice, 2) }}
                </strong>(<span id="totalInWords"></span>) <strong> including VAT & IT under
                    {{ $items[0]->divisionname }} Division from Project-{{ $items[0]->projectno }}.
                </strong>
            </p>
            <br>
            <p>Recommended by the procurement committee:</p>
        </div>
        <div class="content" style="margin-top: 30px;">
            <div class="approval-flow-list" style="display: flex; gap: 20px; margin-top: 30px;">
                @foreach ($approvalFlows as $flow)
                    <div style="min-width: 50px;">
                        <p>{{ $flow->status }} By</p>
                        <br>
                        <p class="text-center">{{ $flow->name }} ({{ $flow->user_name }})</p>
                        <p>{{ $flow->submitdate }}</p>
                        <hr>
                        <p class="text-center"><strong>{{ $flow->designation }}</strong></p>

                    </div>
                @endforeach
            </div>
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
                if (n < 100000) return convert(Math.floor(n / 1000)) + ' Thousand' + (n % 1000 ? ' ' + convert(n % 1000) :
                    '');
                if (n < 10000000) return convert(Math.floor(n / 100000)) + ' Lakh' + (n % 100000 ? ' ' + convert(n %
                    100000) : '');
                return convert(Math.floor(n / 10000000)) + ' Crore' + (n % 10000000 ? ' ' + convert(n % 10000000) : '');
            }

            return convert(num) + ' Taka only';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const total = parseFloat("{{ $totalPrice }}");
            const inWords = numberToWords(Math.round(total));
            document.getElementById('totalInWords').innerText = inWords;
        });
    </script>

</body>

</html>

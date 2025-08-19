@extends('layouts.backend-master')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" />
@endsection

@section('content')
    <div class="bg-body-light border-b">
        <div class="content py-1 text-center">
            <nav class="breadcrumb bg-body-light mb-1" style="font-size: 14px;">
                <a class="breadcrumb-item" href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                <span class="breadcrumb-item active">Requisition Dashboard</span>
            </nav>
        </div>
    </div>

    <div class="content p-3">
        <!-- Requisition Info -->
        <div class="content mb-3">
            <div class="row">
                <div class="col-md-4"><strong>Memo No:</strong> {{ $requisitions[0]->id }}</div>
                <div class="col-md-4"><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($requisitions[0]->requisitiondate)->format('d M Y') }}
                </div>
                <div class="col-md-4"><strong>Created By:</strong> {{ $requisitions[0]->name }}</div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4"><strong>Division:</strong> {{ $requisitions[0]->divisionname }}</div>
                <div class="col-md-4"><strong>Project No:</strong> {{ $requisitions[0]->projectno }}</div>
            </div>
            <hr>
            <p><strong>Purpose of Requisition:</strong> {{ $requisitions[0]->reqpurpose }}</p>
        </div>

        <!-- Requisition Table -->
        <div class="content mb-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Technical Specification</th>
                            <th>Rate(Approx.)</th>
                            <th>Quantity</th>
                            <th>UoM</th>
                            <th>Price(with VAT & IT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalPrice = 0; @endphp
                        @foreach ($requisitions as $index => $req)
                            @php $totalPrice += $req->price; @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $req->categoryname }}</td>
                                <td>{{ $req->subcategoryname }}</td>
                                <td>{{ $req->techspecification }}</td>
                                <td class="text-right">{{ number_format($req->rate, 2) }}</td>
                                <td class="text-center">{{ $req->quantity }}</td>
                                <td class="text-center">{{ $req->uom }}</td>
                                <td class="text-right">{{ number_format($req->price, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="table-secondary">
                            <td colspan="7" class="text-end"><strong>Total Amount (BDT):</strong></td>
                            <td class="text-right"><strong>{{ number_format($totalPrice, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Attached Documents Section -->
        @forelse ($documents ?? [] as $doc)
            <div class="content mt-3 border p-2 rounded">
                <div class="d-flex align-items-center mb-2">
                    <p class="mb-0 mr-3">
                        Attached {{ $doc->documenttype == 1 ? 'PDF' : 'MSG' }}:
                    </p>

                    @if ($doc->documenttype == 1)
                        <!-- PDF toggle button -->
                        <button class="btn btn-outline-primary mr-3 togglePdf" data-target="pdf-{{ $doc->id }}">
                            View / Download
                        </button>
                        <a href="{{ asset('storage/' . $doc->path) }}" class="btn btn-secondary" target="_blank">
                            Download PDF
                        </a>
                    @else
                        <!-- MSG file download -->
                        <a href="{{ asset('storage/' . $doc->path) }}" class="btn btn-secondary" download>
                            Download MSG
                        </a>
                    @endif
                </div>

                @if ($doc->documenttype == 1)
                    <div class="mt-2 pdfContainer" id="pdf-{{ $doc->id }}" style="display: none;">
                        <embed src="{{ asset('storage/' . $doc->path) }}" type="application/pdf" width="100%"
                            height="600px" />
                    </div>
                @endif
            </div>
        @empty
            <div class="alert alert-warning mt-4">
                <i class="fa fa-info-circle"></i> No attachments found for this requisition.
            </div>
        @endforelse

        {{-- @forelse ($documents ?? [] as $doc)
            @if (file_exists(public_path('storage/' . $doc->path)))
                <div class="content mt-3 border p-2 rounded">
                    <div class="d-flex align-items-center mb-2">
                        <p class="mb-0 mr-3">
                            Attached {{ $doc->documenttype == 1 ? 'PDF' : 'MSG' }}:
                        </p>

                        @if ($doc->documenttype == 1)
                            <!-- PDF toggle button -->
                            <button class="btn btn-outline-primary mr-3 togglePdf" data-target="pdf-{{ $doc->id }}">
                                View / Download
                            </button>
                            <a href="{{ asset('storage/' . $doc->path) }}" class="btn btn-secondary" target="_blank">
                                Download PDF
                            </a>
                        @else
                            <!-- MSG file download -->
                            <a href="{{ asset('storage/' . $doc->path) }}" class="btn btn-secondary" download>
                                Download MSG
                            </a>
                        @endif
                    </div>

                    @if ($doc->documenttype == 1)
                        <div class="mt-2 pdfContainer" id="pdf-{{ $doc->id }}" style="display: none;">
                            <embed src="{{ asset('storage/' . $doc->path) }}" type="application/pdf" width="100%"
                                height="600px" />
                        </div>
                    @endif
                </div>
            @endif
        @empty
            <div class="alert alert-warning mt-4">
                <i class="fa fa-info-circle"></i> No attachments found for this requisition.
            </div>
        @endforelse --}}

        <!-- Approval Summary -->
        <div class="content mt-2">
            <p>
                <strong>I request your kind approval to procure the above items at a total cost of TK:
                    {{ number_format($totalPrice, 2) }}</strong>
                (<span id="totalInWords"></span>)
                <strong>including VAT & IT under {{ $requisitions[0]->divisionname }} Division from
                    Project-{{ $requisitions[0]->projectno }}.</strong>
            </p>
        </div>

        <!-- Approver Comment and Actions -->
        <div class="content mt-2">
            <form action="{{ route('admin.requisitions.update', $requisitions[0]->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" style="min-width: 400px;">
                            <label class="font-weight-bold">Approver Comment</label>
                            <textarea class="form-control" id="approver_comment" name="approver_comment" rows="2"
                                placeholder="Enter your comment here...">{{ old('approver_comment') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-success mr-2">Approve</button>
                            <a class="btn btn-warning mr-2" href="{{ route('admin.requisitions.index') }}">Reject</a>
                            <a class="btn btn-danger" href="{{ route('admin.requisitions.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script>
        function numberToWords(num) {
            const a = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
                'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen',
                'Nineteen'
            ];
            const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

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

            const toggleButtons = document.querySelectorAll('.togglePdf');
            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetId = btn.getAttribute('data-target');
                    const pdfContainer = document.getElementById(targetId);
                    if (pdfContainer.style.display === 'none') {
                        pdfContainer.style.display = 'block';
                        btn.textContent = 'Hide PDF';
                    } else {
                        pdfContainer.style.display = 'none';
                        btn.textContent = 'View / Download';
                    }
                });
            });
        });
    </script>
@endsection

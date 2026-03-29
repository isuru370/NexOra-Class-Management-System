@extends('layouts.app')

@section('title', 'Temporary ID Cards Preview')
@section('content')

    <style>
        @font-face {
            font-family: 'Monbaiti';
            src: url('{{ asset('fonts/monbaiti.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        /* A4 Landscape Styles */
        .a4-landscape-page {
            width: 29.7cm;
            /* Landscape width */
            min-height: 21cm;
            /* Landscape height */
            background: white;
            margin: 0 auto;
            padding: 0.5cm;
            box-sizing: border-box;
            position: relative;
        }

        /* ID Card Grid - 3x4 = 12 cards per page */
        .id-card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(4, 1fr);
            gap: 0.3cm;
            width: 100%;
            height: 19cm;
            /* Fixed height for landscape */
        }

        /* ID Card Container - 9cm x 5cm */
        .id-card-container {
            width: 9cm;
            height: 5cm;
            background: white;
            border-radius: 0.2cm;
            box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.1);
            overflow: hidden;
            page-break-inside: avoid;
            break-inside: avoid;
            margin: 0 auto;
        }

        /* ID Card Design */
        .tmp-id-card {
            width: 100%;
            height: 100%;
            background: url('{{ asset('uploads/id/temporary.png') }}') no-repeat center;
            background-size: cover;
            position: relative;
            padding: 0.3cm;
            display: flex;
            flex-direction: column;
            font-family: 'Monbaiti', serif;
            box-sizing: border-box;
        }

        /* Card Header */
        .card-header-content {
            display: flex;
            align-items: center;
            gap: 0.3cm;
            margin-bottom: 0.2cm;
        }

        .card-logo {
            width: 1.2cm;
            height: auto;
            max-height: 0.8cm;
            object-fit: contain;
        }

        .card-title {
            font-size: 0.45cm;
            font-weight: bold;
            color: #333;
            line-height: 1.2;
        }

        /* Card Body */
        .card-body-content {
            display: flex;
            gap: 0.3cm;
            flex: 1;
        }

        /* Left Side - QR Code */
        .qr-section {
            width: 2.2cm;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .qr-code-img {
            width: 1.8cm;
            height: 1.8cm;
            background: white;
            padding: 0.1cm;
            border-radius: 0.1cm;
            margin-bottom: 0.1cm;
            object-fit: contain;
        }

        /* SVG QR code සඳහා විශේෂ styling */
        .qr-code-img svg {
            width: 100%;
            height: 100%;
        }

        .tmp-badge {
            font-size: 0.3cm;
            font-weight: bold;
            color: #ff6b6b;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.05cm 0.15cm;
            border-radius: 0.1cm;
        }

        /* Right Side - ID Info */
        .info-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .tmp-code {
            font-size: 0.5cm;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.1cm;
            line-height: 1.2;
        }

        .tmp-number {
            font-size: 0.35cm;
            color: #7f8c8d;
            margin-bottom: 0.15cm;
        }

        .validity {
            font-size: 0.25cm;
            color: #27ae60;
            background: rgba(255, 255, 255, 0.8);
            padding: 0.05cm 0.15cm;
            border-radius: 0.1cm;
            display: inline-block;
            width: fit-content;
        }

        /* Footer */
        .card-footer {
            font-size: 0.2cm;
            color: #17191a;
            text-align: center;
            margin-top: 0.15cm;
            border-top: 1px dashed #bdc3c7;
            display: flex;
            justify-content: space-between;
                align-items: center;
    padding: 0 0.5cm;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .a4-landscape-page {
                margin: 0;
                padding: 0.3cm;
                box-shadow: none;
                page-break-after: always;
            }

            .id-card-container {
                break-inside: avoid;
                page-break-inside: avoid;
                box-shadow: none;
            }

            .tmp-id-card {
                box-shadow: none;
            }
        }
    </style>

    <!-- Preview Header -->
    <div class="container-fluid no-print py-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Temporary ID Cards ({{ $start }} - {{ $end }})</h4>
                <div>
                    <a href="{{ route('temporary-qr.temporary-id-cards.create') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-plus"></i> Generate New
                    </a>
                    <button onclick="downloadPDF()" class="btn btn-success">
                        <i class="fas fa-file-pdf"></i> Download PDF
                    </button>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Total Cards:</strong> {{ $codes->count() }} |
                    <strong>Pages:</strong> {{ ceil($codes->count() / 12) }} A4 Landscape pages |
                    <strong>Size:</strong> 9cm × 5cm per card (3x4 grid)
                </div>
            </div>
        </div>
    </div>

    <!-- A4 Landscape Pages with ID Cards -->
    <div class="a4-landscape-pages">
        @foreach($codes->chunk(12) as $pageIndex => $pageCodes)
            <div class="a4-landscape-page">
                <div class="id-card-grid">
                    @foreach($pageCodes as $item)
                        <div class="id-card-container">
                            <div class="tmp-id-card">
                                <!-- Header -->
                                <div class="card-header-content">
                                    <img src="{{ asset('uploads/logo/vision_logo.png') }}" class="card-logo" alt="Logo"
                                        onerror="this.style.display='none'">
                                    <div class="card-title">YES EDUCATION INSTITUTE</div>
                                </div>

                                <!-- Body -->
                                <div class="card-body-content">
                                    <!-- QR Code Section - SVG format (Imagick අවශ්‍ය නෑ) -->
                                    <div class="qr-section">
                                        @php
                                            // SVG format එකෙන් QR code generate කරන්න
                                            $svg = QrCode::format('svg')
                                                ->size(150)
                                                ->margin(0)
                                                ->errorCorrection('H')
                                                ->generate($item['code']);

                                            // SVG එක base64 කරන්න
                                            $qrBase64 = 'data:image/svg+xml;base64,' . base64_encode($svg);
                                        @endphp
                                        <img src="{{ $qrBase64 }}" class="qr-code-img" alt="QR Code for {{ $item['code'] }}">
                                        <span class="tmp-badge">Temporary</span>
                                    </div>

                                    <!-- Info Section -->
                                    <div class="info-section">
                                        <div class="tmp-code">{{ $item['code'] }}</div>
                                        <div class="tmp-number">#{{ str_pad($item['number'], 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer">
                                    <span>94 71 16 24 476</span>
                                    <span>Temporary Access Card • 60 Days</span>
                                    <span>Wariyapola</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Fill empty slots (if less than 12 cards) -->
                    @for($i = $pageCodes->count(); $i < 12; $i++)
                        <div class="id-card-container">
                            <div class="tmp-id-card" style="opacity: 0.3; background: #f5f5f5;">
                                <div class="card-header-content">
                                    <div class="card-title" style="color: #999;">Empty Slot</div>
                                </div>
                                <div class="card-body-content" style="justify-content: center; align-items: center;">
                                    <span style="font-size: 0.4cm; color: #999;">—</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Page Number (Screen Only) -->
                <div class="no-print text-center mt-2" style="font-size: 0.3cm; color: #999;">
                    Page {{ $pageIndex + 1 }} of {{ ceil($codes->count() / 12) }}
                </div>
            </div>

            @if(!$loop->last)
                <div class="no-print" style="page-break-after: always;"></div>
            @endif
        @endforeach
    </div>

    <!-- Hidden Form for PDF Download -->
    <form id="pdfDownloadForm" method="POST" action="{{ route('temporary-qr.temporary-id-cards.download-pdf') }}"
        style="display: none;">
        @csrf
        <input type="hidden" name="codes" id="pdfCodesInput">
    </form>

    <script>
        function downloadPDF() {
            const codes = @json($codes);
            document.getElementById('pdfCodesInput').value = JSON.stringify(codes);
            document.getElementById('pdfDownloadForm').submit();
        }

        // Auto-adjust for printing
        window.onbeforeprint = function () {
            document.querySelectorAll('.no-print').forEach(function (el) {
                el.style.display = 'none';
            });
        };

        window.onafterprint = function () {
            document.querySelectorAll('.no-print').forEach(function (el) {
                el.style.display = '';
            });
        };
    </script>

    <!-- Print optimization -->
    <style media="print">
        @page {
            size: A4 landscape;
            margin: 0.5cm;
        }

        body {
            margin: 0;
            padding: 0;
            background: white;
        }

        .a4-landscape-page {
            page-break-after: always;
            margin: 0;
            padding: 0.3cm;
            box-shadow: none;
        }

        .id-card-container {
            box-shadow: none;
            border: none;
        }

        .no-print {
            display: none !important;
        }
    </style>

@endsection
@extends('layouts.app')

@section('title', 'Temporary ID Cards')
@section('content')

    <style>
        @font-face {
            font-family: 'Monbaiti';
            src: url('{{ asset('fonts/monbaiti.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        /* A4 Size Styles */
        .a4-page {
            width: 21cm;
            min-height: 29.7cm;
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
            gap: 0.3cm;
            width: 100%;
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
        }

        /* ID Card Design */
        .tmp-id-card {
            width: 100%;
            height: 100%;
            background: url('{{ asset('uploads/id/idcard_bg.png') }}') no-repeat center;
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
            color: #95a5a6;
            text-align: center;
            margin-top: 0.15cm;
            border-top: 1px dashed #bdc3c7;
            padding-top: 0.1cm;
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

            .a4-page {
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

        /* Form Styles */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>

    <!-- IF CODES EXIST - Show Preview -->
    @if(isset($codes) && $codes->count() > 0)

        <!-- Preview Header -->
        <div class="container-fluid no-print py-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Temporary ID Cards ({{ $start }} - {{ $end }})</h4>
                    <div>
                        <a href="{{ route('temporary-qr.id-cards.form') }}" class="btn btn-secondary me-2">
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
                        <strong>Pages:</strong> {{ ceil($codes->count() / 12) }} A4 pages |
                        <strong>Size:</strong> 9cm × 5cm per card (12 cards per page)
                    </div>
                </div>
            </div>
        </div>

        <!-- A4 Pages with ID Cards -->
        <div class="a4-pages">
            @foreach($codes->chunk(12) as $pageIndex => $pageCodes)
                <div class="a4-page">
                    <div class="id-card-grid">
                        @foreach($pageCodes as $item)
                            <div class="id-card-container">
                                <div class="tmp-id-card">
                                    <!-- Header -->
                                    <div class="card-header-content">
                                        <img src="{{ asset('uploads/logo/white_logo.png') }}" class="card-logo" alt="Logo"
                                            onerror="this.style.display='none'">
                                        <div class="card-title">TEMP ID</div>
                                    </div>

                                    <!-- Body -->
                                    <div class="card-body-content">
                                        <!-- QR Code Section -->
                                        <div class="qr-section">
                                            @php
                                                $qrUrl = route('temporary-qr.image', $item['code']);
                                            @endphp
                                            <img src="{{ $qrUrl }}" class="qr-code-img" alt="QR Code"
                                                onerror="this.onerror=null; this.src='{{ $qrUrl }}?{{ time() }}'">
                                            <span class="tmp-badge">Temporary</span>
                                        </div>

                                        <!-- Info Section -->
                                        <div class="info-section">
                                            <div class="tmp-code">{{ $item['code'] }}</div>
                                            <div class="tmp-number">
                                                #{{ str_pad($item['number'] ?? $loop->iteration, 4, '0', STR_PAD_LEFT) }}</div>
                                            <div class="validity">
                                                Valid: {{ now()->addDays(30)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="card-footer">
                                        Temporary ID • Valid 30 days
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
        <form id="pdfDownloadForm" method="POST" action="{{ route('temporary-qr.download-id-cards-pdf') }}"
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
                document.querySelectorAll('.no-print').forEach(el => {
                    el.style.display = 'none';
                });
            };

            window.onafterprint = function () {
                document.querySelectorAll('.no-print').forEach(el => {
                    el.style.display = '';
                });
            };
        </script>

        <!-- ELSE - Show Generation Form -->
    @else

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-id-card me-2"></i>Generate Temporary ID Cards</h4>
                        </div>
                        <div class="card-body">

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li><i class="fas fa-times me-2"></i>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Information:</strong> Each A4 page will contain 12 ID cards (9cm × 5cm each). Maximum
                                1000 cards per generation.
                            </div>

                            <form method="POST" action="{{ route('temporary-qr.generate-id-cards') }}" class="mt-4">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="start" class="form-label fw-bold">Start Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text">TMP</span>
                                            <input type="text" class="form-control @error('start') is-invalid @enderror"
                                                id="start" name="start" placeholder="001" value="{{ old('start', '001') }}"
                                                pattern="[0-9]{3,4}" required>
                                        </div>
                                        @error('start')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: TMP001 (3-4 digits)</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="end" class="form-label fw-bold">End Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text">TMP</span>
                                            <input type="text" class="form-control @error('end') is-invalid @enderror" id="end"
                                                name="end" placeholder="012" value="{{ old('end', '012') }}"
                                                pattern="[0-9]{3,4}" required>
                                        </div>
                                        @error('end')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: TMP012 (max 1000 cards)</small>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6><i class="fas fa-calculator me-2"></i>Calculation:</h6>
                                                <div id="calculation">
                                                    <span>Total cards: <strong class="text-primary"
                                                            id="totalCards">12</strong></span>
                                                    <span class="mx-2">|</span>
                                                    <span>Pages: <strong class="text-primary" id="totalPages">1</strong> A4
                                                        page(s)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-id-card me-2"></i>Generate ID Cards
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sample Preview Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Sample Design Preview</h5>
                        </div>
                        <div class="card-body text-center">
                            <div
                                style="width: 9cm; height: 5cm; margin: 0 auto; border: 1px solid #ddd; border-radius: 0.2cm; overflow: hidden;">
                                <div
                                    style="width: 100%; height: 100%; background: url('{{ asset('uploads/id/idcard_bg.png') }}') no-repeat center; background-size: cover; padding: 0.3cm;">
                                    <div style="display: flex; align-items: center; gap: 0.3cm; margin-bottom: 0.2cm;">
                                        <img src="{{ asset('uploads/logo/white_logo.png') }}"
                                            style="width: 1.2cm; height: auto;" alt="Logo">
                                        <div style="font-weight: bold;">TEMP ID</div>
                                    </div>
                                    <div style="display: flex; gap: 0.3cm;">
                                        <div
                                            style="width: 1.8cm; height: 1.8cm; background: white; border-radius: 0.1cm; display: flex; align-items: center; justify-content: center; font-size: 0.3cm;">
                                            QR</div>
                                        <div>
                                            <div style="font-size: 0.5cm; font-weight: bold;">TMP001</div>
                                            <div style="font-size: 0.25cm; margin-top: 0.2cm; color: #27ae60;">Valid: 30 days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mt-3">Actual card size: 9cm × 5cm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const startInput = document.getElementById('start');
                const endInput = document.getElementById('end');
                const totalCardsSpan = document.getElementById('totalCards');
                const totalPagesSpan = document.getElementById('totalPages');

                function updateCalculation() {
                    let start = parseInt(startInput.value) || 1;
                    let end = parseInt(endInput.value) || 12;

                    if (end < start) {
                        end = start;
                        endInput.value = String(end).padStart(3, '0');
                    }

                    const total = (end - start) + 1;
                    const pages = Math.ceil(total / 12);

                    totalCardsSpan.textContent = total;
                    totalPagesSpan.textContent = pages;
                }

                startInput.addEventListener('input', updateCalculation);
                endInput.addEventListener('input', updateCalculation);
            });
        </script>

    @endif

    <!-- Print optimization -->
    <style media="print">
        @page {
            size: A4;
            margin: 0.5cm;
        }

        body {
            margin: 0;
            padding: 0;
            background: white;
        }

        .a4-page {
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
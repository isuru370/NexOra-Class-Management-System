<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Temporary QR Cards</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .page {
            width: 29.7cm;
            min-height: 20.9cm;
            box-sizing: border-box;
            page-break-after: always;
            font-size: 0;
            text-align: center;
            padding-top: 0.5cm;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .card {
            width: 9.2cm;
            height: 4.9cm;
            display: inline-block;
            vertical-align: top;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin-right: 0.15cm;
            margin-bottom: 0.1cm;
            page-break-inside: avoid;
            box-sizing: border-box;
            font-size: 12px;
            text-align: left;
        }

        .card.third {
            margin-right: 0;
        }

        .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            z-index: 0;
        }

        .title {
            position: absolute;
            top: 0.12cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.5cm;
            font-weight: bold;
            letter-spacing: 0.01cm;
            line-height: 1;
            z-index: 2;
        }

        .subtitle {
            position: absolute;
            top: 0.62cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.18cm;
            color: #111111;
            line-height: 1;
            z-index: 2;
        }

        .logo {
            position: absolute;
            top: 1.15cm;
            left: 0.55cm;
            width: 4.3cm;
            height: auto;
            filter: brightness(0) invert(1);
            z-index: 2;
        }

        .number {
            position: absolute;
            top: 3.3cm;
            left: 0.75cm;
            font-size: 0.36cm;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.35);
            padding: 0.05cm 0.15cm;
            border-radius: 0.1cm;
            z-index: 2;
        }

        .qr {
            position: absolute;
            top: 1.0cm;
            right: 0.7cm;
            width: 1.75cm;
            background: #fff;
            padding: 0.05cm;
            border-radius: 0.15cm;
            z-index: 2;
            box-sizing: border-box;
        }

        .code {
            position: absolute;
            top: 3.05cm;
            right: 0.7cm;
            font-size: 0.36cm;
            font-weight: bold;
            letter-spacing: 0.5px;
            background: rgba(0, 0, 0, 0.35);
            padding: 0.05cm 0.12cm;
            border-radius: 0.1cm;
            z-index: 2;
        }

        .footer-line {
            position: absolute;
            bottom: 0.72cm;
            left: 0.45cm;
            right: 0.45cm;
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            z-index: 2;
        }

        .footer {
            position: absolute;
            bottom: 0.16cm;
            left: 0.4cm;
            right: 0.4cm;
            height: 0.22cm;
            font-size: 0.16cm;
            color: rgb(58, 54, 54);
            font-weight: 500;
            z-index: 2;
            line-height: 1;
        }

        .footer-left {
            position: absolute;
            left: 0;
            bottom: 0;
            white-space: nowrap;
        }

        .footer-center {
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 4cm;
            margin-left: -2cm;
            text-align: center;
            white-space: nowrap;
        }

        .footer-right {
            position: absolute;
            right: 0;
            bottom: 0;
            white-space: nowrap;
            text-align: right;
        }

        .row-break {
            display: block;
            width: 100%;
            height: 0;
            clear: both;
        }

        .card.empty-slot {
            background: #f5f5f5;
            border: 2px dashed #ccc;
            color: #999;
            text-align: center;
            line-height: 4.9cm;
        }

        @media print {
            .bg {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    @php
        $bgBase64 = '';
        $bgPath = public_path('uploads/id/temporary.png');
        if (file_exists($bgPath)) {
            $imageData = file_get_contents($bgPath);
            $bgBase64 = 'data:image/png;base64,' . base64_encode($imageData);
        }

        $logoSrc = '';
        $logoPath = public_path('uploads/logo/logo.png');
        if (file_exists($logoPath)) {
            $imageData = file_get_contents($logoPath);
            $logoSrc = 'data:image/png;base64,' . base64_encode($imageData);
        }
    @endphp

    @foreach($codes->chunk(12) as $pageCodes)
        <div class="page">

            @foreach($pageCodes as $item)
                <div class="card {{ ($loop->iteration % 3 == 0) ? 'third' : '' }}">
                    @if($bgBase64)
                        <img class="bg" src="{{ $bgBase64 }}" alt="Background">
                    @endif

                    <div class="title">TEMPORARY QR CARD</div>
                    <div class="subtitle">Bringing You Next</div>

                    @if($logoSrc)
                        <img class="logo" src="{{ $logoSrc }}" alt="Logo">
                    @endif

                    <div class="number">
                        #{{ str_pad($item['number'] ?? $loop->iteration, 3, '0', STR_PAD_LEFT) }}
                    </div>

                    <img class="qr" src="{{ $item['qr_base64'] }}" alt="QR Code">

                    <div class="code">
                        {{ $item['code'] }}
                    </div>

                    <div class="footer-line"></div>

                    <div class="footer">
                        <span class="footer-left">94 71 16 24 476</span>
                        <span class="footer-center">Temporary Access Card • 60 Days</span>
                        <span class="footer-right">Wariyapola</span>
                    </div>
                </div>

                @if($loop->iteration % 3 == 0)
                    <div class="row-break"></div>
                @endif
            @endforeach

            @for($i = $pageCodes->count() + 1; $i <= 12; $i++)
                <div class="card empty-slot {{ ($i % 3 == 0) ? 'third' : '' }}">
                    —
                </div>

                @if($i % 3 == 0)
                    <div class="row-break"></div>
                @endif
            @endfor

        </div>
    @endforeach

</body>

</html>
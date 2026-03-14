<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use Intervention\Image\Facades\Image;

class TemporaryIDCardController extends Controller
{
    // Cards per page for PDF
    private $cardsPerPage = 12;

    /**
     * Show the form to enter TMP codes
     */
    public function create()
    {
        return view('qr.create');
    }

    /**
     * Generate ID cards and show preview
     */
    public function generate(Request $request)
    {
        // Validate input
        $request->validate([
            'start' => 'required|string',
            'end' => 'required|string'
        ]);

        $startInput = strtoupper($request->start);
        $endInput = strtoupper($request->end);

        // Remove TMP prefix if exists
        $startNum = intval(preg_replace('/^TMP/i', '', $startInput));
        $endNum = intval(preg_replace('/^TMP/i', '', $endInput));

        if ($startNum <= 0 || $endNum <= 0) {
            return back()->with('error', 'Please enter valid numbers (e.g., 001 or TMP001)')->withInput();
        }

        if ($startNum > $endNum) {
            return back()->with('error', 'Start code must be smaller than End code')->withInput();
        }

        // Generate TMP codes for any range (even >1000)
        $codes = collect(range($startNum, $endNum))->map(function ($i) {
            return [
                'code' => "TMP" . str_pad($i, 3, "0", STR_PAD_LEFT),
                'number' => $i
            ];
        });

        return view('qr.preview', [
            'codes' => $codes,
            'start' => "TMP" . str_pad($startNum, 3, "0", STR_PAD_LEFT),
            'end' => "TMP" . str_pad($endNum, 3, "0", STR_PAD_LEFT),
            'totalCards' => $codes->count(),
            'totalPages' => ceil($codes->count() / $this->cardsPerPage)
        ]);
    }

    /**
     * Download ID cards as PDF
     */
    public function downloadPdf(Request $request)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(300);

        $codes = json_decode($request->codes, true);

        if (empty($codes)) {
            return back()->with('error', 'No codes to generate PDF');
        }

        $codes = collect($codes)->map(function ($item, $index) {
            $svg = QrCode::format('svg')
                ->size(200)
                ->margin(0)
                ->errorCorrection('M')
                ->generate($item['code']);

            $item['qr_base64'] = 'data:image/svg+xml;base64,' . base64_encode($svg);
            $item['number'] = $item['number'] ?? $index + 1;

            return $item;
        });

        $data = [
            'codes' => $codes,
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = Pdf::loadView('qr.pdf', $data)
            ->setPaper('a4')
            ->setOrientation('landscape')
            ->setOption('encoding', 'UTF-8')
            ->setOption('enable-local-file-access', true)
            ->setOption('print-media-type', true)
            ->setOption('background', true)
            ->setOption('disable-smart-shrinking', true)
            ->setOption('dpi', 300)
            ->setOption('zoom', 1)
            ->setOption('margin-top', 0)
            ->setOption('margin-right', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 0);

        return $pdf->download('temporary-id-cards.pdf');
    }

    public function generateImage($code)
    {
        $qrCode = QrCode::format('png')
            ->size(150)
            ->margin(0)
            ->errorCorrection('H')
            ->generate($code);

        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrCode);

        return response()->json([
            'qr_code' => $qrBase64,
            'code' => $code
        ]);
    }
}

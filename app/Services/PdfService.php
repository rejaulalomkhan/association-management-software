<?php

namespace App\Services;

use Mpdf\Mpdf;

/**
 * Service for generating PDFs with Bengali font support.
 *
 * This service centralizes the mPDF configuration used across
 * the application for receipts, reports, and certificates.
 */
class PdfService
{
    /**
     * Path to the Bengali font directory.
     */
    protected string $fontPath;

    /**
     * Create a new PdfService instance.
     */
    public function __construct()
    {
        $this->fontPath = public_path('fonts');
    }

    /**
     * Create a configured mPDF instance with Bengali font support.
     *
     * @param string $format Paper format (default: A4)
     * @param string $orientation Paper orientation (P=Portrait, L=Landscape)
     * @return Mpdf
     */
    public function createMpdf(string $format = 'A4', string $orientation = 'P', array $mpdfConfig = []): Mpdf
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return new Mpdf(array_merge([
            'format' => $format,
            'orientation' => $orientation,
            'fontDir' => array_merge($fontDirs, [$this->fontPath]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'solaimanlipi'
        ], $mpdfConfig));
    }

    /**
     * Generate a PDF from a Blade view.
     *
     * @param string $view Blade view name
     * @param array $data Data to pass to the view
     * @param string $format Paper format
     * @param string $orientation Paper orientation
     * @return string PDF content as binary string
     */
    public function generateFromView(string $view, array $data = [], string $format = 'A4', string $orientation = 'P'): string
    {
        $mpdf = $this->createMpdf($format, $orientation);

        $html = view($view, $data)->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('', 'S');
    }

    /**
     * Generate a PDF and return a download response.
     *
     * @param string $view Blade view name
     * @param array $data Data to pass to the view
     * @param string $fileName Download file name
     * @param string $format Paper format
     * @param string $orientation Paper orientation
     * @return \Illuminate\Http\Response
     */
    public function downloadFromView(string $view, array $data, string $fileName, string $format = 'A4', string $orientation = 'P', array $mpdfConfig = [])
    {
        $mpdf = $this->createMpdf($format, $orientation, $mpdfConfig);

        $html = view($view, $data)->render();
        $mpdf->WriteHTML($html);

        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S');
        }, $fileName);
    }

    /**
     * Generate a payment receipt PDF.
     *
     * @param \App\Models\Payment $payment Payment model
     * @return \Illuminate\Http\Response
     */
    public function generatePaymentReceipt($payment)
    {
        $fileName = 'receipt-' . ($payment->transaction_id ?: $payment->id) . '.pdf';

        return $this->downloadFromView('pdf.payment-receipt', ['payment' => $payment], $fileName);
    }

    /**
     * Generate a transactions report PDF.
     *
     * @param \Illuminate\Support\Collection $transactions Collection of Payment models
     * @param string|null $month Month filter
     * @param int|null $year Year filter
     * @return \Illuminate\Http\Response
     */
    public function generateTransactionsReport($transactions, $month = null, $year = null)
    {
        $fileName = 'transactions-report-' . date('Y-m-d') . '.pdf';

        return $this->downloadFromView('pdf.transactions-report', [
            'transactions' => $transactions,
            'month' => $month,
            'year' => $year,
        ], $fileName);
    }
}
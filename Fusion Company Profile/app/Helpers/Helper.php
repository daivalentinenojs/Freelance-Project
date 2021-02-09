<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Helper
{
    public static function QrCode($code, $logo = true, $size = 750)
    {
        $qrcode = QrCode::format('png');
        if ($logo) {
            $qrcode->merge('assets/images/logo/logo-qr.jpg', 0.35, true);
        }
        return $qrcode->size($size)
            ->errorCorrection('H')
            ->generate($code);
    }

    public static function printQRCode($code, $fileName = 'img', $download = true, $logo = true, $size = 750)
    {
        $image = self::QrCode($code, $logo, $size);
        $output_path = '/temp/qr-code/' . $fileName . '-' . time() . '.png';
        if (!Storage::disk('local')->put($output_path, $image)) {
            return 'error';
        }
        //for auto download
        if ($download) {
            return Storage::download($output_path);
        }
        //for show full
        $file = Storage::disk('local')->get($output_path);
        return response($file)
            ->withHeaders([
                'Content-Type' => 'image/png',
            ]);
    }
}

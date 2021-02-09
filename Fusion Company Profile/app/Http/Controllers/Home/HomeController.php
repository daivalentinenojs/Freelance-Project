<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use App\Models\Guest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(Request $request)
    {
        // return Hash::make('12345');
        /*
        $image = QrCode::format('png')
            ->merge('assets/images/logo/logo.png', 0.2, true)
            ->size(200)
            ->errorCorrection('H')
            ->generate('A simple example of QR code!');
        $output_path = '/temp/qrcode/img-' . time() . '.png';
        if (Storage::disk('local')->put($output_path, $image)) {
            //for auto download
            return Storage::download($output_path);
            //for show full
            $file = Storage::disk('local')->get($output_path);
            return response($file)
                ->withHeaders([
                    'Content-Type' => 'image/png',
                ]);
        }
        */
        return view('menus.home.index');
    }
}

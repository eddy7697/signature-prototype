<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SignController extends Controller
{
    public function saveSign(Request $request)
    {
        // $filename = rand(1111111, 9999999);
        // $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->imageBase64));

        // file_put_contents(storage_path("img/$filename.png"), $data);

        $pdf = PDF::loadView('pdf.result', [
            'image' => $request->imageBase64
        ]);
        return $pdf->download('invoice.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PDF;
use Image;

class SignController extends Controller
{
    public function saveSign(Request $request)
    {
        $filename = rand(1111111, 9999999);
        // $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->imageBase64));

        // file_put_contents(storage_path("img/$filename.png"), $data);

        $pdf = PDF::loadView('pdf.result', [
            'image' => $request->imageBase64
        ]);
        return $pdf->download("result_$filename.pdf");
    }

    public function resize_image(Request $request) 
    {
        $image = $request->file('image');
        $filename = rand(1111111, 9999999).$image->getClientOriginalName();

        // $image->move(storage_path("uploads"), $filename);

        $resize_image = Image::make($image->getRealPath());

        $resize_image->resize(1024, null, function($constraint){
            $constraint->aspectRatio();
        })->save($filename);

        $path = $filename;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = PDF::loadView('pdf.result', [
            'image' => $base64
        ]);
        return $pdf->download("result_$filename.pdf");
        // Storage::put($file->getClientOriginalName(), file_get_contents($file));
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Qrcodigo;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodigoController extends Controller
{
    

    public function index(){
        $data = Qrcodigo::all();
        return view ('qr.index', ['data' => $data]);
    }

    public function store(Request $request){
        $data = new Qrcodigo;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->url = $request->url;
        $data->save();
        return back();
    }

    public function generate($id)
    {
        $data = Qrcodigo::findOrFail($id);
        $qrcode = QrCode::size(400)->color(163, 73, 164)->merge('https://www.desarrollolibre.net/public/images/logo/logo.png', .3, true)->backgroundColor(50,205,50)->generate($data->name);
        
        return view('qr.generate',compact('qrcode'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('dashboard.qrcode.index', [
            'title' => 'QR Code | SIAPIN'
        ]);
    }

    public function generateQrCode(Request $request)
    {
        //if user scan the qr code, then name and email will be sent to database

        // //store data name and email
        // $name = $request->name;
        // $email = $request->email;

        // //generate qr code
        // $data = ($name . ' ' . $email);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $data = 'Name: ' . $name . '
        Email: ' . $email . '
        Phone: ' . $phone . '
        ';

        $qrCode = QrCode::size(500)->generate($data);

        return view('dashboard.qrcode.view', compact('qrCode'), [
            'title' => 'QR Code | SIAPIN'
        ]);
    }

    public function scanQrCode()
    {
        return view('dashboard.qrcode.scan', [
            'title' => 'QR Code | SIAPIN'
        ]);
    }
}

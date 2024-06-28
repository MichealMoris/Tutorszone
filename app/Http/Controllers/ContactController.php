<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ContactController extends Controller
{
    public function updateContact($id, Request $request){

        $validator = FacadesValidator::make($request->all(), [
            'phone_number' => 'required',
            'messageen' => 'required',
            'messagear' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Contact::find($id)->update([
            "phone_number" => $request->phone_number,
            "message_en" => $request->messageen,
            "message_ar" => $request->messagear,
        ]);

        return redirect('/en/admin/dashboard/contact');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ArTeacher;
use App\Models\Contact;
use App\Models\EnTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function getUserCountry(Request $request)
    {

        try {
            $headers = $request->headers->all();
            $ip = $headers["x-real-ip"][0];
            $data = Http::get("http://ipinfo.io/$ip/json");
            return strtolower($data["country"]);
        } catch (\Throwable $th) {
            return "ae";
        }
    }


    public function HomePage(Request $request)
    {
        $country = $this->getUserCountry($request);
        if ($country == 'sa') {
            $contacts = Contact::where('country', 'sa')->get();
            $enTeachers = EnTeacher::whereIn('teacher_country', ['sa', 'both'])->get();
            $arTeachers = ArTeacher::whereIn('teacher_country', ['sa', 'both'])->get();

            $data = [
                'contacts' => $contacts,
                'enTeachers' => $enTeachers,
                'arTeachers' => $arTeachers,
                'country' => "sa",
            ];

            return view('index', $data);
        } else {
            $contacts = Contact::where('country', 'uae')->get();
            $enTeachers = EnTeacher::whereIn('teacher_country', ['uae', 'both'])->get();
            $arTeachers = ArTeacher::whereIn('teacher_country', ['uae', 'both'])->get();
            $data = [
                'contacts' => $contacts,
                'enTeachers' => $enTeachers,
                'arTeachers' => $arTeachers,
                'country' => "ae",
            ];

            return view('index', $data);
        }
    }

    public function data(Request $request)
    {
        $country = $this->getUserCountry($request);
        if ($country == 'sa') {
            $enTeachers = EnTeacher::whereIn('teacher_country', ['sa', 'both'])->get();
            $arTeachers = ArTeacher::whereIn('teacher_country', ['sa', 'both'])->get();

            $data = [
                'enTeachers' => $enTeachers,
                'arTeachers' => $arTeachers,
            ];

            return response()->json($data);
        } else {
            $enTeachers = EnTeacher::whereIn('teacher_country', ['uae', 'both'])->get();
            $arTeachers = ArTeacher::whereIn('teacher_country', ['uae', 'both'])->get();
            $data = [
                'enTeachers' => $enTeachers,
                'arTeachers' => $arTeachers,
            ];

            return response()->json($data);
        }
    }
}

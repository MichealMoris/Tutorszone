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

    // public function getMyIPAddress()
    // {
    //     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //         $ip = $_SERVER['HTTP_CLIENT_IP'] ?? '';
    //     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
    //     } else {
    //         $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    //     }

    //     // error_log('IP Address: '.request()->ip());
    //     // return $ip;
    // }

    public function getLocationInfo($ip)
    {
        try {
            $response = Http::get("http://ipinfo.io/$ip/json");

            if ($response->successful()) {
                return $location = [
                    'status' => 'success',
                    'data' => $response->json()
                ];
            } else {
                return $location = [
                    'status' => 'error',
                    'message' => 'Unable to retrieve location data.',
                ];
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getUserCountry()
    {

        error_log('IP Address: '. request()->ip());

        try {
            $uaeIP = "94.200.100.101";
            $saIP = "212.26.1.150";
            $locationInfo = $this->getLocationInfo(request()->ip());
            return strtolower($locationInfo['data']['country']);
        } catch (\Throwable $th) {
            return "ae";
        }
    }


    public function HomePage()
    {
        $country = $this->getUserCountry();
        if ($country == 'sa') {
            $contacts = Contact::where('country', 'sa')->get();
            $enTeachers = EnTeacher::whereIn('teacher_country', ['sa', 'both'])->get();
            $arTeachers = ArTeacher::whereIn('teacher_country', ['sa', 'both'])->get();

            $data = [
                'contacts' => $contacts,
                'enTeachers' => $enTeachers,
                'arTeachers' => $arTeachers,
                'country' => $country,
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
                'country' => $country,
            ];

            return view('index', $data);
        }
    }

    public function data(){
        $country = $this->getUserCountry();
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

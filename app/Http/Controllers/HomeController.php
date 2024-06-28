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

    public function getUserCountry()
    {

        try {
            $uaeIP = "94.200.100.101";
            $saIP = "212.26.1.150";
            $locationInfo = $this->getLocationInfo("197.39.40.182");
            error_log('Country is: '.$locationInfo);
            // return strtolower($locationInfo['data']['country']);
            return "Hello";
        } catch (\Throwable $th) {
            return "ae";
        }
    }


    public function HomePage()
    {
        error_log('Country is: ');
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

    public function data()
    {
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

<?php

namespace App\Http\Controllers;

use App\Models\ArTeacher;
use App\Models\EnTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TeacherController extends Controller
{
    public function index($ln)
    {
        return view("dashboard.addTecher")->with('ln', $ln);
    }

    public function updateTeacher($id, $ln)
    {
        if ($ln == 'en') {
            $teacher = EnTeacher::find($id);
        } else {
            $teacher = ArTeacher::find($id);
        }
        return view("dashboard.updateTecher")->with("teacher", $teacher);
    }

    public function addTeacher($ln, Request $request)
    {
        if ($ln == 'en') {
            $validator = FacadesValidator::make($request->all(), [
                'teacherImage' => 'required|image|mimes:jpeg,png,jpg,gif',
                'teacherName' => 'required|string|max:255',
                'teacherSubject' => 'required|string|max:255',
                'teacherCountry' => 'required|string|in:uae,sa,both',
                'teacherDescription' => 'required|string',
                'teacherColor' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            //$imageName = time() . '.' . $request->teacherImage->getClientOriginalExtension();
            $path = $request->teacherImage->store('teachers', 'public');

            EnTeacher::create([
                'teacher_name' => $request->teacherName,
                'teacher_subject' => $request->teacherSubject,
                'teacher_country' => $request->teacherCountry,
                'teacher_description' => $request->teacherDescription,
                'teacher_color' => $request->teacherColor,
                'teacher_image' => $path,
            ]);

            return redirect('/en/admin/dashboard');
        } else {
            $validator = FacadesValidator::make($request->all(), [
                'teacherImage' => 'required|image|mimes:jpeg,png,jpg,gif',
                'teacherName' => 'required|string|max:255',
                'teacherSubject' => 'required|string|max:255',
                'teacherCountry' => 'required|string|in:uae,sa,both',
                'teacherDescription' => 'required|string',
                'teacherColor' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            //$imageName = time() . '.' . $request->teacherImage->getClientOriginalExtension();
            $path = $request->teacherImage->store('teachers', 'public');

            ArTeacher::create([
                'teacher_name' => $request->teacherName,
                'teacher_subject' => $request->teacherSubject,
                'teacher_country' => $request->teacherCountry,
                'teacher_description' => $request->teacherDescription,
                'teacher_color' => $request->teacherColor,
                'teacher_image' => $path,
            ]);

            return redirect('/en/admin/dashboard/ar');
        }
    }

    public function editTeacher($id, $ln, Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'teacherImage' => 'image|mimes:jpeg,png,jpg,gif',
            'teacherName' => 'required|string|max:255',
            'teacherSubject' => 'required|string|max:255',
            'teacherCountry' => 'required|string|in:uae,sa,both',
            'teacherDescription' => 'required|string',
            'teacherColor' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($ln == 'en') {
            if ($request->teacherImage) {

                $path = $request->teacherImage->store('teachers', 'public');
                EnTeacher::find($id)->update([
                    'teacher_name' => $request->teacherName,
                    'teacher_subject' => $request->teacherSubject,
                    'teacher_country' => $request->teacherCountry,
                    'teacher_description' => $request->teacherDescription,
                    'teacher_color' => $request->teacherColor,
                    'teacher_image' => $path,
                ]);
            } else {
                EnTeacher::find($id)->update([
                    'teacher_name' => $request->teacherName,
                    'teacher_subject' => $request->teacherSubject,
                    'teacher_country' => $request->teacherCountry,
                    'teacher_description' => $request->teacherDescription,
                    'teacher_color' => $request->teacherColor,
                ]);
            }
            return redirect('/en/admin/dashboard');
        } else {
            if ($request->teacherImage) {

                $path = $request->teacherImage->store('teachers', 'public');
                ArTeacher::find($id)->update([
                    'teacher_name' => $request->teacherName,
                    'teacher_subject' => $request->teacherSubject,
                    'teacher_country' => $request->teacherCountry,
                    'teacher_description' => $request->teacherDescription,
                    'teacher_color' => $request->teacherColor,
                    'teacher_image' => $path,
                ]);
            } else {
                ArTeacher::find($id)->update([
                    'teacher_name' => $request->teacherName,
                    'teacher_subject' => $request->teacherSubject,
                    'teacher_country' => $request->teacherCountry,
                    'teacher_description' => $request->teacherDescription,
                    'teacher_color' => $request->teacherColor,
                ]);
            }
            return redirect('/en/admin/dashboard/ar');
        }
    }
}

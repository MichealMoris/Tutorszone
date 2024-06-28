<?php

namespace App\Http\Controllers;

use App\Models\ArTeacher;
use App\Models\Contact;
use App\Models\EnTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class DashboardController extends Controller
{
    public function loginIndex(){
        return view("dashboard.login");
    }

    public function dashboardIndex(){
        $enTeachers = EnTeacher::all();
        return view("dashboard.home")->with('enTeachers', $enTeachers);
    }

    public function arDashboardIndex(){
        $arTeachers = ArTeacher::all();
        return view("dashboard.ar_home")->with('arTeachers', $arTeachers);
    }

    public function ContactDashboardIndex(){
        $contacts = Contact::all();
        return view("dashboard.contact")->with('contacts', $contacts);
    }

    public function TrashDashboardIndex(){
        $deletedEn = EnTeacher::onlyTrashed()->get();
        $deletedAr = ArTeacher::onlyTrashed()->get();
        $allDeleted = [...$deletedEn, ...$deletedAr];
        return view("dashboard.trash")->with('deletedTeachers', $allDeleted);
    }

    public function recover($id, $ln){
        if($ln == "en"){
            EnTeacher::onlyTrashed()->find($id)->restore();
            return redirect('/en/admin/dashboard');
        }else{
            ArTeacher::onlyTrashed()->find($id)->restore();
            return redirect('/en/admin/dashboard/ar');
        }
    }

    public function deleteAll(){
        EnTeacher::onlyTrashed()->forceDelete();
        ArTeacher::onlyTrashed()->forceDelete();
        return redirect('/en/admin/dashboard/trash');
    }

    public function forceDelete($id, $ln){
        if($ln == "en"){
            EnTeacher::onlyTrashed()->find($id)->forceDelete();
        }else{
            ArTeacher::onlyTrashed()->find($id)->forceDelete();
        }
        return redirect('/en/admin/dashboard/trash');
    }

    public function AdminsDashboardIndex(){
        $admins = User::all(['id', 'name', 'email', 'permission']);
        return view("dashboard.admins")->with('admins', $admins);
    }

    public function addAdmin(){
        return view("dashboard.addAdmin");
    }

    public function updateAdmin($id){
        $admin = User::find($id);
        return view("dashboard.updateAdmin")->with('admin', $admin);
    }

    public function editAdmin($id, Request $request){
        $validator = FacadesValidator::make($request->all(), [
            'adminName' => 'required|string|max:255',
            'adminEmail' => 'required|email|max:255',
            'adminPermission' => 'required|string|in:admin,superadmin',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->adminPassword) {

            User::find($id)->update([
                'name' => $request->adminName,
                'email' => $request->adminEmail,
                'password' => $request->adminPassword,
                'permission' => $request->adminPermission,
            ]);
        } else {
            User::find($id)->update([
                'name' => $request->adminName,
                'email' => $request->adminEmail,
                'permission' => $request->adminPermission,
            ]);
        }
        return redirect('/en/admin/dashboard/admins');

    }

    public function deleteAdmin($id){
        User::find($id)->delete();
        return redirect('/en/admin/dashboard/admins');
    }

    public function storeAdmin(Request $request){

        $validator = FacadesValidator::make($request->all(), [
            'adminName' => 'required|string|max:255',
            'adminEmail' => 'required|email|max:255',
            'adminPassword' => 'required|string',
            'adminPermission' => 'required|string|in:admin,superadmin',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'=>$request->adminName,
            'email'=>$request->adminEmail,
            'password'=>Hash::make($request->adminPassword),
            'permission'=>$request->adminPermission,
        ]);

        return redirect('/en/admin/dashboard/admins');

    }

    public function logout(){
        Auth::logout();
        return redirect('/en/admin/'.env('ADMIN_SECRET').'/login');
    }

    public function deleteEnTeacher($id){
        EnTeacher::find($id)->delete();
        return redirect('/en/admin/dashboard');
    }

    public function deleteArTeacher($id){
        ArTeacher::find($id)->delete();
        return redirect('/en/admin/dashboard/ar');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/en/admin/dashboard');
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Email or Password is wrong.']);
    }

}

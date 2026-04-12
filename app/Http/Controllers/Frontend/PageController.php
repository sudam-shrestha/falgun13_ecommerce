<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\DokanRequestNotification;
use App\Models\Admin;
use App\Models\Dokan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function dokan_registration(Request $request)
    {
        $request->validate([
            "name" => "required|max:60",
            "email" => "required|email|unique:dokans,email",
            "contact_no" => "required|numeric|unique:dokans,contact_no",
            "message" => "required|max:255",
        ]);
        $dokan = new Dokan();
        $dokan->name = $request->name;
        $dokan->email = $request->email;
        $dokan->contact_no = $request->contact_no;
        $dokan->message = $request->message;
        $dokan->save();
        $admins = Admin::all();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new DokanRequestNotification($dokan));
        }
        toast("Registration successful", "success");
        return redirect()->route('home');
    }
}

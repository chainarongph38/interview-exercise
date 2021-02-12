<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact/index');
    }

    public function store(Request $request)
    {
//        print_r($request);
//        alert($request);exit;
        return response($request->all(), 200);
    }
}

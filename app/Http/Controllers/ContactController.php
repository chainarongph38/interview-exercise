<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactPostRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact/index');
    }

    public function store(ContactPostRequest $request)
    {
        try {
            $result = ['status' => 200];
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e,
            ];
        }
        return response($result, $result['status']);
    }
}

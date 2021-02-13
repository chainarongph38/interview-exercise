<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactPostRequest;
use App\Http\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(ContactPostRequest $request)
    {
        try {
            $contactService = new ContactService();
            $contactService->saveData($request->all());
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

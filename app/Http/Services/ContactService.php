<?php
namespace App\Http\Services;

use App\Mail\ContactNotification;
use App\Models\Inquiries;
use Illuminate\Support\Facades\Mail;

class ContactService {
    public function saveData($data)
    {
        $inquiries = new Inquiries();
        $inquiries->name = $data['name'];
        $inquiries->email = $data['email'];
        $inquiries->phone = $data['phone'];
        $inquiries->message = $data['message'];
        $inquiries->save();
        $this->sendMail($data);
    }

    public function sendMail($data)
    {
        Mail::to('innovation@comseven.com')->send(new ContactNotification($data));
    }
}

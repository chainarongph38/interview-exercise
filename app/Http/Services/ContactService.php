<?php
namespace App\Http\Services;

use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Mail;

class ContactService {
    public function saveData($data)
    {
        $this->sendMail($data);
    }

    public function sendMail($data)
    {
        Mail::to('innovation@comseven.com')->send(new ContactNotification($data));
    }
}

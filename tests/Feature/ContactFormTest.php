<?php

namespace Tests\Feature;

use App\Http\Services\ContactService;
use App\Mail\ContactNotification;
use App\Models\Inquiries;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidateSaveData()
    {
        $response = $this->json('POST', '/contact');
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The name field is required.', $result['errors']['name'][0]);
        $this->assertEquals('The email field is required.', $result['errors']['email'][0]);
        $this->assertEquals('The phone field is required.', $result['errors']['phone'][0]);
        $this->assertEquals('The message field is required.', $result['errors']['message'][0]);
    }

    public function testValidateSaveDataNameNoData()
    {
        $response = $this->json('POST', '/contact', ['email' => 'sadadwqe@gmail.com', 'phone' => '0888888888', 'message' => 'aaaaa']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The name field is required.', $result['errors']['name'][0]);
        $this->assertArrayNotHasKey('email', $result['errors']);
        $this->assertArrayNotHasKey('phone', $result['errors']);
        $this->assertArrayNotHasKey('message', $result['errors']);
    }

    public function testValidateSaveDataNameMoreThan50Character()
    {
        $response = $this->json('POST', '/contact', ['name' => 'namenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamenamename', 'email' => 'sadadwqe@gmail.com', 'phone' => '0888888888', 'message' => 'aaaaa']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The name may not be greater than 50 characters.', $result['errors']['name'][0]);
        $this->assertArrayNotHasKey('email', $result['errors']);
        $this->assertArrayNotHasKey('phone', $result['errors']);
        $this->assertArrayNotHasKey('message', $result['errors']);
    }

    public function testValidateSaveDataEmailNoData()
    {
        $response = $this->json('POST', '/contact', ['name' => 'name', 'phone' => '0888888888', 'message' => 'aaaaa']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The email field is required.', $result['errors']['email'][0]);
        $this->assertArrayNotHasKey('phone', $result['errors']);
        $this->assertArrayNotHasKey('name', $result['errors']);
        $this->assertArrayNotHasKey('message', $result['errors']);
    }

    public function testValidateSaveDataEmailInvalidFormat()
    {
        $response = $this->json('POST', '/contact', ['name' => 'name','email' => 'dasdadas', 'phone' => '0888888888', 'message' => 'aaaaa']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The email must be a valid email address.', $result['errors']['email'][0]);
        $this->assertArrayNotHasKey('phone', $result['errors']);
        $this->assertArrayNotHasKey('name', $result['errors']);
        $this->assertArrayNotHasKey('message', $result['errors']);
    }


    public function testValidateSaveDataPhoneNoData()
    {
        $response = $this->json('POST', '/contact', ['name' => 'name','email' => 'test@gmail.com', 'message' => 'aaaaa']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The phone field is required.', $result['errors']['phone'][0]);
        $this->assertArrayNotHasKey('email', $result['errors']);
        $this->assertArrayNotHasKey('name', $result['errors']);
        $this->assertArrayNotHasKey('message', $result['errors']);
    }

    public function testValidateSaveDataMessageNoData()
    {
        $response = $this->json('POST', '/contact', ['name' => 'name','email' => 'test@gmail.com', 'phone' => '08894656']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The message field is required.', $result['errors']['message'][0]);
        $this->assertArrayNotHasKey('email', $result['errors']);
        $this->assertArrayNotHasKey('name', $result['errors']);
        $this->assertArrayNotHasKey('phone', $result['errors']);
    }

    public function testValidateSaveDataMessageMorethan500Character()
    {
        $response = $this->json('POST', '/contact', ['name' => 'name','email' => 'test@gmail.com', 'phone' => '08894656', 'message' => 'teststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetestteststetstestsetsetsetsetest']);
        $result = $response->decodeResponseJson()->json();
        $response->assertStatus(422);
        $this->assertEquals('The message may not be greater than 500 characters.', $result['errors']['message'][0]);
        $this->assertArrayNotHasKey('email', $result['errors']);
        $this->assertArrayNotHasKey('name', $result['errors']);
        $this->assertArrayNotHasKey('phone', $result['errors']);
    }

    public function testInsertDataToDatabase()
    {
        $result = Inquiries::factory()->make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '0888888888',
            'message' => 'test'
        ]);
        $this->assertEquals('test', $result->getAttribute('name'));
        $this->assertEquals('test@gmail.com', $result->getAttribute('email'));
        $this->assertEquals('0888888888', $result->getAttribute('phone'));
        $this->assertEquals('test', $result->getAttribute('message'));
    }

    public function testNotificationEmail()
    {
        Mail::fake();
        Mail::to('innovation@comseven.com')->send(new ContactNotification([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '0888888888',
            'message' => 'test'
        ]));
        Mail::assertSent(ContactNotification::class);
    }
}

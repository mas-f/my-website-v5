<?php

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteProfile;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    SiteProfile::factory()->create();
});

function validContactPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'subject' => 'Diskusi aplikasi Laravel',
        'message' => 'Saya ingin mendiskusikan perbaikan alur admin pada aplikasi Laravel yang sedang kami gunakan.',
    ], $overrides);
}

test('contact form stores a message and sends a notification', function () {
    Mail::fake();

    $response = $this->post(route('contact.store'), validContactPayload());

    $response
        ->assertRedirect(route('contact.create'))
        ->assertSessionHas('success');

    $message = ContactMessage::query()->firstOrFail();

    expect($message->name)->toBe('Budi Santoso')
        ->and($message->email)->toBe('budi@example.com')
        ->and($message->status->value)->toBe('new');

    Mail::assertSent(ContactMessageReceived::class, function (ContactMessageReceived $mail) use ($message) {
        return $mail->contactMessage->is($message)
            && $mail->hasTo('fikri.amrulloh15@gmail.com');
    });
});

test('contact form validates required fields', function () {
    $this->post(route('contact.store'), [])
        ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

    expect(ContactMessage::query()->count())->toBe(0);
});

test('contact form rejects a short message', function () {
    $this->post(route('contact.store'), validContactPayload(['message' => 'Terlalu singkat.']))
        ->assertSessionHasErrors('message');

    expect(ContactMessage::query()->count())->toBe(0);
});

test('contact form silently ignores honeypot submissions', function () {
    Mail::fake();

    $this->post(route('contact.store'), validContactPayload(['website' => 'https://spam.example']))
        ->assertRedirect(route('contact.create'))
        ->assertSessionHas('success');

    expect(ContactMessage::query()->count())->toBe(0);
    Mail::assertNothingSent();
});

test('contact form is rate limited', function () {
    Mail::fake();

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('contact.store'), validContactPayload([
            'subject' => 'Percobaan '.$attempt,
        ]))->assertRedirect(route('contact.create'));
    }

    $this->post(route('contact.store'), validContactPayload([
        'subject' => 'Percobaan terakhir',
    ]))->assertTooManyRequests();
});

test('contact notification renders correctly', function () {
    $message = ContactMessage::factory()->create();

    $rendered = (new ContactMessageReceived($message))->render();
    $plain = strip_tags($rendered);

    expect($plain)
        ->toContain($message->name)
        ->toContain($message->subject)
        ->toContain(strtok($message->message, "\n"));
});

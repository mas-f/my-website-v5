<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
});

test('admin can view the message inbox', function () {
    $message = ContactMessage::factory()->create([
        'subject' => 'Pesan penting',
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.messages.index'))
        ->assertOk()
        ->assertSee($message->subject);
});

test('opening a message marks it as read', function () {
    $message = ContactMessage::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.messages.show', $message))
        ->assertOk()
        ->assertSee($message->subject);

    $message->refresh();

    expect($message->status)->toBe(ContactMessageStatus::Read)
        ->and($message->read_at)->not->toBeNull();
});

test('admin can update a message status', function () {
    $message = ContactMessage::factory()->create();

    $this->actingAs($this->admin)
        ->patch(route('admin.messages.update', $message), ['status' => 'replied'])
        ->assertRedirect();

    expect($message->refresh()->status)->toBe(ContactMessageStatus::Replied);
});

test('admin can delete a message', function () {
    $message = ContactMessage::factory()->create();

    $this->actingAs($this->admin)
        ->delete(route('admin.messages.destroy', $message))
        ->assertRedirect(route('admin.messages.index'));

    $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
});

test('non-admin users cannot read messages', function () {
    $user = User::factory()->create();
    $message = ContactMessage::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.messages.show', $message))
        ->assertForbidden();
});

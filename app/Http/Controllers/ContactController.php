<?php

namespace App\Http\Controllers;

use App\Enums\ContactMessageStatus;
use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('pages.contact', [
            'profile' => SiteProfile::current(),
        ]);
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        if ($request->filled('website')) {
            Log::notice('Contact form honeypot triggered.', ['ip' => $request->ip()]);

            return redirect()
                ->route('contact.create')
                ->with('success', 'Terima kasih. Pesan Anda sudah diterima.');
        }

        $message = ContactMessage::query()->create([
            ...$request->safe()->except('website'),
            'status' => ContactMessageStatus::New,
        ]);

        try {
            Mail::to(SiteProfile::current()->email)
                ->send(new ContactMessageReceived($message));
        } catch (Throwable $exception) {
            report($exception);
        }

        return redirect()
            ->route('contact.create')
            ->with('success', 'Terima kasih. Pesan Anda sudah tersimpan dan akan dibaca secepatnya.');
    }
}

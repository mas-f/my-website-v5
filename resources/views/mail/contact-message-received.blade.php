<x-mail::message>
# Pesan baru dari situs

**Nama:** {{ $contactMessage->name }}
**Email:** {{ $contactMessage->email }}
**Subjek:** {{ $contactMessage->subject }}

---

{{ $contactMessage->message }}

<x-mail::button :url="route('admin.messages.show', $contactMessage)">
    Buka di panel admin
</x-mail::button>

Pesan ini juga tersimpan di database. Balas langsung ke alamat email pengirim.
</x-mail::message>

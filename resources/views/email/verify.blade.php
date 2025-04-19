@component('mail::message')
# Konfirmasi Email

Halo {{ $user->nama_lengkap }},

Klik tombol di bawah untuk memverifikasi alamat email kamu:

@component('mail::button', ['url' => $verificationUrl])
Verifikasi Sekarang
@endcomponent

Terima kasih,<br>
PT. Dewa Tunggal Abadi
@endcomponent

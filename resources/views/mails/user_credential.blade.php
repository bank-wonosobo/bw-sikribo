<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikribo Bank Wonosobo - User Login Details</title>
</head>
<body>
    <p>Kepada Yth. <strong>{{ $details['nama'] }}</strong>,</p>

    <p>Selamat datang di Sikribo Bank Wonosobo!</p>
    <p>Email ini berisi informasi login untuk akun Anda di sistem Sikribo Bank Wonosobo.</p>

    <h3>Informasi Login:</h3>
    <p>Email: <strong>{{ $details['email'] }}</strong></p>
    <p>Password: <strong>{{ $details['password'] }}</strong></p>

    <h3>Langkah-langkah Login:</h3>
    <ol>
        <li>Buka situs web <a href="https://sikribo.bankwonosobo.co.id/">https://sikribo.bankwonosobo.co.id/</a></li>
        <li>Klik tombol "Login" di bagian atas halaman.</li>
        <li>Masukkan username dan password Anda di kolom yang disediakan.</li>
        <li>Klik tombol "Login".</li>
    </ol>

    <h3>Catatan:</h3>
    <ul>
        <li>Harap simpan informasi login ini dengan aman dan rahasia.</li>
        <li>Jika Anda lupa password Anda, Anda dapat mengklik tombol "Lupa Password?" di halaman login.</li>
        <li>Jika Anda mengalami masalah saat login, silakan hubungi tim support kami di <a href="mailto:ahmmd.riffai@gmail.com">ahmmd.riffai@gmail.com</a> atau <a href="tel:085155380996">085155380996</a>.</li>
    </ul>

    <p>Terima kasih telah menggunakan Sikribo Bank Wonosobo!</p>

    <p>Salam,</p>
    <p>Tim Sikribo Bank Wonosobo</p>

    <hr>

    <p><strong>Catatan:</strong></p>
    <ul>
        <li>Anda dapat mengubah password Anda setelah login ke sistem.</li>
        <li>Anda dapat mengakses berbagai fitur dan layanan Sikribo Bank Wonosobo melalui sistem ini.</li>
        <li>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi tim support kami.</li>
    </ul>

    <p>Semoga email ini bermanfaat!</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Anda telah berhasil dikirim</title>
</head>
<body>
    <h2>Pengaduan Anda telah berhasil dikirim</h2>
    <p>Terima kasih atas pengaduan yang telah Anda sampaikan kepada kami.</p>

    <h3>Detail Pengaduan</h3>
    <table>
        <tr>
            <th>Nama</th>
            <td>{{ $details['nama'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $details['email'] }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $details['telepon'] }}</td>
        </tr>
        <tr>
            <th>Masalah</th>
            <td>{{ $details['subjek'] }}</td>
        </tr>
    </table>
</body>
</html>
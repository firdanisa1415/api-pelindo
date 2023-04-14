<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengirim</title>
</head>
<body>
    <h3 class="mb-2">Hi! {{$user['nama_karyawan']}}</h3>
    <p>Pengaduan Anda telah berhasil dikirim. Terima kasih atas pengaduan yang telah Anda sampaikan kepada kami.</p>
    <p>Adapun detail laporan yang Anda kirimkan seperti berikut</p>
    <table>
        <tr>
            <td>Nomor Ticket</td>
            <td> : {{ $newPelaporan['id_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td> : {{ $user['nama_karyawan'] }}</td>
        </tr>
        <tr>
            <td>NRP</td>
            <td> : {{ $user['nrp'] }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td> : {{ $user['email'] }}</td>
        </tr>
        <tr>
            <td>Judul Tiket</td>
            <td> : {{ $newPelaporan['judul_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Produk</td>
            <td> : {{ $newPelaporan['jenis_product'] }}</td>
        </tr>
        <tr>
            <td>Permasalahan</td>
            <td> : {{ $newPelaporan['isi_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Harapan</td>
            <td> : {{ $newPelaporan['harapan'] }}</td>
        </tr>
        <tr>
            <td>PIC Penugasan</td>
            <td> : {{$newPelaporan['nama_pic']}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td> : {{$newPelaporan['status']}}</td>
        </tr>
    </table>
    <p>Pengaduan akan segera dikerjakan oleh PIC yang terpilih. Tunggu update-an terbaru yang kami kirimkan.</p>
    <p>Best regards,</p>
</body>
</html>

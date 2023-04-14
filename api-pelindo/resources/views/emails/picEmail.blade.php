<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengirim</title>
</head>
<body>
    <h3>Hi! {{ $picPelaporan->pic }}</h3>
    <p>Kamu mendapatkan penugasan tiket baru</p>
    <p>Tiket yang harus diselesaikan dengan detail sebagai berikut</p>
    <table>
        <tr>
            <td>Nomor Ticket</td>
            <td> : {{ $newPelaporan['id_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Nama Pelapor</td>
            <td> : {{ $picPelaporan->pelapor }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td> : {{ $picPelaporan->mailpelapor}}</td>
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
            <td>Status</td>
            <td> : {{$newPelaporan['status']}}</td>
        </tr>
    </table>
    <p>Segera selesaikan tiket ini sebelum tanggal {{$newPelaporan['tanggal_selesai'] }}</p>
    <p>Best regards,</p>
</body>
</html>

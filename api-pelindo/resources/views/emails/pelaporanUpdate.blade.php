<!DOCTYPE html>
<html>
<head>
    <title>Detail update</title>
</head>
<body>
    <h3 class="mb-2">Hi! {{$data->user->nama_karyawan}}</h3>
    <p>Pengaduan Anda telah selesai dikerjakan</p>
    <p>Adapun detail laporan yang Anda kirimkan seperti berikut</p>
    <table>
        <tr>
            <td>Nomor Ticket</td>
            <td> : {{ $data['id_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Judul Tiket</td>
            <td> : {{ $data['judul_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Produk</td>
            <td> : {{ $data['jenis_product'] }}</td>
        </tr>
        <tr>
            <td>Permasalahan</td>
            <td> : {{ $data['isi_pelaporan'] }}</td>
        </tr>
        <tr>
            <td>Harapan</td>
            <td> : {{ $data['harapan'] }}</td>
        </tr>
        <tr>
            <td>PIC Penugasan</td>
            <td> : {{$data['nama_pic']}}</td>
        </tr>
    </table>
    <p>Harap cek kembali dan jika masalah masih belum teratasi silahkan menghubungi PIC yang ditugaskan</p>
    <p>Best regards,</p>
</body>
</html>
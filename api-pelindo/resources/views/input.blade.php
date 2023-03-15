<!DOCTYPE html>
<html>
<head>
    <title>Pelaporan</title>
</head>
<body>
    <h1>Pelaporan</h1>
    <form action="{{ route('prediksi.sentimen') }}" method="POST">
        @csrf
        @method('PUT')
        <label for="teks">Teks:</label><br>
        <textarea id="teks" name="teks"></textarea><br>
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
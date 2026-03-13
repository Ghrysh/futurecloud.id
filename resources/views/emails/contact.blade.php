<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Website</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Pesan Baru dari Kontak Form</h2>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    <hr>
    <p><strong>Pesan:</strong></p>
    <p style="white-space: pre-line;">{{ $data['message'] }}</p>
</body>
</html>
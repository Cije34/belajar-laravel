<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            text-align: center;
        }
        h1 {
            color: #2d3748;
            margin-bottom: 16px;
        }
        p {
            color: #4a5568;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <p>
            Terima kasih telah bergabung! Kami sangat senang menyambut Anda.<br>
            Silakan jelajahi layanan kami dan nikmati fitur-fitur yang tersedia.
        </p>
        <p>
            {{ $user->name }}<br>
            {{ $user->email }}

            <img src="{{ asset('storage/images/huh.jpg') }}" alt="">
        </p>
    </div>
</body>
</html>

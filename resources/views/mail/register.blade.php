<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
    <style>
        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        @keyframes float {
            0% {transform: translateY(0px);}
            50% {transform: translateY(-20px);}
            100% {transform: translateY(0px);}
        }
        @keyframes pulse {
            0% {transform: scale(1);}
            50% {transform: scale(1.05);}
            100% {transform: scale(1);}
        }
        @keyframes slide-in {
            0% {transform: translateX(-100%); opacity: 0;}
            100% {transform: translateX(0); opacity: 1;}
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #89f7fe, #66a6ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        .container::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            z-index: -1;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        h1::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #ff3b3b 0%, #1e1e1e 100%);
        }
        .logo {
            display: block;
            margin: 0 auto 30px;
            max-width: 150px;
            animation: float 6s ease-in-out infinite;
        }
        .btn {
            display: inline-block;
            background:grey;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.5s;
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        p {
            margin-bottom: 20px;
            line-height: 1.8;
            position: relative;
            z-index: 1;
        }
        .highlight {
            background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
            background-repeat: no-repeat;
            background-size: 100% 0.2em;
            background-position: 0 88%;
            transition: background-size 0.25s ease-in;
            padding: 0 5px;
        }
        .highlight:hover {
            background-size: 100% 88%;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="https://via.placeholder.com/150x150.png?text=Your+Logo" alt="Logo" class="logo">
    <h1>Selamat Datang, <span class="highlight">{{$user->name}}</span>!</h1>
    <p>Terima kasih telah bergabung dengan kami! Akun Anda telah berhasil dibuat dan Anda hanya selangkah lagi untuk memulai petualangan luar biasa bersama kami.</p>

    <p>Untuk memulai perjalanan Anda, silakan aktifkan akun Anda dengan mengklik tombol di bawah ini:</p>
    <p style="text-align: center;">
        <a href="{{url("/register/activation/$user->token_activation")}}" class="btn" rel="noopener noreferrer" style="text-decoration: none; color: white;">Aktivasi Sekarang</a>
    </p>
    <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempelkan URL berikut ke browser Anda:</p>
    <p style="/*word-break: break-all;*/ font-size: 12px; color: black;">{{url("/register/activation/$user->token_activation")}}</p>
    <p>Jika Anda tidak mendaftar untuk layanan ini, Anda dapat mengabaikan email ini.</p>
    <p>Kami sangat bersemangat untuk menyambut Anda di komunitas kami!</p>
</div>
</body>
</html>

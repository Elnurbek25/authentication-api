<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-wrapper {
            width: 100%;
            background-color: #ffffff;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .email-header h1 {
            color: #4CAF50;
            font-size: 30px;
            margin: 0;
        }

        .email-content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .email-content p {
            margin: 0 0 20px;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1>Email Verification</h1>
        </div>
        <div class="email-content">
            <p>Hello {{ $user->name }},</p>
            <p>Thank you for registering with us. Please click the button below to verify your email address and complete your registration:</p>
            <a href="{{ $link }}" class="btn">Verify Email</a>
            <p>If you did not register, please ignore this email.</p>
        </div>
        {{$link}}
       
    </div>
</body>
</html>
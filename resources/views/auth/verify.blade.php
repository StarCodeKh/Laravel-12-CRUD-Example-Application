<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4361eecc;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin: 20px 0;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #4361eecc;
            text-decoration: none;
            border-radius: 5px;
        }
        .ii a[href] {
            color: white !important;
        }
        .footer {
            text-align: center;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verify Your Email Address</h2>
        </div>
        <div class="content">
            <p>To complete your email verification, please click the link below:</p>
            <a href="{{ url('/reset-password/'.$token) }}" class="btn">Click Here to Reset Your Password</a>
            <p class="footer">If you didn’t request a password reset, no further action is required.</p>
        </div>
    </div>
</body>
</html>
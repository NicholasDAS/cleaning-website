<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Message Sent</title>

    <meta http-equiv='refresh' content='30;url=contact.html'>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f7f7f7, #e8e8e8);
            font-family: Arial, Helvetica, sans-serif;
        }

        .success-box {
            background: white;
            width: 450px;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
            animation: fadeIn 0.7s ease-in-out;
        }

        .success-box h1 {
            color: #28a745;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .success-box p {
            font-size: 18px;
            color: #555;
            margin-bottom: 25px;
        }

        .loader {
            border: 6px solid #ddd;
            border-top: 6px solid #28a745;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            margin: 20px auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
<div class='success-box'>
    <h1>Message Sent Successfully!</h1>
    <p>
        Thank you for contacting <strong>Fabulous Cleaning Services</strong>.<br>
        We will get back to you shortly!
    </p>

    <div class='loader'></div>

    <p style="color:#777;margin-top:20px;">
        Redirecting you to the contact page in <strong>30 seconds....</strong>
    </p>
</div>

</body>
</html>

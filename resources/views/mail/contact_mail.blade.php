<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #333;
            font-size: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .info-table th, .info-table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .info-table th {
            background-color: #f8f8f8;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            Your Brand Name
        </div>
        <div class="content">
            <h2>Contact Form Submission</h2>
            <p>Dear Admin,</p>
            <p>You have received a new message from the contact form on your eCommerce site. Here are the details:</p>
            <table class="info-table">
                <tr>
                    <th>Name:</th>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <th>Subject:</th>
                    <td>{{ $data['subject'] }}</td>
                </tr>
                <tr>
                    <th>Message:</th>
                    <td>{{ $data['message'] }}</td>
                </tr>
            </table>
            <p>Thank you for your attention.</p>
        </div>
        <div class="footer">
            <p>© 2024 Your Brand Name. All rights reserved.</p>
            <p><a href="https://yourwebsite.com">Visit our website</a></p>
        </div>
    </div>
</body>
</html>

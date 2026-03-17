<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .content {
            padding: 20px 0;
        }
        .field {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            margin-top: 5px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Us Message</h1>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Full Name:</div>
                <div class="value">{{ $fullName }}</div>
            </div>

            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $email }}</div>
            </div>

            <div class="field">
                <div class="label">Phone:</div>
                <div class="value">{{ $phone }}</div>
            </div>

            <div class="field">
                <div class="label">Subject:</div>
                <div class="value">{{ $emailSubject }}</div>
            </div>

            <div class="field">
                <div class="label">Message:</div>
                <div class="value" style="white-space: pre-wrap;">{{ $message }}</div>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated email from your website's contact form. Please reply to the sender's email address to respond.</p>
        </div>
    </div>
</body>
</html>

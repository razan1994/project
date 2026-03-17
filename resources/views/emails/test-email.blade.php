<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Test Email' }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; color: #222; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 12px rgba(44,62,125,0.07); padding: 32px; }
        h2 { color: #2c3e7d; margin-bottom: 16px; }
        p { font-size: 1.1rem; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $subject ?? 'Test Email' }}</h2>
        <p>{{ $description ?? 'This is a test email from Protajer.' }}</p>
    </div>
</body>
</html>

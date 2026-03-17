<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #f4f4f4; padding: 20px; border-radius: 5px 5px 0 0; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #333; font-size: 24px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; margin-top: 5px; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Consultation Request</h1>
        </div>
        <div class="content">
            <div class="field"><span class="label">Full Name:</span> <span class="value">{{ $data['client_name'] ?? '' }}</span></div>
            <div class="field"><span class="label">Contact Number:</span> <span class="value">{{ $data['contact_number'] ?? '' }}</span></div>
            <div class="field"><span class="label">Preferred Time:</span> <span class="value">{{ $data['preferred_time'] ?? '' }}</span></div>
            <div class="field"><span class="label">Building Type:</span> <span class="value">{{ $data['building_type'] ?? '' }}</span></div>
            <div class="field"><span class="label">Approved Design:</span> <span class="value">{{ $data['approved_design'] ?? '' }}</span></div>
            <div class="field"><span class="label">Land Area:</span> <span class="value">{{ $data['land_area'] ?? '' }}</span></div>
            <div class="field"><span class="label">Construction Area:</span> <span class="value">{{ $data['construction_area'] ?? '' }}</span></div>
        </div>
        <div class="footer">
            <p>This is an automated email from your website's consultation form.</p>
        </div>
    </div>
</body>
</html>

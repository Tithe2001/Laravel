<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Online Consultation Link</title>
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6;">
    <h2>Dear {{ $appointment->name }},</h2>

    <p>Thank you for booking an online consultation with us.</p>

    <p><strong>Appointment Details:</strong></p>
    <ul>
        <li><strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}</li>
        <li><strong>Date:</strong> {{ $appointment->appointment_date }}</li>
        <li><strong>Time:</strong> {{ $appointment->appointment_time }}</li>
    </ul>

    <p>Please use the following link to join your consultation:</p>

    <p style="text-align:center;">
        <a href="{{ $meetLink }}" style="display:inline-block; padding:12px 24px; background-color:#28a745; color:#fff; text-decoration:none; border-radius:5px;">
            Join Consultation
        </a>
    </p>

    <p>If the button above does not work, copy and paste this link into your browser:</p>
    <p>{{ $meetLink }}</p>

    <hr>
    <p style="font-size:0.9em; color:#555;">This is an automated message. Please do not reply to this email.</p>
</body>
</html>

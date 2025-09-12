<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message-content {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .contact-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            color: #6c757d;
            font-size: 12px;
            margin-top: 30px;
        }
        .label {
            font-weight: bold;
            color: #495057;
        }
        .value {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Contact Message Received</h2>
        <p>A new contact message has been submitted through your website.</p>
    </div>

    <div class="contact-info">
        <h3>Contact Information</h3>
        <div class="value">
            <span class="label">Name:</span> {{ $contactMessage->name }}
        </div>
        <div class="value">
            <span class="label">Email:</span>
            <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
        </div>
        @if($contactMessage->phone_number)
        <div class="value">
            <span class="label">Phone:</span>
            <a href="tel:{{ $contactMessage->phone_number }}">{{ $contactMessage->phone_number }}</a>
        </div>
        @endif
        <div class="value">
            <span class="label">Subject:</span> {{ $contactMessage->subject }}
        </div>
        <div class="value">
            <span class="label">Received:</span> {{ $contactMessage->created_at ? $contactMessage->created_at->format('F d, Y \a\t g:i A') : 'Not available' }}
        </div>
    </div>

    <div class="message-content">
        <h3>Message</h3>
        <p>{{ $contactMessage->message }}</p>
    </div>

    <div class="footer">
        <p>This message was sent from your website contact form.</p>
        <p>To view and manage contact messages, please log in to your dashboard.</p>
    </div>
</body>
</html>

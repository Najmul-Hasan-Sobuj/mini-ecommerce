<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Reply</title>
</head>

<body>
    <p>Hello {{ $contact->name }},</p>
    <p>Thank you for your message. We will get back to you as soon as possible.</p>
    <p>Message: {{ $contact->msg }}</p>
    <p>Regards,<br>Your Company Name</p>
</body>

</html>

<!-- resources/views/emails/contactus.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Message</title>
</head>
<body>
    <h1>Contact Us Message</h1>
    <p><strong>Name:</strong> {{ $details['name'] }}</p>
    <p><strong>Email:</strong> {{ $details['email'] }}</p>
    <p><strong>Phone:</strong> {{ $details['phone'] }}</p>
    <p><strong>Subject:</strong> {{ $details['subject'] }}</p>
    <p><strong>Message:</strong> {{ $details['message'] }}</p>
</body>
</html>

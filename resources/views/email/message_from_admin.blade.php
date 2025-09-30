<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __("New Message Received") }}</title>
</head>
<body>
<h2>{{ __("Admin from Rosen i Vara has sent you a message") }}</h2>


<p>User Name:</p><p style="color:green;">{{ $user->fullname }}</p>
<p>Message:</p><p style="color:green;">{{ $messageBody }}</p>


</body>

</html>

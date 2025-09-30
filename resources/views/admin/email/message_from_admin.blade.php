<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __("New Message Received") }}</title>
</head>
<body>
<h2>{{ __("Admin from Rosen i Vara has sent you a message") }}</h2>


<p><strong>Name:</strong> {{ $user->fullname }}</p>

<p><strong>Message:</strong></p>
<p style="font-size:14px;">{!! $messageBody !!}</p>

@if($attachment)
<br>
<p><a href="{!! url('public') !!}/{{$attachment}}" target="_blank">{{ __("View Attachment") }}</a></p>
@endif

<br><br><br>

<p><a href="{!! url('/') !!}/" target="_blank">{{ config('app.name') }} Team</a></p>

</body>

</html>

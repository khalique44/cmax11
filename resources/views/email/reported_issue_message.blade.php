<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __("New Message Received") }}</title>
</head>
<body>
<h2>{{ __("Issue Reported by ") }} {{ $user->full_name }}</h2>


<p><strong>Name:</strong> {{ $user->full_name }}</p>
<p><strong>Reason Title:</strong> {{ $record->reason->title }}</p>
<p><strong>Issue Type:</strong> {{ $record->issue_type }}</p>
<p><strong>Issue Status:</strong> {{ $record->issue_status }}</p>
<p><strong>Issue Description:</strong> {{ $record->description }}</p>
@if($record->more_description)
<br>
<p><strong>More Details:</strong></p>
<p style="font-size:14px;">{{ $record->more_description }}</p>
@endif

@if($attachment)
<br>
<p><a href="{!! url('public') !!}/{{$attachment}}" target="_blank">{{ __("View Attachment") }}</a></p>
@endif

<br><br><br>

<p><a href="{!! url('/') !!}/" target="_blank">{{ config('app.name') }} Team</a></p>

</body>

</html>

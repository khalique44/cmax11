<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Email For Contest Completion</title>
</head>
<body>
<h2>Welcome to National Physique Committee Worldwide.</h2>


<p>User Name:</p><p style="color:green;">{{$user->first_name.'-'.$user->last_name}}</p>
<p>Contest Name:</p><p style="color:green;">{{$contest->title}}</p>
<p>Contest Date:</p><p style="color:green;">{{date('d M Y',strtotime($contest->date))}}</p>
<P>Please click on link given below to approve for contest completion
</P>
<a href='{{ route("contests.approve_for_contest_completion",[$user->id,$contest->id]) }}'>Complete</a>

</body>

</html>

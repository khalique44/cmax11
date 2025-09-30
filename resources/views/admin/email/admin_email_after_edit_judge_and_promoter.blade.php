<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Approval Email</title>
</head>
<body>
<h2>Welcome to National Physique Committee Worldwide.</h2>
<p>Contest Name:</p><p style="color:green;">{{$contest->title}}</p>
<p>Contest Date:</p><p style="color:green;">{{date('d M Y',strtotime($contest->date))}}</p>
<p>{!! $user->first_name !!} Admin Add some changes to Your account for
    @if($user->type == "pro-athlete" || ($user->type === "non-athlete" && @$user->registration_type->name === "judge") )
        Judge
    @elseif($user->type == "non-athlete")
        @if(@$user->registration_type->name == "expediter")
            Expediter
        @endif
        @if(@$user->registration_type->name == "promoter")
            Promoter
        @endif
        @if(@$user->registration_type->name == "trainer")
            Trainer
        @endif
    @else
        Contestant
    @endif
    ,
    <strong>"<i>{!! $user->email !!}</i>"</strong> Please click on link given below to move your contests lists.<br>
    <a href='{{ route("contests.my-contests") }}'>Go To My Contests</a>
</p>
</body>

</html>

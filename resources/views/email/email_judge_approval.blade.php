<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Approval Email For Judge</title>
</head>
<body>
<h2>Welcome to National Physique Committee Worldwide.</h2>


<p>User Name:</p><p style="color:green;">{{$user->first_name.'-'.$user->last_name}}</p>
<p>Contest Name:</p><p style="color:green;">{{$contest->title}}</p>
<p>Contest Date:</p><p style="color:green;">{{date('d M Y',strtotime($contest->date))}}</p>
    <P>Please click on link given below to approve Pro-Athlete user for
        @if($user->type == "pro-athlete" || ($user->type === "non-athlete" && @$user->registration_type->name === "judge") )
            judge
        @endif
        @if($user->type == "non-athlete")
            @if(@$user->registration_type->name == "expediter")
                Expediter
            @endif
            @if(@$user->registration_type->name == "promoter")
                Promoter
            @endif
            @if(@$user->registration_type->name == "trainer")
                Trainer
            @endif
        @endif
    </P>
<a href='{{ route("contests.approve_for_judges_and_promoters",[$user->id,$contest->id]) }}'>Approve</a>

</body>

</html>

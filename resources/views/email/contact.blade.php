<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Submission</title>
</head>
@php 
    $copy_right_text = GeneralHelper::getOption('copy_right_text');
    $header_logo = GeneralHelper::getOption('header_logo');
@endphp
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

    <table width="100%" style="max-width:600px; margin:auto; background:#fff; border-radius:8px; overflow:hidden;">
        <tr style="background:#222; color:#fff;">
            <td style="padding:20px; text-align:center;">
                <img src="{!! !empty($header_logo) ? url('public/'.$header_logo) : url('public/assets/img/logo.png') !!}" alt="Logo" style="max-height:60px;">
                <h2 style="margin:10px 0 0; font-size:20px;">New Contact Message</h2>
            </td>
        </tr>
        <tr>
            <td style="padding:20px; color:#333;">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Phone:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                <p><strong>Message:</strong></p>
                <p style="background:#f9f9f9; padding:10px; border-radius:5px;">{{ $data['message'] }}</p>
            </td>
        </tr>
        <tr style="background:#f0f0f0; text-align:center; color:#666;">
            <td style="padding:15px;">
                <small>&copy; {{ date('Y') }} {{ $copy_right_text }}.</small>
            </td>
        </tr>
    </table>

</body>
</html>

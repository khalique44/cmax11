<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Project Inquiry</title>
</head>
@php 
    $copy_right_text = GeneralHelper::getOption('copy_right_text');
    $header_logo = GeneralHelper::getOption('header_logo');
@endphp
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

    <table width="100%" style="max-width:650px; margin:auto; background:#fff; border-radius:8px; overflow:hidden;">
        <tr style="background:#004085; color:#fff;">
            <td style="padding:20px; text-align:center;">
                <img src="{!! !empty($header_logo) ? url('public/'.$header_logo) : url('public/assets/img/logo.png') !!}" alt="Logo" style="max-height:60px;">
                <h2 style="margin:10px 0 0; font-size:20px;">New Project Inquiry</h2>
            </td>
        </tr>
        <tr>
            <td style="padding:20px; color:#333;">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
                <p><strong>Project Title:</strong> {{ $data['project_title'] }}</p>
                <p><strong>Project URL:</strong> {{ $data['project_url'] ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $data['address'] ?? 'N/A' }}</p>
                <p><strong>Message:</strong></p>
                <p style="background:#f9f9f9; padding:10px; border-radius:5px;">{{ $data['message'] ?? 'No additional message' }}</p>
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

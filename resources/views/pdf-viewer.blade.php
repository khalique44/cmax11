<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            border: none;
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>

<iframe 
    src="/pdfjs/viewer.html?file={{ urlencode(url('file/view/'.$path)) }}">
</iframe>

</body>
</html>

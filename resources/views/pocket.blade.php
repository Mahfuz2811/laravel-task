<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Pockets</title>
</head>
<body>
<div>
    <ul>
        @foreach($contents as $content)
            <li>{{ $content->url }}</li>
        @endforeach
    </ul>
</div>
</body>
</html>

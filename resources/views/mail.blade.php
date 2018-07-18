<!doctype html>

<html>
<head>
    <style>
        body{
            background-color: #f5f5f5;
            padding: 0 50px;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
        }
        .mail__header{
            width: 100%;
            height: 50px;
            background-color: yellow;
        }
    </style>
</head>
<body>
<header class="mail__header">

</header>

<div class="container">
    @yield('content')
</div>
</body>
</html>

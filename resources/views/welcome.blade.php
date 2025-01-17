<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />

    @vite(['resources/js/app.js'])
</head>

<body>
    <h1>Welcome</h1>
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            Echo.channel('testing')
                .listen('RealTimeNotificationEvent', (e) => {
                    console.log('e.order.name');
                });
        });
    </script>
</body>

</html>

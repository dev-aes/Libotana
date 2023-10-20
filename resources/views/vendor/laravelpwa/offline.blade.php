<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offline</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.css') }}">
</head>

<body>
    <div class='container'>
        <div class='row justify-content-center py-5'>
            <div class='col-md-12'>
                <figure>
                    <img class='img-fluid d-block mx-auto' src='{{ asset('img/errors/offline.svg') }}' width='500'
                        alt="offline">
                    <figcaption>
                        <p class='text-center font-weight-bold text-danger'>You are currently Offline, <br> Please
                            connect to
                            WIFI</p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</body>

</html>

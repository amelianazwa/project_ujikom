 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="{{asset('assets/img/favicon/1669103641950 1.png')}}" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>login</title>
    <style>
        /* CSS untuk background SVG */
        body {
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1365" height="698" viewBox="0 0 1365 698" fill="none"><path d="M0 687.408C0 687.408 1358.2 711.239 1362.85 687.408C1381.41 592.305 1288.87 759.237 726 543.751C163.125 328.264 33.194 0 33.194 0H0V687.408Z" fill="%23D8EBF9"/></svg>');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;


        }
        @media (max-width: 768px) {
        body {
            background-size: contain;
            background-position: top center;
        }
}


        .container {
            display: flex;
            justify-content: space-between;
            padding: 2% 5%;
            position: relative;
        }

        .img {
            width: 50%;
           margin-right: 5%;
           margin-top: 10%;
        }
        .img img {
            width: 100%;
            height: auto;
        }

        .logo {

            width: 50%;
            text-align: right;
            align-content: center;
            margin-left: 10%;
            margin-right: 0%;


        }
        .logo img {
            width: 35%;
            height: auto;
            margin-right: 30%

        }

        /* Posisi form menjadi relatif dan berada di tengah */
        .form {
            position: relative;
            margin-top: 5%;
           align-content: center;
            padding-right: 10%;
        }

        /* Membuat label dan input lebih selaras */
        .form img {
            width: 40%;
            margin-right: 1%;;
        }
        .form button{
            margin-top: 5%;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="img grid-cols-5">
            <img  src="rb_2147848878.png" alt="Image">
        </div>
        <div class="logo">
            <img src="1669103641950 1.png" alt="Logo">
            <div class="form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-3 col-form-label text-md-end">
                            <img src="9068642 1 (6).png" alt="Email Icon">
                        </label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan email anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-12">
                        <label for="password" class="col-md-3 col-form-label text-md-end">
                            <img src="10542551 1.png" alt="Password Icon">
                        </label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukan password dengan benar">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-12-mt-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>

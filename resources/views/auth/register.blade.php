<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>sislab</title>
    <style>
        /* Background styling */
        body {
    margin: 0;
    padding: 0;
    width: 100vw;
    height: 100vh;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1365" height="698" viewBox="0 0 1365 698" fill="none"><path d="M0 687.408C0 687.408 1358.2 711.239 1362.85 687.408C1381.41 592.305 1288.87 759.237 726 543.751C163.125 328.264 33.194 0 33.194 0H0V687.408Z" fill="%23D8EBF9"/></svg>');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed; /* membuat latar belakang tetap diam */
}

.img {
            width: 50%;

           margin-right: 5%;
           margin-top: 0%
        }
        .img img {
            width: 90%;
            height: auto;
        }

        .logo img {
            width: 80%;
            max-width: 150px;
        }

        .form img {
            width: 30px;
            margin-right: 10px;
        }

        /* Custom button style */
        .form button {
            margin-top: 1rem;
        }

        /* Responsive margin adjustments */
        @media (max-width: 768px) {
            .form {
                padding-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center vh-100">
        <!-- Image Section -->
        <div class="img">
            <img src="rb_2147848878.png" alt="Decorative Image">
        </div>

        <!-- Logo and Form Section -->
        <div class="logo col-12 col-md-6 text-center">
            <img src="1669103641950 1.png" alt="Logo" class="mb-4">
            <div class="form mx-auto" style="max-width: 400px;">
                <form id="formAuthentication" class="mb-3" action="{{route('register')}}" method="post">
                    @csrf
                    <div class="row mb-3 align-items-center">
                        <label for="email" class="col-2 col-form-label">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAchJREFUSEvFk01PE1EUht9TNOpCqhEXLOgHQnQuGxLYEpdsJCHRBDZu2LlhUQV2zJ02aTQxGkLCTyBsCIJx4x+QhJAuTKeQ+jFjTI2JuhASENo5xtY2ndKZ20xtPMt77nmecz8OocNBHeajJUEsmbvNDqfBGCo3RHiLEM3bi9obVYNKQUya0wyslrHucJho8pOuvfST+ApiMnOFceEDgKsekC+l7ss3Pif6jrwkCoE5ycCGX4chpvGPhvY6kCBq5B6C+anvFRASli6eBxJEjNwEMW/5PiThjq2LV4EE/Y/fh0vHv94B6PEAfL14KTS4v3DrIJDgT1HMMKeYsdYE4BBw15LiReBfVC3sS2bHQg49AcpzUAKQJWDOkmK77TlQAVR55aCpAKq8p2Agnb9ePDl9xMAIGMMgXHPBGN9ByDB4p4hzzwry5rdmsqaCiGHeJwfLIIRVHf7N/yDiGUsf2mzcf0YQkdlZAi21CHZvI7pn69p6/aJLEE3txVFy8gC6AgmAw1N0xeuvyy2Q5gqABwHhlTLCoq2LVJXRKCgA6G1LAOzaUox6CU4AnG9T8NOWovY5Gk/AbcLL5bYUNe7/G7R/cZLKm3c4fgMpToIZJzlNGQAAAABJRU5ErkJggg=="/>
                        </label>
                        <div class="col-10">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="User name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="email" class="col-2 col-form-label">
                            <img src="9068642 1 (6).png" alt="Email Icon">
                        </label>
                        <div class="col-10">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan email anda">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="password" class="col-2 col-form-label">
                            <img src="10542551 1.png" alt="Password Icon">
                        </label>
                        <div class="col-10">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukan password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="password_confirmation" class="col-2 col-form-label">
                            <img src="10542551 1.png" alt="Password Icon">
                        </label>
                        <div class="col-10">
                            <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Masukan password lagi">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary w-100">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Crush On The most popular Admin Dashboard template and ui kit">
    <meta name="author" content="PuffinTheme the theme designer">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <title>Login BSN</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}" />

</head>

<body class="font-opensans">

    <div class="auth">
        <div class="auth_left">
            <div class="card">
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/bsn.png') }}" class="mt-4" width="80%" alt="">
                </div>
                <div class="card-body">
                    <div id="res-alert">

                    </div>
                    <div class="card-title">LOGIN</div>
                    <form action="{{ route('login.check') }}" method="POST" id="form-login">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" aria-describedby="username"
                                placeholder="Username" name="username" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" value="" required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block" title="">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="auth_right">
            <div class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../assets/images/slider1.svg" class="img-fluid" alt="login page" />
                        <div class="px-4 mt-4">
                            <h4>Fully Responsive</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/images/slider2.svg" class="img-fluid" alt="login page" />
                        <div class="px-4 mt-4">
                            <h4>Quality Code and Easy Customizability</h4>
                            <p>There are many variations of passages of Lorem Ipsum available.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/images/slider3.svg" class="img-fluid" alt="login page" />
                        <div class="px-4 mt-4">
                            <h4>Cross Browser Compatibility</h4>
                            <p>Overview We're a group of women who want to learn JavaScript.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <script>
        $('#form-login').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        $('#res-alert').html(
                            `<div class="alert alert-danger" role="alert">${response.errors}</div>`
                        )
                    }
                    if (response.success.create) {
                        $('#res-alert').html(
                            `<div class="alert alert-success" role="alert">${response.success.create}</div>`
                        )
                    } else if (response.success.url) {
                        window.location.href = response.success.url;

                    }
                }
            });
        });
    </script>
</body>

</html>

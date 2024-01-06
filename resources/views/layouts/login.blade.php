<!doctype html>
<html lang="{{ session('locale') }}">

<head>
    <meta charset="utf-8" />
    <title>Localkod - Online Chat App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web ve Mobil Projelerinizde Localkod yanınızda ! Projelerinizde %100 güvenli ve özgür bir yazılım için bizi tercih edebilirsiniz." />
    <meta name="author" content="Localkod" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">

    <link href="{{ asset('backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/js/lazysizes.min.js') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/sweetalert.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/toastify.min.css') }}" rel="stylesheet" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .form-check-label {
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Hoşgeldiniz !</h5>
                                        <p>
                                            Kullanıcı Adınız ve Şifrenizle Birlikte Giriş Yapmalısınız.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('backend/images/profile-img.png') }}" alt="Localkod-1" class="img-fluid lazyload">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="https://localkod.com/" target="_blank" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title cst-login-logo rounded-circle">
                                            <img src="{{ asset('backend/images/favicon.png') }}" alt="" class="img-fluid lazyload" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="https://localkod.com/" target="_blank" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title cst-login-logo rounded-circle">
                                            <img src="{{ asset('backend/images/favicon.png') }}" alt="" class="img-fluid lazyload" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" id="login-form" action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-Posta Adresiniz <span class="cst-required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-Posta Adresiniz *" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Şifreniz <span class="cst-required">*</span></label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="password" placeholder="Şifrenizi Giriniz *" name="password" required aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check font-size-16 align-middle mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember-check">
                                        <label class="form-check-label" for="remember-check">Beni Hatırla</label>
                                    </div>

                                    <div class="mb-3 cst-g-recaptcha-center">
                                        <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button id="btn-login" class="btn btn-primary waves-effect waves-light" type="submit">Giriş Yap</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-4 text-center">

                        <div>
                            <p>
                                Copyright © {{ now()->year }} <a target="_blank" href="https://localkod.com"><strong>Localkod</strong></a>. Tüm Hakları Saklıdır
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/js/toastify.min.js') }}"></script>


    @include('components.alerts.all-alert')

    <script type="text/javascript">
        $(document).ready(function() {
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 255,
                    }
                },
                messages: {
                    email: {
                        required: "E-Posta Adresi Zorunludur !",
                        email: "Geçerli Bir E-Posta Adresi Giriniz !",
                        maxlength: "E-Posta Adresi En Fazla 255 Karakter Olmalıdır !",
                    },
                    password: {
                        required: "Şifre Zorunludur !",
                        minlength: "Şifre En Az 6 Karakter Olmalıdır !",
                        maxlength: "Bir Hata Oluştu Şifrenizi Tekrar Kısaltarak Giriniz !",
                    }
                },

                focusInvalid: false,
                onkeyup: function(element) {
                    if ($(element).attr("name") === "email") {
                        return;
                    }
                    if ($(element).attr("name") === "password") {
                        return;
                    }
                    this.element(element);
                },
                errorPlacement: function(error, element) {
                    Toastify({
                        text: error.text(),
                        duration: 5000,
                        close: true,
                        stopOnFocus: true,
                        gravity: "top",
                        position: "right",
                        class: "top-right",
                        backgroundColor: "#DC3546",
                    }).showToast();
                },
                submitHandler: function(form) {
                    if (grecaptcha.getResponse() == "") {
                        Toastify({
                            text: "Lütfen Ben Robot Değilim Alanını İşaretleyiniz !",
                            duration: 5000,
                            close: true,
                            stopOnFocus: true,
                            gravity: "top",
                            position: "right",
                            class: "top-right",
                            backgroundColor: "#DC3546",
                        }).showToast();
                    } else {
                        form.submit();
                    }
                },
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Admin | Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/toastr.css">
    <style>
        body {
            background-image: url("{{asset('assets/admin')}}/svg/components/background1.jpg");
        } 

        .input-style{
            border-radius: 20px;
        }

        .box-shadow{
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;        }
    </style>
</head>

<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero">
        </div>

        <!-- Content -->
        <div class="container py-5 py-sm-7">
            

            <div class="row justify-content-center " >
                <div class="col-md-7 col-lg-5">
                    <!-- Card -->
                    <div class="card card-lg mb-5 box-shadow" style="background-color: #F2ECE4;">
                        <div class="card-body">
                            <a class="d-flex justify-content-center mb-5" href="javascript:">
                                <img class="z-index-2" onerror="" src="{{asset('storage/restaurant')}}/{{\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value}}" alt="Image Description" style="height: 100px;">
                            </a>
                            <!-- Form -->
                            <form class="js-validate" action="{{route('admin.auth.login')}}" method="post">
                                @csrf

                               <div class="text-center">
                                   <div class="mb-5">
                                        <h1 class="display-4"> {{\App\CentralLogics\translate('Admin')}}</h1>
                                       
                                    </div> 
                                 
                                </div> 
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label text-capitalize" for="signinSrEmail"> {{\App\CentralLogics\translate('email')}}</label>

                                    <input type="email" class="form-control form-control-lg input-style" name="email" id="signinSrEmail" tabindex="1" placeholder="email@address.com" aria-label="email@address.com" required data-msg="Veuillez saisir une adresse mail valide.">
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signupSrPassword" tabindex="0">
                                        <span class="d-flex justify-content-between align-items-center">
                                            {{\App\CentralLogics\translate('Mot de passe')}}
                                        </span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <input type="password" class="js-toggle-password form-control form-control-lg input-style" name="password" id="signupSrPassword" placeholder="8+ characters required" aria-label="8+ characters required" required data-msg="Votre mot de passe n'est pas valide. Veuillez réessayer." data-hs-toggle-password-options='{
                                                     "target": "#changePassTarget",
                                            "defaultClass": "tio-hidden-outlined",
                                            "showClass": "tio-visible-outlined",
                                            "classChangeTarget": "#changePassIcon"
                                            }'>
                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:">
                                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Checkbox -->
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="remember">
                                        <label class="custom-control-label text-muted" for="termsCheckbox">
                                            {{\App\CentralLogics\translate('se souvenir de moi ')}}
                                        </label>
                                    </div>
                                </div>
                                <!-- End Checkbox -->

                                <button type="submit" class="btn btn-lg btn-block input-style"  style="background-color: #b6120d; color:white;">{{\App\CentralLogics\translate('Connexion')}}</button>
                            </form>
                            <!-- End Form -->
                        </div>
                        @if(env('APP_MODE')=='demo')
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-10">
                                    <span>Email : admin@admin.com</span><br>
                                    <span>Password : 12345678</span>
                                </div>
                                <div class="col-2">
                                    <button class="btn" style="background-color: #b6120d" onclick="copy_cred()"><i class="tio-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>
        <!-- End Content -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->


    <!-- JS Implementing Plugins -->
    <script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>

    <!-- JS Front -->
    <script src="{{asset('assets/admin')}}/js/theme.min.js"></script>
    <script src="{{asset('assets/admin')}}/js/toastr.js"></script>
    {!! Toastr::message() !!}


    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>

    @if(env('APP_MODE')=='demo')
    <script>
        function copy_cred() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
    @endif

    <!-- IE Support -->
    <script>
        if (/MSIE\d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset(assets/admin/vendor/babel-polyfill/polyfill.min.js)"><\/script>');
    </script>
</body>

</html>
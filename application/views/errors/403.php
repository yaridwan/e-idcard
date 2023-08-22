<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Error 403 - <?= identitas("judul") ?></title>
    <link rel="icon" href="<?= identitas("favicon") ?>" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ebazar.style.min.css">
</head>
<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">
            
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <!-- Image block -->
                                <div class="">
                                <img src="<?= identitas("logo_login") ?>" alt="login-img">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4">
                                    <div class="col-12 text-center mb-4">
                                        <img src="<?= base_url() ?>assets/images/not_found.svg" class="w240 mb-4" alt="" />
                                        <h5>OOP! AKSES DILARANG</h5>
                                        <span class="">Maaf, Anda tidak diperkenankan mengakses halaman ini. Hubungi segera Administrator untuk menyelesaikan kendala ini.</span>
                                    </div>
                                    <div class="col-12 text-center">
                                        <a href="<?= base_url("dash") ?>" title="" class="btn btn-lg btn-block btn-light lift text-uppercase">Kembali ke Dashboard</a>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    
                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="<?= base_url() ?>assets/bundles/libscripts.bundle.js"></script>
</body>
</html>
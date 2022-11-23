<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>ALABS - Aplikasi Laporan Absensi</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= URLROOT; ?>/images/logo/humas.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= URLROOT; ?>/images/logo/humas.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URLROOT; ?>/images/logo/humas.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/style.css" />
</head>

<body class="login-page">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="align-items-center">
                <div class="col-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <img src="<?= URLROOT; ?>/images/logo/humas.png" alt="Humas Logo" style="object-fit:cover;height:100%;" />
                            </div>
                        </div>
                        <div class="login-title">
                            <h1 class="text-center" style="color:#404258;">ALABS</h1>
                            <h6 class="text-center text-secondary">Aplikasi Laporan Absensi</h6>
                        </div>
                        <?php flash(); ?>
                        <form action="" method="post">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="NIP" name="nip" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********" name="password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome modal end -->
    <!-- js -->
    <script src="<?= URLROOT; ?>/scripts/core.js"></script>
    <script src="<?= URLROOT; ?>/scripts/script.min.js"></script>
    <script src="<?= URLROOT; ?>/scripts/process.js"></script>
    <script src="<?= URLROOT; ?>/scripts/layout-settings.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
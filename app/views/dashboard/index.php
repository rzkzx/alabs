<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="main-container">
  <div class="xs-pd-20-10 pd-ltr-20">
    <div class="title pb-20">
      <h2 class="h3 mb-0">Dashboard</h2>
    </div>

    <div class="row pb-10">
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark"><?= count($data['users']) ?></div>
              <div class="font-14 text-secondary weight-500">
                Jumlah User
              </div>
            </div>
            <div class="widget-icon">
              <div class="icon" data-color="#00eccf">
                <i class="icon-copy bi bi-people"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark"><?= count($data['admin']) ?></div>
              <div class="font-14 text-secondary weight-500">
                Jumlah Admin
              </div>
            </div>
            <div class="widget-icon">
              <div class="icon" data-color="#ff5b5b">
                <i class="icon-copy bi bi-people-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark"><a href="https://banjarbarukota.go.id/" target="_blank">HUMAS WEB</a></div>
              <div class="font-14 text-secondary weight-500">
                Website
              </div>
            </div>
            <div class="widget-icon">
              <div class="icon">
                <i class="icon-copy bi bi-wordpress"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark"><a href="https://www.instagram.com/polres_banjarbaru/" target="_blank">@humasBJB</a></div>
              <div class="font-14 text-secondary weight-500">Instagram</div>
            </div>
            <div class="widget-icon">
              <div class="icon" data-color="#09cc06">
                <i class="icon-copy bi bi-instagram"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="title pb-20 pt-20">
      <h2 class="h3 mb-0">Informasi</h2>
    </div>

    <div class="row">
      <div class="col-md-4 mb-20">
        <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
          <div class="img pb-30">
            <img src="<?= URLROOT; ?>/images/medicine-bro.svg" alt="" />
          </div>
          <div class="content">
            <h3 class="h4">Aplikasi</h3>
            <p class="max-width-200">
              We provide superior health care in a compassionate maner
            </p>
          </div>
        </a>
      </div>
      <div class="col-md-4 mb-20">
        <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
          <div class="img pb-30">
            <img src="<?= URLROOT; ?>/images/remedy-amico.svg" alt="" />
          </div>
          <div class="content">
            <h3 class="h4">Absensi</h3>
            <p class="max-width-200">
              Look for prescription and over-the-counter drug information.
            </p>
          </div>
        </a>
      </div>
      <div class="col-md-4 mb-20">
        <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
          <div class="img pb-30">
            <img src="<?= URLROOT; ?>/images/paper-map-cuate.svg" alt="" />
          </div>
          <div class="content">
            <h3 class="h4">Lainnya</h3>
            <p class="max-width-200">
              Convenient locations when and where you need them.
            </p>
          </div>
        </a>
      </div>
    </div>



    <?php require APPROOT . '/views/layouts/footer.php'; ?>
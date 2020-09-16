<body style="background: #eb535c; zoom:90%;">
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                     <img src="<?= base_url('assets/'); ?>img/login2.png" width="80%">
                  </div>

                  <?= $this->session->flashdata('pesan');?>
                  
                  <form class="user" method="post" action="<?= base_url('auth/proses_login'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-user btn-block">
                      Masuk
                    </button><br/>
                    <div class="text-center" style="font-size: 9pt;">
                      Apabila lupa atau tidak mengetahui Username & Password, hubungi <b>Admin</b>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
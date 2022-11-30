<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-8 col-sm-4 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-5">
              <div class="row">
                <div class="col-12">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Selamat Datang di Website Management</p>
                    <h5 class="font-weight-bolder">
                      Tugas Akhir
                    </h5>
                    <p class="mb-0 text-sm">
                      Politeknik Elektronika Negeri Surabaya
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Dosen Pembimbing</p>
                    <h5 class="font-weight-bolder">
                      <?php
                        if($mahasiswa->pembimbing_id == NULL){
                          echo '-';
                        }else{
                          echo $mahasiswa->proposal->nama_pembimbing;
                        }
                      ?>
                    </h5>
                    <p class="mb-0">Status Proposal</p>
                    <span class="text-success text-sm font-weight-bolder">
                      <?php
                        if($mahasiswa->pembimbing_id == NULL){
                          echo '-';
                        }else{
                          echo $mahasiswa->proposal->status;
                        }
                      ?>
                    </span>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ekuivalensi Nilai</p>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">A</span>
                      81 - 100
                    </p>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">AB</span>
                      71 - 80
                    </p>
                    <p class="mb-0">
                      <span class="text-warning text-sm font-weight-bolder">B</span>
                      66 - 70
                    </p>
                    <p class="mb-0">
                      <span class="text-warning text-sm font-weight-bolder">BC</span>
                      61 - 65
                    </p>
                    <p class="mb-0">
                      <span class="text-warning text-sm font-weight-bolder">C</span>
                      56 - 60
                    </p>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder">D</span>
                      41 - 65
                    </p>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder">E</span>
                      0 - 40
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>

      
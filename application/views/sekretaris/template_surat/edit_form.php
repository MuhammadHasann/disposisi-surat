<main>
  <div class="container-fluid">
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="<?php echo site_url('templatesurat') ?>">Surat Ajuan</a></li>
      <li class="breadcrumb-item active"><?php echo $title ?></li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo site_url('templatesurat/edit') ?>" method="post" enctype="multipart/form-data" >
          <div class="mb-3">
            <label >NAMA LENGKAP <code>*</code></label>
            <input class="form-control" type="hidden" name="id" value="<?=$surat->id;?>" required />
            <input class="form-control" type="text" name="nama" value="<?=$surat->nama;?>" placeholder="NO SURAT MASUK" required />
          </div>
          <div class="mb-3">
            <label >PERIHAL SURAT <code>*</code></label>
            <input class="form-control" type="text" name="perihal" value="<?=$surat->perihal;?>" placeholder="PERIHAL SURAT" required />
          </div>
          <div class="mb-3">
            <label >TUJUAN SURAT <code>*</code></label>
            <input class="form-control" type="text" name="tujuan_surat" value="<?=$surat->tujuan_surat;?>" placeholder="TUJUAN SURAT" required />
          </div>
          <div class="row mb-3">
            <div class="col">
              <label >TANGGAL KIRIM SURAT <code>*</code></label>
              <input class="form-control" type="date" name="tgl_kirim" value="<?=$surat->tgl_kirim;?>" placeholder="TANGGAL KIRIM SURAT" required />
            </div>
            <div class="col"></div>
          </div>
          <div class="mb-3">
            <label for="username">KETERANGAN <code>*</code></label>
            <textarea class="form-control" placeholder="KETERANGAN" name="keterangan" id="floatingTextarea2" style="height: 100px"><?=$surat->keterangan;?> </textarea>
          </div>
          <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Save Data</button>
        </form>
      </div>
    </div>
    <div style="height: 100vh"></div>
  </div>
</main>
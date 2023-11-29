<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $colors = ['#fff', '#005ff7', '#00f7ce', '#e700f7', '#f7d200', '#00f788']; ?>


<div class="card mt-2 bg-light">
    <div class="card-body shadow shadow-sm">
        <?php if ($permainan['active'] == 0) : ?>

            <?php if ($kode == 1) : ?>
                <div class="countdown">

                </div>
            <?php endif; ?>

            <?php if ($permainan['creator'] !== session('username') && $kode == 0) : ?>
                <div class="row mb-3 g-2">
                    <div class="col-md-6">
                        <input type="text" class="form-control value_nama_player" placeholder="Nama maksimal 8 karakter dan tanpa spasi!.">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control value_kode" placeholder="Masukkan kode">
                    </div>
                    <div class="d-grid mt-3">
                        <button class="btn btn-sm btn-outline-secondary add_player" data-jwt="<?= url(4); ?>" type="button">Save</button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($permainan['creator'] == session('username')) : ?>
                <div class="row">
                    <div class="col-2"><img src="<?= set_qr_code(base_url('permainan') . '/' . url(4), 'logo', 'Scan to join'); ?>"></div>
                    <div class="col">
                        <div class="input-group input-group-sm mb-2">
                            <input type="text" class="form-control value_copy_link" value="<?= base_url('permainan'); ?>/<?= url(4); ?>" readonly>
                            <button class="btn btn-outline-secondary copy_link" type="button"><i class="fa-solid fa-copy"></i></button>
                        </div>
                        <?php if ($permainan['active'] == 0) : ?>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" value="<?= $permainan['kode']; ?>" readonly>
                                <button class="btn btn-outline-secondary" type="button">Kode</i></button>
                            </div>
                            <div class="d-grid mt-3">
                                <button class="btn btn-sm btn-outline-secondary mulai_saja" data-jwt="<?= url(4); ?>" type="button">Mulai saja</button>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>

            <?php endif; ?>

        <?php else : ?>

            <div class="countdown_jawab">

            </div>
        <?php endif; ?>
        <h6><?= $judul; ?></h6>


        <div class="row">
            <div class="col-md-8">
                <div class="row" style="padding: 0px 10px 0px 10px;">
                    <?php for ($i = 0; $i < count($data); $i++) : ?>
                        <div class="col-2" style="background-color:brown;height:600px;border:3px solid white">
                            <div style="text-align: center;color:white;"><?= $data[$i]['nama']; ?></div>
                            <div class="<?= $data[$i]['permainan_id']; ?>_<?= $data[$i]['nama']; ?>">
                                <?php for ($x = 0; $x < $data[$i]['nilai']; $x++) : ?>
                                    <br>
                                    <br>
                                    <br>
                                <?php endfor; ?>
                            </div>
                            <div style="text-align: center;font-size:xx-large;color:<?= $colors[$i]; ?>"><i class="fa-solid fa-car"></i></div>
                        </div>
                    <?php endfor; ?>
                    <?php if (count($data) < 6) : ?>
                        <?php for ($i = count($data); $i < 6; $i++) : ?>
                            <div class="col-2" style="background-color:brown;height:600px;border:3px solid white">

                                <div style="text-align: center;color:white;">?</div>
                                <div style="text-align: center;font-size:xx-large;color:<?= $colors[$i]; ?>"><i class="fa-solid fa-car"></i></div>
                            </div>
                        <?PHP endfor; ?>
                    <?php endif; ?>
                </div>
                <div style="height:60px;background-image: linear-gradient(90deg,#000 0%,#000 20%,#fff 20%,#fff 40%,#000 40%,#000 60%,#fff 60%,#fff 80%,#000 80%,#000 100%);">
                    <div style="text-align:center;color:red;font-size:xx-large;font-weight:bold;">FINISH</div>
                </div>
            </div>
            <div class="col-md-4 body_soal">

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="card mt-2 bg-light">
    <div class="card-body shadow shadow-sm">

        <a type="button" href="<?= base_url('buat_permainan'); ?>" class="btn btn-primary btn-sm">Buat Permainan</a>
    </div>

</div>

<?= $this->endSection() ?>
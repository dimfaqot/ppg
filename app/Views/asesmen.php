<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<?php $colors = ['#fff', '#005ff7', '#00f7ce', '#e700f7', '#f7d200', '#00f788']; ?>


<div class="card mt-2 bg-light">
    <div class="card-body shadow shadow-sm mb-2">
        <div class="countdown">

        </div>
    </div>

    <div class="container mb-5">
        <h1 style="text-align: justify;"><?= $data['soal']; ?></h1>
        <div class="bg_grey border_radius p-2 mt-3" style="font-size:x-large;color:black;font-weight:bold">a. <?= $data['a']; ?></div>
        <div class="bg_grey border_radius p-2 mt-3" style="font-size:x-large;color:black;font-weight:bold">b. <?= $data['b']; ?></div>
        <div class="bg_grey border_radius p-2 mt-3" style="font-size:x-large;color:black;font-weight:bold">c. <?= $data['c']; ?></div>
        <div class="bg_grey border_radius p-2 mt-3" style="font-size:x-large;color:black;font-weight:bold">d. <?= $data['d']; ?></div>

    </div>
</div>

<?= $this->endSection() ?>
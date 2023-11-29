<?php

namespace App\Controllers;

class Permainan extends BaseController
{
    public function index($jwt): string
    {
        $data = decode_jwt($jwt);
        $dbp = db('permainan');
        $permainan = $dbp->where('id', $data['id'])->get()->getRowArray();
        if (!$permainan) {
            gagal(base_url(), 'Permainan tidak ada!.');
        }

        $db = db('player');
        $p = $db->where('permainan_id', $data['id'])->where('nama', session('username'))->get()->getRowArray();
        $q = $db->where('permainan_id', $data['id'])->get()->getResultArray();

        // foreach ($q as $i) {
        //     if ($i['nilai'] == 10) {
        //         gagal(base_url() . $jwt, 'Permainan selesai!.');
        //     }
        // }

        $kode = 1;
        if (!$p) {
            $kode = 0;
        }


        return view('permainan', ['judul' => 'Permainan ' . $data['jenis'], 'data' => $q, 'permainan' => $permainan, 'kode' => $kode]);
    }

    public function add_player()
    {
        $username = strtolower(clear($this->request->getVar('username')));
        $kode = clear($this->request->getVar('kode'));
        $jwt = $this->request->getVar('jwt');

        $data = decode_jwt($jwt);

        $dbp = db('permainan');
        $permainan = $dbp->where('id', $data['id'])->get()->getRowArray();
        if (!$permainan) {
            gagal_js('Permainan tidak ada!.');
        }

        if ($permainan['kode'] !== $kode) {
            gagal_js('Kode salah!');
        }

        $db = db('player');
        $exist = $db->where('nama', $username)->get()->getRowArray();
        if ($exist) {
            gagal_js('Nama sudah ada!.');
        }

        $p = $db->where('permainan_id', $data['id'])->where('nama', session('username'))->get()->getRowArray();
        $q = $db->where('permainan_id', $data['id'])->get()->getResultArray();


        if (!$p) {
            if ($permainan['active'] == 1) {
                gagal_js('Permainan sudah dimulai!.');
            }
            if (count($q) == 6) {
                gagal_js('Player sudah penuh!.');
            }

            if (count($q) < 6) {


                $val = [
                    'permainan_id' => $data['id'],
                    'nama' => $username
                ];

                if ($db->insert($val)) {

                    sukses_js('Ok', $jwt, $val['nama']);
                } else {
                    gagal_js('Kamu gagal join!.');
                }
            }
        }
    }
    public function add_session($username, $jwt)
    {
        $val = [
            'username' => $username,
            'role' => 'Member'
        ];

        session()->set($val);

        sukses(base_url('permainan/') . $jwt, 'Ok');
    }
    public function mulai_saja()
    {
        $jwt = $this->request->getVar('jwt');
        $data = decode_jwt($jwt);

        $dbp = db('permainan');
        $permainan = $dbp->where('id', $data['id'])->get()->getRowArray();

        if (!$permainan) {
            gagal_js('Permainan tidak ada!.');
        }

        if (session('username') !== $permainan['creator']) {
            gagal_js('You are not allowed!.');
        }

        $permainan['active'] = 1;
        $dbp->where('id', $data['id']);
        if ($dbp->update($permainan)) {
            sukses_js('Ok');
        } else {
            gagal_js('Wrong system!.');
        }
    }

    public function get_soal()
    {
        $kategori = $this->request->getVar('kategori');
        $index = $this->request->getVar('index');
        $data = decode_jwt($this->request->getVar('jwt'));

        $selesai = 10;

        $soal = get_soal($kategori, $index);

        $db = db('player');
        $q = $db->where('permainan_id', $data['id'])->get()->getResultArray();

        foreach ($q as $i) {
            if ($i['nilai'] == $selesai) {
                sukses_js('Selesai');
            }
        }
        sukses_js('Ok', $soal);
    }
    public function jawaban()
    {
        $val = $this->request->getVar('val');
        $id = $this->request->getVar('id');
        $data = decode_jwt($this->request->getVar('jwt'));

        $dbs = db('soal');
        $soal = $dbs->where('id', $id)->get()->getRowArray();

        $db = db('player');
        $q = $db->where('permainan_id', $data['id'])->where('nama', session('username'))->get()->getRowArray();
        $arr = $db->where('permainan_id', $data['id'])->orderBy('id', 'ASC')->get()->getResultArray();

        if ($val == $soal['jawaban']) {
            $q['nilai'] = $q['nilai'] + 1;
            $db->where('id', $q['id']);
            $db->update($q);
        }
        sukses_js('Ok', $arr);
    }
}

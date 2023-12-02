<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index(): string
    {
        return view('landing', ['judul' => 'PPG Daljab 2023']);
    }
    public function login(): string
    {

        return view('login', ['judul' => 'Login']);
    }
    public function asesmen()
    {

        return view('asesmen', ['judul' => 'Asesmen']);
    }
    public function get_soal_asesmen()
    {
        $index = $this->request->getVar('index');

        $db = db('soal');
        $q = $db->where('kategori', 'Asesmen')->orderBy('id', 'ASC')->get()->getResultArray();

        $data = [];

        foreach ($q as $k => $i) {
            if ($k == $index) {
                $data = $i;
            }
        }

        sukses_js('Ok', $data);
    }
    public function auth()
    {
        $username = clear($this->request->getVar('username'));
        $password = clear($this->request->getVar('password'));

        $db = db('user');

        $q = $db->where('username', $username)->get()->getRowArray();

        if (!$q) {
            gagal(base_url('login'), 'Username not found!.');
        }

        if (!password_verify($password, $q['password'])) {
            gagal(base_url('login'), 'Wrong password!.');
        }

        $data = [
            'id' => $q['id'],
            'username' => $q['username'],
            'nama' => $q['nama'],
            'role' => $q['role'],
            'kelas' => $q['kelas']
        ];


        session()->set($data);
        sukses(base_url('home'), 'Login sukses.');
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('role');
        session()->remove('nama');
        session()->remove('kelas');

        sukses(base_url('login'), 'Logout sukses!.');
    }
}

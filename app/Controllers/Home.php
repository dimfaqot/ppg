<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Please Login!.');
        }
    }
    public function index(): string
    {

        return view('home', ['judul' => 'Home']);
    }

    public function buat_permainan()
    {
        $db = db('permainan');
        $id = '';
        for ($i = 0; $i < 50; $i++) {
            $random_string = random_string();
            $q = $db->where('id', $random_string)->get()->getRowArray();
            if (!$q) {
                $id = $random_string;
                break;
            }
        }
        $random_num = random_number();
        $data = [
            'id' => $id,
            'jenis' => 'Lari',
            'kode' => $random_num,
            'active' => 0,
            'creator' => session('username')
        ];

        if ($db->insert($data)) {
            $db = db('player');
            $val = [
                'permainan_id' => $id,
                'nama' => session('username'),
                'nilai' => 0
            ];

            if ($db->insert($val)) {
                $url = base_url('permainan') . '/' . encode_jwt($data);

                sukses($url, 'Sukses');
            }
        } else {
            gagal(base_url('home'), 'Creating game failed!.');
        }
    }
}

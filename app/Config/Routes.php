<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



//  landing
$routes->get('/', 'Landing::index');
$routes->get('/asesmen', 'Landing::asesmen');
$routes->post('/get_soal_asesmen', 'Landing::get_soal_asesmen');
$routes->post('/suara_partai', 'Landing::suara_partai');
$routes->get('/login', 'Landing::login');
$routes->get('/logout', 'Landing::logout');
$routes->post('/auth', 'Landing::auth');
$routes->post('/logout', 'Landing::logout');

$routes->get('/home', 'Home::index');
$routes->get('/buat_permainan', 'Home::buat_permainan');
$routes->get('/permainan/add_session/(:any)/(:any)', 'Permainan::add_session/$1/$2');
$routes->post('/permainan/mulai_saja', 'Permainan::mulai_saja');
$routes->get('/permainan/(:any)', 'Permainan::index/$1');
$routes->post('/permainan/add_player', 'Permainan::add_player');
$routes->post('/permainan/get_soal', 'Permainan::get_soal');
$routes->post('/permainan/jawaban', 'Permainan::jawaban');

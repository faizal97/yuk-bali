<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Controller Halaman Awal
$route['default_controller'] = 'home';
// Halaman Awal
$route['welcome'] = 'home';

// Kursus Saya
$route['kursus'] = "course";
$route['kursus/(:any)'] = "course/belajar/$1";
$route['kursus/(:any)/(:any)'] = "course/belajar_detail/$1/$2";

// Detail Kursus
$route['(:any)/(:any)'] = "course/view_detail_kursus/$1/$2";
$route['(:any)/(:any)/daftar_kursus'] = "course/daftar_kursus/$1/$2";

// Halaman Pelajar Setelah Login
$route['home'] = 'dashbord';

// Register Pelajar
$route['daftar'] = 'register';
$route['daftar_akun'] = 'register/action';

// Login & Logout Pelajar
$route['masuk'] = 'login';
$route['masuk_akun'] = 'login/action';
$route['keluar'] = 'logout';

// Profil Pelajar
$route['profil'] = "dashbord/profile";
$route['profil/(:any)'] = "dashbord/profile/$1";

// Kursus ku(My Courses)
$route['aktivasi_pengajar'] = "dashbord/menjadi_pengajar";
$route['kursusku'] = "mycourse";
$route['kursusku/tambah_kursus'] = "mycourse/proses_tambah_kursus";
// Kursuku Materi
$route['kursusku/kelola/(:any)/tambah_materi'] = "materi/proses_tambah_materi/$1";
$route['kursusku/kelola/(:any)/tambah_soal'] = "soal/proses_tambah_soal/$1";
$route['kursusku/kelola/(:any)/hapus_materi'] = "materi/proses_hapus_semua/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)/update_artikel'] = "materi/proses_edit_artikel/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)/update_nama_materi'] = "materi/proses_edit_nama_materi/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)/update_urut_materi'] = "materi/proses_edit_urut_materi/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)/update_url_video'] = "materi/proses_edit_url_video/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)/hapus_materi'] = "materi/proses_hapus_materi/$1/$2";
$route['kursusku/kelola/(:any)/materi/(:any)'] = "materi/view_kelola_materi/$1/$2";

// Kursusku Soal
$route['kursusku/kelola/(:any)/soal/(:any)/hapus/(:any)'] = "soal/proses_hapus_detail_soal/$1/$2/$3";
$route['kursusku/kelola/(:any)/soal/(:any)/tambah_soal'] = "soal/proses_tambah_detail_soal/$1/$2";
$route['kursusku/kelola/(:any)/soal/(:any)/(:any)/update_soal'] = "soal/proses_edit_detail_soal/$1/$2/$3";
$route['kursusku/kelola/(:any)/soal/(:any)/(:any)'] = "soal/view_detail_soal/$1/$2/$3";
$route['kursusku/kelola/(:any)/soal/(:any)'] = "soal/view_kelola_soal/$1/$2";

$route['kursusku/kelola/(:any)'] = "mycourse/tampil_data_kursus/$1";
$route['kursusku/kelola/edit/(:any)'] = "mycourse/manage_course/$1";
$route['kursusku/hapus/(:any)'] ="mycourse/hapus_kursus/$1";
$route['kursusku/hapus_semua'] = "mycourse/hapus_semua";

// Halaman 404
$route['404_override'] = '';


$route['translate_uri_dashes'] = FALSE;

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

// Kategori
$route['kategori/(:any)'] = "kategori/kategori_visitor/$1";
$route['search'] = "search/search_visitor";

// Kursus Saya
$route['kursus'] = "course";
$route['kursus/search'] = "search/search_user";
$route['kursus/nilai/(:any)'] = "course/tampil_nilai/$1";
$route['kursus/kategori/(:any)'] = "kategori/kategori_user/$1";
$route['kursus/(:any)'] = "course/belajar/$1";
$route['kursus/(:any)/(:any)'] = "course/belajar_detail/$1/$2";
$route['kursus/(:any)/(:any)/soal'] = "course/soal/$1/$2";
$route['kursus/(:any)/(:any)/cek_soal'] = "course/cek_soal/$1/$2";

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

// Login Admin
$route['admin'] = 'login_admin';
$route['admin/masuk']= 'login_admin';
$route['admin/proses_masuk'] = 'login_admin/proses';
$route['admin/keluar'] = 'login_admin/logout';

// beranda Admin
$route['admin/beranda']='admin';

// Data admin
$route['admin/data_admin'] = "data_admin";
$route['admin/data_admin/tambah_admin'] = "data_admin/tambah_admin";
$route['admin/data_admin/tambah_admin/proses'] = 'data_admin/proses_tambah_admin';
$route['admin/data_admin/ubah_admin/proses/(:any)'] = 'data_admin/proses_edit_admin/$1';
$route['admin/data_admin/ubah_admin/(:any)'] = 'data_admin/edit_admin/$1';
$route['admin/data_admin/hapus_admin/(:any)'] = 'data_admin/hapus_admin/$1';
$route['admin/data_admin/hapus/semua'] = "data_admin/hapus_semua";
$route['admin/data_admin/cari_data'] = 'data_admin/cari_data';

// Data kategori
$route['admin/data_kategori'] = "data_kategori";
$route['admin/data_kategori/tambah_kategori'] = "data_kategori/tambah_kategori";
$route['admin/data_kategori/tambah_kategori/proses'] = 'data_kategori/proses_tambah_kategori';
$route['admin/data_kategori/ubah_kategori/(:any)'] = 'data_kategori/edit_kategori/$1';
$route['admin/data_kategori/ubah_kategori/proses/(:any)'] = 'data_kategori/proses_edit_kategori/$1';
$route['admin/data_kategori/hapus_kategori/(:any)'] = 'data_kategori/hapus_kategori/$1';
$route['admin/data_kategori/hapus/semua'] = "data_kategori/hapus_semua";
$route['admin/data_kategori/cari_data'] = 'data_kategori/cari_data';

// Data pelajar
$route['admin/data_pelajar'] = "data_pelajar";
$route['admin/data_pelajar/ubah_pelajar/(:any)'] = 'data_pelajar/edit_pelajar/$1';
$route['admin/data_pelajar/ubah_pelajar/proses/(:any)'] = 'data_pelajar/proses_edit_pelajar/$1';
$route['admin/data_pelajar/hapus_pelajar/(:any)'] = 'data_pelajar/hapus_pelajar/$1';
$route['admin/data_pelajar/hapus/semua'] = "data_pelajar/hapus_semua";
$route['admin/data_pelajar/cari_data'] = 'data_pelajar/cari_data';


//data pengajar
$route['admin/data_pengajar'] = "data_pengajar";
$route['admin/data_pengajar/ubah_pengajar/(:any)'] = 'data_pengajar/edit_pengajar/$1';
$route['admin/data_pengajar/ubah_pengajar/proses/(:any)'] = 'data_pengajar/proses_edit_pengajar/$1';
$route['admin/data_pengajar/hapus_pengajar/(:any)'] = 'data_pengajar/hapus_pengajar/$1';
$route['admin/data_pengajar/hapus/semua'] = "data_pengajar/hapus_semua";
$route['admin/data_pengajar/cari_data'] = 'data_pengajar/cari_data';

//data kursus
$route['admin/data_kursus'] = "data_kursus";
$route['admin/data_kursus/ubah_kursus/(:any)'] = 'data_kursus/edit_kursus/$1';
$route['admin/data_kursus/ubah_kursus/proses/(:any)'] = 'data_kursus/proses_edit_kursus/$1';
$route['admin/data_kursus/lihat_kursus/(:any)/(:any)'] = 'data_kursus/lihat_materi/$1/$2';
$route['admin/data_kursus/lihat_kursus/(:any)'] = 'data_kursus/lihat_kursus/$1';
$route['admin/data_kursus/hapus_kursus/(:any)'] = 'data_kursus/hapus_kursus/$1';
$route['admin/data_kursus/hapus/semua'] = "data_kursus/hapus_semua";
$route['admin/data_kursus/cari_data'] = 'data_pengajar/cari_data';


// Detail Kursus
$route['(:any)/(:any)'] = "course/view_detail_kursus/$1/$2";
$route['(:any)/(:any)/daftar_kursus'] = "course/daftar_kursus/$1/$2";

// Halaman 404
$route['404_override'] = 'errorbelajar';


$route['translate_uri_dashes'] = FALSE;

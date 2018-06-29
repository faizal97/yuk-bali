let arr_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
let arr_hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu'];
let perdetik = setInterval(tanggal,1000);

function tanggal() {
let tgl = new Date();
let tgl_skrg = arr_hari[tgl.getDay()] + ", " + tgl.getDate() + " " + arr_bulan[tgl.getMonth()] + " " + tgl.getFullYear() + " " + ("0" + tgl.getHours()).slice(-2) + ":" + ("0" + tgl.getMinutes()).slice(-2) + ":" + ("0" + tgl.getSeconds()).slice(-2);
let tampil = document.getElementById('tgl-skrg').innerHTML = tgl_skrg;
}

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */

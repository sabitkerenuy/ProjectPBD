<?php
//melakukan koneksi ke database

$host = 'localhost';
$db   = 'projectPBD';
$user = 'root';
$pass = '0000';

$dbconn = mysqli_connect($host, $user, $pass, $db);
//parameter HARUS sesuai

if(!$dbconn){
    die("Koneksi ke database gagal: " . mysqli_connect_error());
    //die = fungsi bawaan php, menghentikan eksekusi skrip, kata alias exit()
    // mysqli_connect_error fungsi bawaan php untuk mengambil deskripsi kesalahan yang terjadi pada database
}

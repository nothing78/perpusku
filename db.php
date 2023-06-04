<?php

$db = new mysqli("localhost", "root", "", "lms_db");
if ($db->connect_error) {
    die("Koneksi Gagal");
}

<?php
// koneksi database
include 'db.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id'];


// menghapus data dari database
mysqli_query($db, "DELETE FROM lms_book_issue where BOOK_ISSUE_NO='$id'");

// mengalihkan halaman kembali ke index.php
header("location:data_peminjam.php");

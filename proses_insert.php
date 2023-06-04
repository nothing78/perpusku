<?php
include 'db.php';

$member_id = $_POST['id_member'];
$book_id = $_POST['id_buku'];
$tgl_peminjaman = $_POST['tgl_peminjaman'];
$tgl_pengembalian  = $_POST['tgl_pengembalian'];

$query = "INSERT INTO lms_book_issue (BOOK_ISSUE_NO,MEMBER_ID,BOOK_CODE,DATE_ISSUE,DATE_RETURN) VALUES ('','$member_id','$book_id','$tgl_peminjaman','$tgl_pengembalian')";

// var_dump($query);
// die;

if (mysqli_query($db, $query)) {
    echo "Sukses";
} else {
    echo "Gagal";
}

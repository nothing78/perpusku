<?php
include('db.php');

$id = $_POST['id_peminjaman'];
$member_id = $_POST['id_member'];
$book_id = $_POST['id_buku'];
$tgl_peminjaman = $_POST['tgl_peminjaman'];
$tgl_pengembalian  = $_POST['tgl_pengembalian'];

$query = "UPDATE lms_book_issue SET MEMBER_ID='$member_id', BOOK_CODE='$book_id', DATE_ISSUE='$tgl_peminjaman', DATE_RETURN='$tgl_pengembalian' WHERE BOOK_ISSUE_NO='$id'";

if (mysqli_query($db, $query)) {
    echo "Sukses";
} else {
    echo "Gagal";
}

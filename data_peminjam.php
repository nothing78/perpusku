<?php

include('db.php');

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}

$get_user = mysqli_query($db, "SELECT * FROM lms_admin WHERE email='$_SESSION[email]'");
$user = mysqli_fetch_array($get_user);

$query = "SELECT * FROM lms_book_issue JOIN lms_members ON lms_book_issue.MEMBER_ID = lms_members.MEMBER_ID JOIN lms_book_details ON lms_book_issue.BOOK_CODE = lms_book_details.BOOK_CODE ORDER BY BOOK_ISSUE_NO ASC";
$dewan1 = $db->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman | Perpusku</title>

    <link rel="stylesheet" href="mazer/dist/assets/css/main/app.css">
    <link rel="stylesheet" href="mazer/dist/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="mazer/dist/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="mazer/dist/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="mazer/dist/assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="mazer/dist/assets/css/pages/datatables.css">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="dashboard.php">Perpusku</a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="form_peminjaman.php" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Buat Peminjaman Buku</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="data_peminjam.php" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Lihat Peminjaman Buku</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Peminjaman</h3>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><?= $user['nama'] ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card mt-4">
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID Peminjaman</th>
                                        <th>Nama Member</th>
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $res1->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $row['BOOK_ISSUE_NO'] ?></td>
                                            <td><?= $row['MEMBER_NAME'] ?></td>
                                            <td><?= $row['BOOK_CODE'] ?></td>
                                            <td><?= $row['BOOK_TITLE'] ?></td>
                                            <td><?= $row['DATE_ISSUE'] ?></td>
                                            <td><?= $row['DATE_RETURN'] ?></td>
                                            <td>
                                                <span class="badge bg-warning"><a href="edit_peminjaman.php?id=<?= $row['BOOK_ISSUE_NO'] ?>" class="text-light"><i class="fas fa-pen"></i> Edit</a></span><span class="badge bg-danger"><a href="hapus.php?id=<?= $row['BOOK_ISSUE_NO'] ?>" class="text-light" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a></span>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
                <!-- Basic Tables end -->
            </div>

        </div>
    </div>
    <script src="mazer/dist/assets/js/app.js"></script>

    <script src="mazer/dist/assets/js/extensions/datatables.js"></script>

</body>

</html>
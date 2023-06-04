<?php

include('db.php');
?>
<?php
$page = (isset($_POST['page'])) ? $_POST['page'] : 1;
$limit = 20;
$limit_start = ($page - 1) * $limit;
$no = $limit_start + 1;

$query = "SELECT * FROM lms_book_details ORDER BY BOOK_TITLE ASC LIMIT $limit_start, $limit";
$dewan1 = $db->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
?>
<div class="row">
    <?php
    while ($row = $res1->fetch_assoc()) { ?>
        <div class=" col-lg-4 col-md-5">
            <!-- <div class="card">
                <div class="card-block">
                    <h3 class="card-title"><?= $row['BOOK_TITLE']; ?></h3>
                    <h6 class="card-subtitle"><?= $row['AUTHOR'] ?> | <?= $row['PUBLISH_DATE'] ?></h6>
                    <div id="description"><?= "Rp " . number_format($row['PRICE'], 0, ',', '.'); ?></div>
                </div>
                <div>
                    <hr class="m-t-0 m-b-0">
                </div>
                <div class="card-block text-center ">
                    <ul class="list-inline m-b-0">
                        <li>
                            <h6 class="text-muted text-info"><i class="fa fa-star font-12 m-r-10 text-warning"></i><?= $row['CATEGORY'] ?></h6>
                        </li>
                        <li>
                            <h6 class="text-muted  text-primary"><i class="fa fa-clock-o font-12 m-r-10"></i><?= $row['DATE_ARRIVAL'] ?></h6>
                        </li>
                        <li>
                            <h6 class="text-muted  text-success"><i class="fa fa-pencil font-10 m-r-10"></i><?= $row['PUBLICATION'] ?></h6>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['BOOK_TITLE']; ?></h5>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="bi bi-person"></i> <?= $row['AUTHOR'] ?></li>
                    <li class="list-group-item"><i class="bi bi-book"></i> <?= $row['CATEGORY'] ?></li>
                    <li class="list-group-item"><i class="bi bi-dollar"></i> <?= "Rp " . number_format($row['PRICE'], 0, ',', '.'); ?></li>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>

<?php
$query_jumlah = "SELECT count(*) AS jumlah FROM lms_book_details";
$dewan1 = $db->prepare($query_jumlah);
$dewan1->execute();
$res1 = $dewan1->get_result();
$row = $res1->fetch_assoc();
$total_records = $row['jumlah'];
?>
<br>
<nav class="mb-5">
    <ul class="pagination justify-content-center">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;


        if ($page == 1) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($page > 1) ? $page - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($page == $i) ? ' active' : '';
            echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        if ($page == $jumlah_page) {
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        }
        ?>
    </ul>
</nav>
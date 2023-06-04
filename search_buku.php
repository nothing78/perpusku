<?php
include 'db.php';

//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query  = $db->query("SELECT * FROM lms_book_details WHERE BOOK_TITLE LIKE '%$searchTerm%' LIMIT 10");
$result = $query->fetch_all(MYSQLI_ASSOC);

// Format bentuk data untuk autocomplete.
foreach ($result as $data) {
    $arr_result[] = array(
        'label' => $data['BOOK_CODE'] . ' | ' . $data['BOOK_TITLE'],
        'description'    => $data['BOOK_CODE'] . '|' . $data['BOOK_TITLE'],
        'id'    => $data['BOOK_CODE'],
    );
}

if (!empty($arr_result)) {
    // Encode ke format JSON.
    echo json_encode($arr_result);
}

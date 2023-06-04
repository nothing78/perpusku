<?php
include 'db.php';

// if (isset($_POST["query"])) {
//     $output = '';
// $key = "%" . $_POST["query"] . "%";
// $query = "SELECT * FROM customer having first_name LIKE ? LIMIT 10";
// $dewan1 = $db->prepare($query);
// $dewan1->bind_param('s', $key);
// $dewan1->execute();
// $res1 = $dewan1->get_result();

//     $output = '<ul class="list-unstyled">';
//     if ($res1->num_rows > 0) {
//         while ($row = $res1->fetch_assoc()) {
//             $output .= '<li>' . $row["first_name"] . ' ' . $row['last_name'] . '</li>';
//         }
//     } else {
//         $output .= '<li>Tidak ada yang cocok.</li>';
//     }
//     $output .= '</ul>';
//     echo $output;
// }

//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query  = $db->query("SELECT * FROM lms_members WHERE MEMBER_NAME LIKE '%$searchTerm%' LIMIT 10");
$result = $query->fetch_all(MYSQLI_ASSOC);

// Format bentuk data untuk autocomplete.
foreach ($result as $data) {
    $arr_result[] = array(
        'label' => $data['MEMBER_NAME'],
        'description'    => $data['MEMBER_NAME'],
        'id'    => $data['MEMBER_ID'],
    );
}

if (!empty($arr_result)) {
    // Encode ke format JSON.
    echo json_encode($arr_result);
}

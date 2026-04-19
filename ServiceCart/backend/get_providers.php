<?php
include "db.php";

$service = isset($_GET['service']) ? $_GET['service'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

$sql = "SELECT p.*, ROUND(IFNULL(AVG(r.rating), p.rating), 1) as rating 
        FROM providers p 
        LEFT JOIN users u ON p.email = u.email AND u.role = 'Provider'
        LEFT JOIN reviews r ON u.id = r.provider_id 
        WHERE 1=1";

if (!empty($service)) {
    $sql .= " AND p.service LIKE '%$service%'";
}

if (!empty($location)) {
    $sql .= " AND p.location LIKE '%$location%'";
}

$sql .= " GROUP BY p.id";

$result = $conn->query($sql);

$providers = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $providers[] = $row;
    }
}

echo json_encode($providers);
?>

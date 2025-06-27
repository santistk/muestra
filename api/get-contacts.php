<?php
require '../config.php';

$sql = "
    SELECT c.id, c.full_name, co.name as company, co.email, c.message, c.submitted_at 
    FROM contacts c
    LEFT JOIN companies co ON c.company_id = co.id
    ORDER BY c.submitted_at DESC";

$result = $conn->query($sql);
$contacts = [];

while ($row = $result->fetch_assoc()) {
    $contacts[] = $row;
}

echo json_encode($contacts);
?>
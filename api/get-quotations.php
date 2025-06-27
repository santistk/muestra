<?php
require '../config.php';

$sql = "
    SELECT q.id, co.name as company, GROUP_CONCAT(p.name SEPARATOR ', ') as products, q.requested_at, q.status
    FROM quotations q
    LEFT JOIN companies co ON q.company_id = co.id
    LEFT JOIN quotation_items qi ON q.id = qi.quotation_id
    LEFT JOIN products p ON qi.product_id = p.id
    GROUP BY q.id
    ORDER BY q.requested_at DESC";

$result = $conn->query($sql);
$quotations = [];

while ($row = $result->fetch_assoc()) {
    $quotations[] = $row;
}

echo json_encode($quotations);
?>
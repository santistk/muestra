<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $company = $conn->real_escape_string($_POST['company']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $products = $_POST['products'] ?? [];

    // Insertar empresa
    $conn->query("INSERT INTO companies (name, address, country, phone, email)
                  VALUES ('$company', '$address', '$country', '$phone', '$email')");
    $company_id = $conn->insert_id;

    // Insertar cotización
    $conn->query("INSERT INTO quotations (company_id) VALUES ($company_id)");
    $quotation_id = $conn->insert_id;

    // Insertar productos seleccionados
    foreach ($products as $product_id) {
        $product_id = intval($product_id);
        $conn->query("INSERT INTO quotation_items (quotation_id, product_id)
                      VALUES ($quotation_id, $product_id)");
    }

    echo json_encode(['status' => 'ok', 'message' => 'Solicitud de cotización enviada']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
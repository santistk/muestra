<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $company = $conn->real_escape_string($_POST['company']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insertar empresa
    $conn->query("INSERT INTO companies (name, address, country, phone, email)
                  VALUES ('$company', '$address', '$country', '$phone', '$email')");
    $company_id = $conn->insert_id;

    // Insertar contacto
    $conn->query("INSERT INTO contacts (company_id, full_name, message)
                  VALUES ($company_id, '$name', '$message')");

    echo json_encode(['status' => 'ok', 'message' => 'Datos guardados correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
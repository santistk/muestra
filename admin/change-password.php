<?php
require '../config.php';

$email = 'info@commodities.com';
$new_password = 'nuevacontraseña123';
$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE admins SET password_hash = ? WHERE email = ?");
$stmt->bind_param("ss", $new_hash, $email);

if ($stmt->execute()) {
    echo "✅ Contraseña actualizada correctamente.";
} else {
    echo "❌ Error al actualizar la contraseña.";
}
?>
<?php
include("connection.php");

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'];

$conn = new mysqli("localhost", "root", "", "events_db");
$sql = "DELETE FROM events WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$response = ['success' => $stmt->execute()];
echo json_encode($response);
$conn->close();
?>

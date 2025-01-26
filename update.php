<?php
include("connection.php");
include("function.php");

$input = json_decode(file_get_contents('php://input'), true);
$event_Id = $input['event_Id'];
$title = $input['title'];
$place = $input['place'];
$time = $input['time'];
$tickets = $input['tickets'];
$description = $input['description'];
$price = $input['price'];

$conn = new mysqli("localhost", "root", "", "E-ticket");
$sql = "UPDATE events SET title=?, place=?, time=?, tickets=?, description=?, price=? WHERE event_Id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiisi", $title, $place, $time, $tickets, $description, $price, $event_Id);

$response = ['success' => $stmt->execute()];
echo json_encode($response);
$conn->close();
?>

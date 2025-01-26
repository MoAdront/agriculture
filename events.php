<?php
include("connection.php");
include("function.php");

$sql = "SELECT * FROM add_event";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - E-Ticket Booking</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }
        .book-btn {
            background-color: #2196F3;
            color: white;
            border: none;
        }
        .popup-table {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

        .popup-table.active {
            display: table;
        }
    </style>
</head>
<body>
    <header>
        <h1><i class="credit-card"></i>Make your book here</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="events.php">Book Event</a>
        <a href="logout.php">Logout</a>
        <a href="transport.php">Bus</a>
    </nav>
    <main>
        <section>
            <table id="eventTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Place</th>
                        <th>Time</th>
                        <th>Ticket</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM add_event";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr event_Id='{$row['event_Id']}'>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['place'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['ticket'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";                            
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td><button class='book-btn' onclick='bookRow(this)'>Book</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No events found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <table id="popupTable" class="popup-table">
    <thead>
        <tr>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="popupContent">

    </tbody>
</table>

<script>
   function bookRow(button) {
    const row = button.closest("tr");
    const eventId = row.getAttribute("data-id"); 

    fetch(`get_event_details.php?event_id=${eventId}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                const popupContent = document.getElementById("popupContent");
                popupContent.innerHTML = `
                    <tr>
                        <td>${data.description}</td>
                        <td>${data.price}</td>
                        <td>
                            <button onclick="confirmBooking(${data.event_id})" class="book-btn">Confirm Booking</button>
                            <button onclick="closePopup()" class="book-btn" style="background-color: red;">Cancel</button>
                        </td>
                    </tr>
                `;
                document.getElementById("popupTable").classList.add("active");
            }
        })
        .catch(error => console.error("Error fetching event details:", error));
}

function closePopup() {
    document.getElementById("popupTable").classList.remove("active");
}

function confirmBooking(eventId) {
    fetch(`confirm_booking.php?event_id=${eventId}`, { method: "POST" })
        .then(response => response.text())
        .then(message => {
            alert(message);
            closePopup();
        })
        .catch(error => console.error("Error confirming booking:", error));
}

</script>


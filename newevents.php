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
            width: 60%;
            border-collapse: collapse;
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
        <a href="book_ticket.php">Book Tickets</a>
        <a href="logout.php">Logout</a>
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
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr data-id='{$row['event_Id']}'>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['place'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['ticket'] . "</td>";
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
                    <!-- Content will be dynamically added -->
                </tbody>
            </table>
        </section>
    </main>
    <script>
        function bookRow(button) {
            const row = button.closest("tr");
            const eventId = row.getAttribute("data-id"); // Corrected to match the attribute

            // Fetch event details from the server using AJAX
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
            // Send booking request to the server
            fetch(`confirm_booking.php?event_id=${eventId}`, { method: "POST" })
                .then(response => response.text())
                .then(message => {
                    alert(message);
                    closePopup();
                })
                .catch(error => console.error("Error confirming booking:", error));
        }
    </script>
</body>
</html>

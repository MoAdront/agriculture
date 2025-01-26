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
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
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
        <h3>Welcome <?php echo $_SESSION['name']?></h3>
    </nav>
    <main>
        <section>

        </section>

        <section>
            <table id="eventTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Place</th>
                <th>Time</th>
                <th>Ticket</th>
                <th>Descript</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr data-id='{$row['event_Id']}'>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['place'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['ticket'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>
                            <button class='edit-btn' onclick='editRow(this)'>Edit</button>
                            <button class='delete-btn' onclick='deleteRow(this)'>Delete</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No events found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function editRow(button) {
            const row = button.parentElement.parentElement;
            const cells = row.querySelectorAll("td");
            const id = row.getAttribute("data-id");
            cells.forEach((cell, index) => {
                if (index < cells.length - 1) { 
                    const currentValue = cell.innerText;
                    cell.innerHTML = `<input type="text" value="${currentValue}" />`;
                }
            });
            button.textContent = "Save";
            button.onclick = function () {
                saveRow(button, id);
            };
        }

        function saveRow(button, id) {
            const row = button.parentElement.parentElement;
            const cells = row.querySelectorAll("td");
            const data = {};
            cells.forEach((cell, index) => {
                if (index < cells.length - 1) { 
                    const input = cell.querySelector("input");
                    if (input) {
                        const key = ["title", "place", "time", "tickets_remaining"][index];
                        data[key] = input.value;
                        cell.textContent = input.value;
                    }
                }
            });
            // Send data to the server to update the database
            fetch("update.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id, ...data }),
            })
                .then((response) => response.json())
                .then((result) => {
                    if (result.success) {
                        alert("Row updated successfully!");
                    } else {
                        alert("Failed to update row.");
                    }
                })
                .catch((error) => {
                    console.error("Error updating row:", error);
                });

            button.textContent = "Edit";
            button.onclick = function () {
                editRow(button);
            };
        }

        function deleteRow(button) {
            const row = button.parentElement.parentElement;
            const id = row.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this row?")) {
                // Send delete request to the server
                fetch("delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ id }),
                })
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.success) {
                            alert("Row deleted successfully!");
                            row.remove();
                        } else {
                            alert("Failed to delete row.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error deleting row:", error);
                    });
            }
        }
    </script>

        </section>
    </main>
</body>
</html>
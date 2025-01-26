<?php
session_start();
include("connection.php");

if (!isset($_SESSION['name'])){
    session_destroy();
    header("location:login.php");
    exit();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - E-Ticket Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #0078D7;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            background-color: #333;
            padding: 10px 20px;
        }
        nav a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
        }
        .section {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .table th {
            background-color: #0078D7;
            color: white;
        }
        button {
            background-color: #0078D7;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        <h1><i class="credit-card"></i>Welcome to the E-Ticket Booking Dashboard</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="events.php">Book Event</a>
        <a href="logout.php">Logout</a>
        <a href="transport.php">Bus</a>
        <h3>Welcome <?php echo $_SESSION["name"]?></h3>
    </nav>
    <main>
        <div class="section">
           <a href="transport.php"><h2>Booked Tickets</h2></a> 
               <table>
                        <th>Ticket ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Seats</th>
                    </tr>
                        <tr>
                           
                </table>
         
            

        </div>
    </main>
</body>
</html>
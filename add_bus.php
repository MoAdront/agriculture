<?php
include("connection.php");

if($_SERVER['REQUEST_METHOD'] =="POST"){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $atime = $_POST['atime'];
    $stime = $_POST['stime'];
    $day = $_POST['day'];
    $seat = $_POST['seat'];
    $price = $_POST['price'];


        $events = "INSERT INTO my_ticket(`from`,`to`,`atime`,`stime`,`day`,`seat`,`price`) VALUES
        ('$from','$to','$atime','$stime','$day','$seat','$price')";


        $execute = mysqli_query($conn,$events);

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_events</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1><i class="credit-card"></i>Welcome to the E-Ticket Booking Dashboard</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="ticket.php">Book Tickets</a>
        <a href="logout.php">Logout</a>
        
    </nav>
    <main>
       
            <form action="" method="post">
                <div>
                    <h3>Add your Event here</h3><br>


                    <b>From:</b><br>
                    <input type="text" name="from" placeholder="Enter starting point" require><br>
                    <b>To:</b><br>
                    <input type="text" name="to" placeholder="enter destination" required><br>
                    <b>Arrival:</b><br>
                    <input type="time" name="atime" id="" placeholder="Insert arrival time" require><br>
                    <b>Departure:</b><br>
                    <input type="time" name="stime" id="" placeholder="Insert number departure time" require><br>
                    <b>Event day:</b><br>
                    <input type="text" name="day" require><br>
                    <b>seat:</b><br>
                    <input type="number" name="seat" id="" placeholder="Insert number seat for your journey" require><br>
                    <b>price:</b><br>
                    <input type="text" name="price" id="" placeholder="Insert price for your events" require><br>
                </div><br>
                <div style="display:flex;">
                    <button type="submit">ADD</button>
                    <a href="http://"><button><b>HOME</b></button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
include("connection.php");

if($_SERVER['REQUEST_METHOD'] =="POST"){
    $title = $_POST['title'];
    $place = $_POST['place'];
    $time = $_POST['time'];
    $ticket = $_POST['ticket'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if(empty($title) && empty($place) && empty($time) && empty($ticket) && empty($description) && empty($price)){
        echo "Each filled is required";
    }else{

        $events = "INSERT INTO add_event(title,place,time,ticket,description,price) VALUES
        ('$title','$place','$time','$ticket','$description','$price')";

        $execute = mysqli_query($conn,$events);

    }
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


                    <b>Title:</b><br>
                    <input type="text" name="title" placeholder="Enter event title" require><br>
                    <b>Place:</b><br>
                    <input type="text" name="place" placeholder="enter place for your events" required><br>
                    <b>Time:</b><br>
                    <input type="datetime" name="time" id="" placeholder="Insert time for your events" require><br>
                    <b>ticket:</b><br>
                    <input type="text" name="ticket" id="" placeholder="Insert number of ticket for your events" require><br>
                    <b>Event description:</b><br>
                    <input type="text" name="description" require><br>
                    <b>price:</b><br>
                    <input type="price" name="price" id="" placeholder="Insert price for your events" require><br>
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
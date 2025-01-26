<?php
session_start();
include("connection.php");



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $password = $_POST['password'];

    $log = "SELECT * FROM user WHERE name=? AND password=?";
    $stmt = $conn->prepare($log);
    $stmt->bind_param("ss",$name,$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['name'];
        header("Location: dashboard.php");
        exit();
    }else{
        echo  "Invalid username or password";
    }
    
}$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <header>
        <div>
            <img src="" alt="">
            <h1>E-TICKET MANAGEMENT SYSTEM</h1>
        </div>
    </header>
    <main>
        <div>
            <section>

            </section>
            <section>
                <div>
                    <form action="" method="post">
                        <div>
                            <h3><b>Login Here</b></h3><br>

</br>
                            <b>Username:</b><br>
                            <input type="text" name="name" placeholder="Enter username" required><br>
                            <b>Password:</b><br>
                            <input type="password" name="password" id="" placeholder="create password"><br>
                        </div><br>

                        <br>
                        <div>
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
</html>


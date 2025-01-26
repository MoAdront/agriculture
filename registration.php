<?php
include("connection.php");
include("function.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpass = $_POST['password'];

    if($confpass != $password){
        echo "Password doesn't Match";
    }else{

        $reg = "INSERT  INTO user (name,phone,email,password) VALUES  (?,?,?,?)";
        $stmt = $conn->prepare($reg);
        $stmt->bind_param("ssss",$name,$phone,$email,$password);
        
        if($stmt->execute()){
            echo "Reistration sucess";
            header("Location:login.php"); 
        }
    
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
                            <h3><b>SignUp Here</b></h3><br>

</br>
                            <b>Username:</b><br>
                            <input type="text" name="name" placeholder="Enter username" required><br>
                            <b>Phone:</b><br>
                            <input type="number" name="phone" id="" placeholder="Enter your mobile number" required><br>
                            <b>Email:</b><br>
                            <input type="email" name="email" id="" placeholder="Enter your email" required><br>
                            <b>Password:</b><br>
                            <input type="password" name="password" id="" placeholder="create password"><br>
                            <b>Confirm your password:</b><br>
                            <input type="password" name="confpass" id="" placeholder="confirm your password"><br>
                        </div><br>

                        <br>
                        <div>
                            <button type="submit">SignUp</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
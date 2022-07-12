<?php
$db= new mysqli('localhost' ,'root', '','reg');
// if ($db->connect_error) {
//     die("Sikertelen kapcsolódás: " . $db->connect_error); // sikertelen kapcsolódás
//   } else {
//     echo "Sikeres kapcsolódás."; // sikeres kapcsolódás
//   }


if (isset($_POST['submit'])) {
    $errors = array();
    $true=true;
if (empty($_POST['username'])) {
    $true= false;
   array_push($errors, 'A felhasználónév üres');
}
if (empty($_POST['password'])) {
    $true= false;
   array_push($errors, 'A jelszó üres');
}
if (empty($_POST['password2'])) {
    $true= false;
   array_push($errors, 'Az jelszó 2üres');
}
if (empty($_POST['email'])) {
    $true= false;
   array_push($errors, 'A email üres');
}
if (empty($_POST['number'])) {
    $true= false;
   array_push($errors, 'A number üres üres');
}

if(!($_POST['password']==$_POST['password2'])){
    $true=false;
    array_push($errors, "A jelszavak nem egyeznek-!");
}






    if ($true) {
       //regisztráció
        $username= mysqli_real_escape_string($db, $_POST['username']);
        $password= mysqli_real_escape_string($db, $_POST['password']);
        $email= mysqli_real_escape_string($db, $_POST['email']);
        $pin= mysqli_real_escape_string($db, $_POST['number']);
        $password= md5($password);
        $sql= "INSERT INTO users(username, password, email, pin , date)
        VALUES('$username', '$password','$email','$pin',NOW())";
        $db->query($sql);
        session_start();
        $_SESSION['username'] = $username;
       header('location:home.php');

}
    
}



$db->close();



?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="a.css">
    <title>login</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Regisztrálj</h1>
            <img src="wolf.svg"class="a" alt="wolf">
            
        </div>
         <form action="index.php" method="POST">
        <div class="right-login">
            <div class="card-login">
                <h1>Regisztráció</h1>
                <div class="textfield">
                    <label for="username" >Felhasználónév  </label>
                    <input type="text" name="username" id="username " placeholder="Felhasználónév">
                </div>
                <div class="textfield">
                    <label for="password" >Jelszó: </label>
                    <input type="password" name="password" id="password " placeholder="Jelszó">
                </div>
                <div class="textfield">
                    <label for="username" >Jelszó újból </label>
           <input type="password" name="password2" id="password2 " placeholder="Jelszó">
                </div>
                <div class="textfield">
                    <label for="pin" > PIN KÓD </label>
           <input type="text" name="number" id="number " placeholder="PIN KÓD">
                </div>
                <div class="textfield">
                    <label for="username" >Email </label>
                    <input type="email" name="email" id="email " placeholder="email">
                </div>
                
           <input
           class="btn-login"  value="regisztráció "type="submit" name="submit" id="submit">
               
            </div>


        </div>
    </div>
     </form>


    <?php
if (!empty($errors)) {
    foreach($errors as $key){
        echo $key."<br/>";
        
    }


}
?>
    
</body>
</html>
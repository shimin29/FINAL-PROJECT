<?php
session_start();

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if(isset($_POST['username'])){
    $db = new PDO("mysql:host=localhost;dbname=final_project", "root");

    $query = "SELECT * FROM users WHERE username=:username";

    $stmt = $db->prepare($query);
    $stmt->execute(array(
        ':username'=>$username
    ));
    $user = $stmt->fetchAll();

    $is_password_match = password_verify($password, $user[0]['password']);

    echo $is_password_match ? "<h1>Correct password!</h1>" : "<h1>Wrong password!</h1>";

    if($is_password_match){
        $_SESSION['user'] = $user[0];
    }
}else{
    echo "<h1>User is successfully logged in!</h1>";
    print_r($_SESSION['user']);
    // Short Exercise:
    // Add a logout link, linked to a logout.php file, that clears the session.
    // In the logout file, add a link to login-form.php to close the loop.
}
echo "<h2><a href='./logout.php?logout=true'> Click here to logout </a></h2>";

?>
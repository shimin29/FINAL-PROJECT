<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$user_id = $_SESSION['user_id'];
$game_id = $_GET['game_id'];

$query = "SELECT * FROM favorites  WHERE user_id = :user_id  AND game_id = :game_id";

$stmt = $db->prepare($query);
$stmt->execute([
    ':user_id' => $user_id,
    ':game_id' => $game_id
]);

$exists = $stmt->fetch();

if (!$exists) {

    $query = "INSERT INTO favorites(user_id, game_id)
              VALUES(:user_id, :game_id)";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':user_id' => $user_id,
        ':game_id' => $game_id
    ]);
}

header("Location: my-favourites.php"); exit();

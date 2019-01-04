<?php
/**
 * Created by PhpStorm.
 * User: Rico
 * Date: 4-1-2019
 * Time: 11:38
 */

session_start();

$mysqli = new mysqli('localhost', 'root','', 'stageproject')or die(mysqli_error($mysqli));
$update = false;
$id =0;
$naam = "";
$email = "";
$adres = "";
if (isset($_POST['save'])){
    $naam = $_POST['naam'];
    $adres = $_POST['adres'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO gebruikers(naam, adres, email) VALUES('$naam', '$adres','$email')")or die($mysqli->error);

    $_SESSION['message'] = "Gebruiker is opgeslagen";

    header('location: index.php');

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM gebruikers WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Gebruiker is verwijderd";

}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM gebruikers WHERE id=$id")or die($mysqli-error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $naam = $row['naam'];
        $adres = $row['adres'];
        $email = $row['email'];
    }
}


if (isset($_POST['update'])){
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $adres = $_POST['adres'];
    $email = $_POST['email'];

    $result = $mysqli->query("UPDATE gebruikers SET naam='$naam', adres='$adres', email='$email' WHERE id=$id")
    or die($mysqli-error());

    $_SESSION['message'] = "Gebruiker is aangepast";

    header('location: index.php');

}
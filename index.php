<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <title>Gebruikers</title>
</head>
<body>

<?php require_once 'process.php' ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Rico Stolker</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
    </div>
</nav>


<?php

if (isset($_SESSION['message'])): ?>
<div class="alert alert-primary">
<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php endif; ?>


<div class="container">

    <br>
    <h2>Gebruikers</h2>
    <h7>Hier kunt u gebruikers zien, toevoegen, aanpassen of verwijderen</h7>
    <br>
    <br>




    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <h5><label>Naam</label></h5>
            <input type="text" name="naam" class="form-control"
                   value="<?php echo $naam; ?>" placeholder="schrijf uw naam hier">
        </div>
        <div class="form-group">
            <h5><label>Adres</label></h5>
            <input type="text" name="adres" class="form-control"
                   value="<?php echo $adres; ?>" placeholder="schrijf uw adres hier">
        </div>
        <div class="form-group">
            <h5><label>Email</label></h5>
            <input type="email" name="email" class="form-control"
                   value="<?php echo $email; ?>" placeholder="schrijf uw email hier">
        </div>
        <div class="form-group">
            <?php if ($update == true):
                ?><button type="submit" class="btn btn-primary" name="update">aanpassen</button>
            <?php else: ?>
                <button type="submit" class="btn btn-outline-success" name="save">opslaan</button>
            <?php endif; ?>
        </div>
    </form>



<?php
    $mysqli = new mysqli('localhost','root', '', 'stageproject')or die (mysqli_error($mysqli));
    $result = $mysqli->query("select * FROM gebruikers") or die (mysqli_error($mysqli));
    ?>

<div class="row justify-content-center">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>naam</th>
            <th>adres</th>
            <th>email</th>
            <th>Aangemaakt op</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
    <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['naam'];?></td>
            <td><?php echo $row['adres'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['aangemaakt_op'];?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>"
                   class="btn btn-info">aanpassen</a>
                <a href="index.php?delete=<?php echo $row['id']; ?>"
                   class="btn btn-danger">verwijderen</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>
</div>

</body>
</html>
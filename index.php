<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>PHP_CRUD</title>
</head>
<body>
    <?php require_once('process.php'); ?>
    <?php
        if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['message_type']?>">
        <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
    <div class="container py-5">
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                        while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                </table>
            </div>
    <div class="row justify-content-center">
        <form action="process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label>Name:</label>
                <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label>Location:</label>
                <input class="form-control" type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location">
            </div>
            <div class="form-group">
                <?php
                    if ($update == true): ?>
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                    <?php else: ?>
                <button class="btn btn-primary" type="submit" name="save">Save</button>
                <?php endif ?>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
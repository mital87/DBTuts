<?php

include_once 'config.php';

if(isset($_POST['btn-save'])){
    $firstName = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
    $lastName = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
    $city = isset($_POST['city']) ? $_POST['city'] : NULL;
    try{
    $insertQuery = $db->prepare("insert into `users` (`id`,`first_name`,`last_name`,`user_city`)"
            . "values (NULL,?,?,?)" );
    $queryInsert = $insertQuery->execute(array($firstName,$lastName,$city));
    header("Location: index.php");
    } catch (Exception $e){
        echo 'Error while inserting data.';
    }
}

?>
<html>
    <head>
        <title>CURD Operation with PHP</title>
        <link  href="css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
        <center>
            <div id="header">
                <div id="content">
                    <label>CURD Operation</label>
                </div>
            </div>
            <div class="bs-example">
                    <a href="index.php">CURD OPERATION</a>
                    <form method="post">
                        <div class="form-group">
                          <label for="firstname">First Name</label>
                          <input type="text" class="form-control" id="firstname" placeholder="Firstname" name="firstname">
                        </div>
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" class="form-control" id="lastname" placeholder="Lastname" name="lastname">
                        </div>
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class="form-control" id="city" placeholder="City" name="city">
                        </div>
                        <button type="submit" class="btn btn-success" name="btn-save">Submit</button>
                    </form>
            </div>
        </center>
            </div>
        </div>
    </body>
</html>
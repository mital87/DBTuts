<?php
    include_once 'config.php';
    if(isset($_GET['edit_id'])){
        $id = $_GET['edit_id'];
        $sqlQuery = $db->prepare("select * from users where id=?");
        $sqlQuery->bindValue(1,$id,PDO::PARAM_INT);
        $sqlQuery->execute();
        
        $fetchData = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST['btn_update'])){
        $firstName = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
        $lastName = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
        $city = isset($_POST['city']) ? $_POST['city'] : NULL;
        
        try{
            $updateQuery = $db->prepare("update users set first_name=? , last_name=? , user_city=? where id = ?");
            $queryData = $updateQuery->execute(array($firstName,$lastName,$city,$id));
            if($queryData){
                header('Location: index.php');
            }
        }catch(Exception $e)
        {
            echo 'Error while updating data';
        }
    }
    
    if(!empty($fetchData)){
?>

<html>
    <head>
        <title>CRUD Operation</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <center>
                <form method="post">
                    <table class="table table-striped">
                        <tr>
                            <td>First Name</td>
                            <td>
                                <input type="text" name="firstname" placeholder="Firstname" value="<?php echo $fetchData[0]['first_name'];  ?>"
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>
                                <input type="text" name="lastname" placeholder="Lastname" value="<?php echo $fetchData[0]['last_name'];  ?>"
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" name="city" placeholder="City" value="<?php echo $fetchData[0]['user_city'];  ?>"
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="btn_update"><strong>Update</strong></button>
                            </td>
                        </tr>
                    </table>
                </form>
                </center>
            </div>
        </div>
    </body>
</html>
    <?php } ?>

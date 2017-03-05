<?php
    include_once 'config.php';
    
    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $deleteQuery = $db->prepare("delete from users where id = ?");
        $deleteQuery->bindValue(1,$id,PDO::PARAM_INT);
        $deleteQuery->execute();
        
        $data = $deleteQuery->debugDumpParams();
        header("Location: $_SERVER[PHP_SELF]");
        
    }
?>
<html>
    <head>
        <title>View Data</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th colspan="5"><a href="add_data.php">Add Data Here</a></th>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>City</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                        $sqlQuery = $db->prepare("select * from users");
                        $sqlQuery->execute();
                        $data = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($data as $key => $value) {
                                echo "<tr>";
                                echo "<td>".$value['first_name']."</td>";
                                echo "<td>".$value['last_name']."</td>";
                                echo "<td>".$value['user_city']."</td>";
                                echo "<td align='center'><a href='javascript:edt_id(".$value['id'].")'>Edit</a></td>";
                                echo "<td align='center'><a href='javascript:delete_id(".$value['id'].")'>Delete</a></td>";
                                echo "</tr>";
                        }
                    ?>
                </table>
            </div>            
       </div>
        <script type="text/javascript">
        function edt_id(id)
        {
           if(confirm('Sure to edit ?'))
           {
              window.location.href='edit.php?edit_id='+id;
           }
        }
        function delete_id(id)
        {
           if(confirm('Sure to Delete ?'))
           {
              window.location.href='view.php?delete_id='+id;
           }
        }
</script>
    </body>
</html>
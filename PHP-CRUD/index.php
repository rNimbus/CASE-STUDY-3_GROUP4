<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP CRUD</title>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
</head>
    <body>
        <?php require_once 'process.php';?>
        
        
        <?php
        if (isset($_SESSION['message'])): ?>
        
        <div class ="alert alert-<?=$_SESSION['msg_type'] ?>">
        
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>  
        <div class="container">
        <?php
            $mysqli = new mysqli('localhost' , 'root' , 'Andrei12345' , 'db_pms') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM tbl_patient") or die(mysqli->error);
            //pre_r($result);
            ?>
        
            <div class="row justify-content-center">
                    <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    
            <?php
                while($row = $result->fetch_assoc()): ?>
                    <tr>    
                        <td><?php echo $row ['name']; ?></td>
                        <td><?php echo $row ['address']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['patient_id']; ?>"
                               class ="btn btn-info">Edit </a>
                            <a href="index.php?delete=<?php echo $row['patient_id']; ?>"
                                       class ="btn btn-danger">Delete </a>
                        </td>
                    </tr>
                <?php  endwhile; ?>
                    </table>
            </div>
        
            <?php
            function pre_r($array){
                echo '<pre>';
                print_r($array);
                echo'</pre>';
            }
        ?>
        
        <div class = "row justify-content-center">
        <form action="process.php" method="POST">
            <input type ="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
            <div class = "form-group">
                <label>Name</label>
                <input type = "text" name="name" class = "form-control" 
                       value="<?php echo $name?>" placeholder="Enter your name">
            </div>
            <div class = "form-group">
                <label>Address</label>
                <input type = "text" name="address" class="form-control" 
                       value="<?php echo $address?>" placeholder="Enter your address">
            </div>
            <div class = "form-group">
            <?php
            if ($update == true):
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
            
                <button type="submit" class="btn btn-info" name="save">Save</button> 
            <?php endif; ?>
            </div>
        </div>
        </div>
    </body>
</html>

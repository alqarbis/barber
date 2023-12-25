<?php
session_start();
if(isset($_SESSION['user_info']))
{
include('include/header.php');
require('dbconnect.php');
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-users"></i> Users</h2>


            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Add New User
                    </div>
                    <?php
                       if($_SERVER["REQUEST_METHOD"]=="POST")
                       {
                        if(isset($_POST['add']))
                        {
                            $name=trim($_POST['name']);
                            $email=trim($_POST['email']);
                            $pass=trim($_POST['pass']);

                            $confirm=trim($_POST['confirm']);
                            $type=trim($_POST['type']);
                            $active=trim($_POST['active']);


                            $errors=array();
                            if(is_numeric($name))
                            {
                                $errors['name']="must be string";
                            }

                            if($pass != $confirm)
                            {
                                $errors['confirm']="password must be the same";

                            }
                            if(empty($errors))
                            {
                                $sql="INSERT INTO users ( name, emial, password, role_id, active) VALUES (? ,? ,?,? ,?)";
                                $stm =$conn->prepare($sql);
                                $stm->execute(array($name ,$email ,$pass ,$type ,$active));
                                if($stm->rowcount())
                                {
                                    echo "<div class='alert alert-success'>one row inserted</div>";
                                }
                                else{
                                    echo "<div class='alert alert-danger'>one row  not inserted</div>";
                                }
                            }
                        }
                       }
                    ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name " class="form-control" />
                                        <i><?php if(isset($errors['name'])) echo $errors['name']  ?></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="PLease Enter Eamil" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" class="form-control" placeholder="Please Enter password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm" class="form-control"
                                            placeholder="Please Enter confirm password">
                                            <i><?php  if(isset($errors['confirm']))  echo $errors['confirm']  ?></i>
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select name="type" class="form-control">
                                        <?php

                                                $sql="select * from roles";
                                                $stm=$conn->prepare($sql);
                                                $stm->execute();
                                                if($stm->rowcount())
                                                {
                                                foreach($stm->fetchall() as $row)
                                                {
                                                    $id=$row['role_id'];
                                                    $name=$row['name'];
                                                    

                                                ?>
                                                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                                                <?php
                                                }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>active </label>
                                        <select name="active" class="form-control">
                                            <option  value="1">Active</option>
                                            <option value="2">Nonactive</option>
                                           
                                        </select>
                                    </div>
                                    <div style="float:right;">

                                        <button type="submit"  name="add" class="btn btn-primary">Add User</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Users
                    </div>
                    <?php
                    if(isset($_GET['action'],$_GET['id']))
                            {
                                $id=$_GET['id'];
                                switch($_GET['action'])
                                {
                                    case "delete":
                                        $sql="delete from users where id=:user_id";
                                        $stm= $conn->prepare($sql);
                                        $stm->execute(array("user_id"=>$id));
                                        if($stm->rowCount()==1)
                                        {
                                         echo "<div class='alert alert-success'> one Row deleted </div>";
                                        //  header('location:users.php#table');
                                        }
                                        break;
                                        default :
                                        echo " Error";
                                }
                            }  
                    ?>
                    <!-- end of php code delete -->  
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                        $sql="select * from users";
                                        $stm=$conn->prepare($sql);
                                        $stm->execute();
                                        if($stm->rowcount())
                                        {
                                        foreach($stm->fetchall() as $row)
                                        {
                                            $id=$row['id'];
                                            ?>
                                    <tr class="odd gradeX">
                                    <td><?php echo $row['name']  ?></td>
                                        <td><?php echo $row['emial']  ?></td>
                                        <td><?php echo $row['password']?></td>
                                        <td><?php echo $row['role_id']?></td>
                                        <td><?php echo $row['active']?></td>
                                        <td class="center">4</td>

                                        <td>
                                            <a href="edituser.php?action=edit&id=<?php echo $id?>" class='btn btn-success'>Edit</a>
                                            <a href="?action=delete&id=<?php echo $id?>" class='btn btn-danger'>Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                       }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->

            </div>
            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>

<!-- /. WRAPPER  -->
<?php
include('include/footer.php');
}

?>
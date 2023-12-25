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
                        <i class="fa fa-plus-circle"></i> Edit  New User
                    </div>
                    <?php

                    if(isset($_GET['action'] ,$_GET['id'])&& $_GET['action']=='edit')
                    {
                        $id=$_GET['id'];
                        echo $id ;
                        $sql="select * from users where id=:uid";
                        $stm=$conn->prepare($sql);
                        $stm->execute(array("uid"=>$id));
                        if($stm->rowcount())
                        {
                            foreach($stm->fetchall() as $row)
                            {
                               $name=$row['name'];
                               $email=$row['emial'];
                               $pass=$row['password'];

                               $type=$row['role_id'];
                               $actve=$row['active'];
                            
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
                                $sql="UPDATE users SET  name=?, emial=?, password=?, role_id=?, active=? where id=?";
                                $stm =$conn->prepare($sql);
                                $stm->execute(array($name ,$email ,$pass ,$type ,$active ,$id));
                                if($stm->rowcount())
                                {
                                    echo "<script>
                                    alert('row updated')
                                    window.open('users.php' ,'_self');
                                    </script>";
                                    
                                }
                                else{
                                    echo "<div class='alert alert-danger'>one row  not updated</div>";
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
                                        <input type="text" value="<?php echo $name ?>" name="name" placeholder="Please Enter your Name " class="form-control" />
                                        <i><?php if(isset($errors['name'])) echo $errors['name']  ?></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email"value="<?php echo $email ?>" name="email" class="form-control" placeholder="PLease Enter Eamil" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" value="<?php echo $pass ?>" name="pass" class="form-control" placeholder="Please Enter password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="text"  value="<?php echo $pass ?>" name="confirm" class="form-control"
                                            placeholder="Please Enter confirm password">
                                            <i><?php  if(isset($errors['confirm']))  echo $errors['confirm']  ?></i>
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select name="type" class="form-control">
                                        <?php

                                                $sql="select * from roles ";
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

                                        <button type="submit"  name="add" class="btn btn-primary">edit User</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>
                            <?php
                        }
                    }
                }
                ?>

                        </div>


                    </div>
                </div>
            </div>

        </div>
        <hr />

        
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
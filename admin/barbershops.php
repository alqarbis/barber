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
                        <h2><i class="fa fa-tasks"></i> barbershops</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New barbershop
                            </div>
                            <?php
                         if($_SERVER["REQUEST_METHOD"]="POST")
                            {
                                if(isset($_POST['addbarbershop']))
                                {
                                    
                                    $name =trim($_POST['name']);
                                    $address=trim($_POST['address']);
                                    $imge=$_FILES['file'];
                                    $img_name=$imge['name'];
                                    $img_type=$imge['type'];
                                    $img_tmp_name=$imge['tmp_name'];
                                    $extension=array('jpg' ,'gif' ,'png');
                                    $fileee=explode('.' ,$img_name);
                                    $file_extentions=strtolower(end($fileee));
                                    $errors =array();

                                    if(!in_array($file_extentions ,$extension))
                                    {
                                        $errors['file']= "<div class='alert alert-danger'>invalid extenionss </div>";
                                    }
                                   

                                    //  echo '<pre>';
                                    //  print_r( $imge);
                                    
                                    // echo '</pre>';

                                    if(is_numeric($name))
                                    {
                                            $errors['name']="name must be string";
                                    }
                                   if(empty($errors))
                                   {
                                    if(move_uploaded_file($img_tmp_name ,"upload/".$img_name))
                                    {
                                    $sql ="INSERT INTO shops( name, address , imge) VALUES(? ,? ,?) ";
                                    $stm =$conn->prepare($sql);
                                    $stm->execute(array($name ,$address ,$img_name));
                                      if($stm->rowcount())
                                      {
                                        echo "<div class='alert alert-success'>row inserted</div>";
                                      }
                                      else{
                                        echo "<div class='alert alert-danger'>row inserted</div>";
                                      }
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-damger'>file not uploaded</div>";
                                    }
                                   }
                                }
                             }





                            ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " name="name" require
                                                    class="form-control" />
                                                    <?php
                                                     if(isset($errors['name'])) echo $errors['name']?>



                                                     
                                            </div>
                                            <div class="form-group">
                                                <label>address</label>

                                                <textarea placeholder="Please Enter address"  name="address" class="form-control"
                                                    cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Imge</label>
                                                <input type="file" placeholder="Please Enter your imge " name="file" require
                                                    class="form-control" />
                                                    <?php
                                                     if(isset($errors['file'])) echo $errors['file']?>
                                            <div style="float:right;">

                                                <button type="submit" name="addbarbershop" class="btn btn-primary">Add Barbershopy</button>
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
                                <i class="fa fa-tasks"></i> barbershops
                            </div>
                            <?php
                                      
                                  if(isset($_GET['action'] ,$_GET['id']))
                                  {
                                    $id=$_GET['id'];

                                    switch($_GET['action'])
                                    {
                                        
                                        case "delete": 
                                            $sql ="delete from shops where shop_id=:sho_id";
                                            $stm =$conn->prepare($sql);
                                            $stm->execute(array("sho_id"=>$id));
                                            if($stm->rowcount()==1)
                                            {
                                                echo "<div class='alert alert-success'>one row deleted</div>";
                                            }

                                        
                                        break ;
                                        default :
                                        echo "error";
                                        break;
                                    }
                                  }


                             ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>address</th>
                                                <th>Imge</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql ="select * from shops";
                                            $stm =$conn->prepare($sql);
                                            $stm->execute();
                                            if( $stm->rowcount())
                                            {
                                                foreach($stm->fetchall() as $row)
                                                {
                                                     $id=$row['shop_id'];
                                              
                                            ?>
                                            <tr class="odd gradeX">
                                                <td> <?php echo $row['name']?></td>
                                                <td><?php echo $row['address']  ?></td>
                                                <td><img src="upload/<?php echo $row['imge'] ?>" alt="" width="150px"></td>
                                                <td>
                                                    <a href="editbarbershop.php?action=edit&id=<?php echo $id ?>" class='btn btn-success' >Edit</a>
                                                    <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id="delete">Delete</a>
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

<script>
   $('#delete').click(function()
   {
    return confirm('are you shure !!');
   }
   );

</script>
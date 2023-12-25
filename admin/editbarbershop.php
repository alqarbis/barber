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
                                <i class="fa fa-plus-circle"></i> Edit  barbershop
                            </div>
                            <?php
                        /* if($_SERVER["REQUEST_METHOD"]="POST")
                            {
                                if(isset($_POST['addbarbershop']))
                                {
                                    $id =$_POST['id'];
                                    $name =trim($_POST['name']);
                                    $address=trim($_POST['address']);


                                    $errors =array();


                                    if(is_numeric($name))
                                    {
                                            $errors['name']="name must be string";
                                    }
                                   if(empty($errors))
                                   {
                                    $sql ="INSERT INTO shops( `name`, `address`) VALUES(? ,?) ";
                                    $stm =$conn->prepare($sql);
                                    $stm->execute(array($name ,$address));
                                      if($stm->rowcount())
                                      {
                                        echo "<div class='alert alert-success'>row inserted</div>";
                                      }
                                      else{
                                        echo "<div class='alert alert-danger'>row inserted</div>";
                                      }
                                   }
                                }
                             }



*/

                            ?>
                            <?php
                              if(isset($_GET['action'] ,$_GET['id']) && $_GET['action']=='edit' )
                              {
                                $id =$_GET['id'];
                              $sql ="select * from shops where shop_id=:sho_id";
                              $stm =$conn->prepare($sql);
                              $stm->execute(array("sho_id"=>$id));
                              if( $stm->rowcount())
                              {
                               
                               foreach($stm->fetchall() as $row)
                                {
                                    $id =$row['shop_id'];
                                    $name =$row['name'];

                                    $address =$row['address'];
                                    $img =$row['imge'];



                                    if(isset($_POST['addbarbershop']))
                                    {
                                        $id =$_POST['id'];
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

    
                                        
    
    
                                        if(is_numeric($name))
                                        {
                                                $errors['name']="name must be string";
                                        }
                                       if(empty($errors))
                                       {
                                        if(move_uploaded_file($img_tmp_name ,"upload/".$img_name))
                                          {
                                        $sql ="UPDATE shops SET name=?, address=? , imge=? WHERE shop_id=?";
                                        $stm =$conn->prepare($sql);
                                        $stm->execute(array($name ,$address  ,$img_name  ,$id));
                                          if($stm->rowcount())
                                          {
                                            echo "<script>
                                            alert(' row updated')
                                            window.open('barbershops.php' ,'_self');
                                            </script>";
                                            
                                          }
                                          else{
                                            echo "<div class='alert alert-danger'>row no updated</div>";
                                          }
                                        }else{
                                            echo "<div class='alert alert-damger'>file not uploaded</div>";
                                        }
                                       }
                                    }
                            
                               ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php  echo $id ?>">
                                                <label>Name</label>
                                                <input type="text" name="name" value="<?php  echo $name ?>" placeholder="Please Enter your Name " name="name" require
                                                    class="form-control" />
                                                    <?php
                                                     if(isset($errors['name'])) echo $errors['name']?>



                                                     
                                            </div>
                                            <div class="form-group">
                                                <label>address</label>

                                                <textarea placeholder="Please Enter address"  name="address" class="form-control"
                                                    cols="30" rows="3"><?php  echo $address ?>"</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Imge</label>
                                                
                                                <input type="file" placeholder="Please Enter your imge " name="file" require
                                                    class="form-control"style="float:left ; display:inline ;" />
                                                    <img src="upload/<?php echo $img ?>" alt="" width="80px" style="float:left ; display:inline ;">
                                                    

                                                    <?php
                                               
                                               if(isset($errors['file'])) echo $errors['file']?>
                                                     <div style="float:right;">
                                            
                                            <button type="submit" name="addbarbershop" class="btn btn-primary">edit  Barbershopy</button>
                                            <button type="reset" class="btn btn-danger">Cancel</button>
                                        </div>
                                            


                                    </div>
                                    </form>
                                    <!-- <?php
                                }
                            }
                        }
                                      ?> -->

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
include('include/footer.php');}

?>

<script>
   $('#delete').click(function()
   {
    return confirm('are you shure !!');
   }
   );

</script>
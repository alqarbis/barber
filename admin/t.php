if($_SERVER["REQUEST_METHOD"]="POST")
                            {
                                if(isset($_POST['addbarbershop']))
                                {
                                    // $id =$_POST['id'];
                                    $name =trim($_POST['name']);
                                    $address=trim($_POST['address']);
                                    $imges =$_FILES['file'];
                                    $imge_name=$imges['name'];
                                    $imge_type=$imges['type'];
                                    $imge_tmp_name=$imges['tmp_name'];
                                    $extensions =array('jpg' ,'gif' ,'peng');
                                    $filee =explode('.' ,$imge_name);
                                    $file_extensions =strtolower(end($filee));
                                    $errors =array();
                                    if(!in_array($extensions ,$file_extensions))
                                    {
                                        $errors['file']="<div style='color:red'> file extension not valid<div>";
                                    }


                                    

                                   
                                    if(is_numeric($name))
                                    {
                                            $errors['name']="name must be string";
                                    }
                                   if(empty($errors))
                                   {
                                    if(move_uploaded_file($imge_tmp_name ,"/upload".$imge_name));
                                    {
                                    $sql ="INSERT INTO shops( `name`, `address` ,'imge') VALUES(? ,? ,?) ";
                                    $stm =$conn->prepare($sql);
                                    $stm->execute(array($name ,$address ,));
                                      if($stm->rowcount())
                                      {
                                        echo "<div class='alert alert-success'>row inserted</div>";
                                      }
                                      else{
                                        echo "<div class='alert alert-danger'>row not  inserted</div>";
                                      }
                                    }
                                    else{
                                        echo "<div class='alert alert-danger'>not uploaded file</div>";
                                    }
                                   }
                                }
                                }





                            ?>
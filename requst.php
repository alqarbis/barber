<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <scrip>

    </scrip>
  
</head>

<body>
    <?php
          require('admin/dbconnect.php');
if(isset($_POST['login']))
{
$idshop=$_POST['idshop'];




if(empty($idshop) )
{
echo "fileds are required";
}
else{

 $sql="SELECT  * from shops where shop_id=?";
 $stm=$conn->prepare($sql);
 $stm->execute(array($idshop));
 
 if($stm->rowcount( )==1)
 {
    foreach($stm->fetchall() as $row)
    {
   $id=$row['shop_id'];
}
    
}
}
}

?>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="POST">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="idshop" class="login__input" placeholder="parcode of shopl">
                    </div>

                    <button  class="button login__submit">
                        <input type="submit" value="login" name="login"></a>
                         
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <p class="button login__submit">
                <a href="checkstatusshop.php?action=edit&id=<?php echo $id ?>">go to page of requst</a>
                </p>
                <div class="social-login">
                    <h3>log in via</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

</html>


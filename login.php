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
$name=$_POST['name'];


$pass =@($_POST['pass']);

if(empty($name) | empty($pass))
{
echo "fileds are required";
}
else{

 $sql="SELECT  * from users where emial=:m  AND password=:p";
 $stm=$conn->prepare($sql);
 $stm->execute(array("m"=>$name,"p"=>$pass));
 
 if($stm->rowcount( )==1)
 {
    $_SESSION['user_info']=$stm->fetch();
     if($_SESSION['user_info']['role_id']==1)
     {
            header("location:admin/index.php");
     }
    elseif($_SESSION['user_info']['role_id']==2)
    {
        header("location:requst.php");
    }else

    {
        header("location:checkstatus.php");
    }

 }
 else
 {
    echo "<div style='background-color: yellow; color:black; height:60px; text-align: center;' class='aleart alert-danger'>email or password are wrong</div>";
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
                        <input type="text" name="name" class="login__input" placeholder="User name / Email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="pass" class="login__input" placeholder="Password">
                    </div>
                    <button  class="button login__submit">
                         <input type="submit" value="login" name="login">
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
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


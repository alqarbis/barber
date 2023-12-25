
<?php
session_start();
include('inc/header.php');
require('admin/dbconnect.php');

?>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>enter reservation detail</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      <?php
    if(isset($_GET['action'] ,$_GET['idshop'])&& $_GET['action']=='reserve')
    {
      
       $idshop=$_GET['idshop'] ;
       if(isset($_POST['login'])){
         $namfull=trim($_POST['namefull']);
         $name=trim($_POST['name']);
         $pass=trim($_POST['pass']);
         $date=$_POST['date'];
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
$iduser=$_SESSION['user_info']['id'];
$sql="INSERT INTO reservation ( data_to_reserv, shop_id, user_id) VALUES (? ,? ,? )" ;
$stm=$conn->prepare($sql);
$stm->execute(array($date , $idshop ,$iduser));
if($stm->rowcount( )==1)
{
   echo "<div class='alert alert-success'>you have reserve a date  at $date</div>"; 
}
else
{
   echo "<div class='alert alert-danger'>you have reserve a date </div>"; 
}

}
else
{

$errors=array();
if(is_numeric($name))
{
    $errors['name']="must be string";
}
if(empty($errors))
{
    $sql="INSERT INTO users ( `name`, `emial`, `password`, `role_id`, `active`) VALUES (? ,? ,?,? ,?);";
    $stm =$conn->prepare($sql);
    $stm->execute(array($namfull ,$name ,$pass ,'3' ,'1'));
    if($stm->rowcount())
    {
      $sql="select id from users where emial=:email";
      $stm=$conn->prepare($sql);
      $stm->execute(array("email"=>$name));
      if($stm->rowcount( )==1)
      {
         
      $_SESSION['user_info']=$stm->fetch();
      $iduser=$_SESSION['user_info']['id'];
      $sql="INSERT INTO reservation ( data_to_reserv, shop_id, user_id) VALUES (? ,? ,? )" ;
      $stm=$conn->prepare($sql);
      $stm->execute(array($date , $idshop ,$iduser));
      if($stm->rowcount( )==1)
      {
         echo "<div class='alert alert-success'>you have reserve a date at $date</div>"; 
      }
      else
      {
         echo "<div class='alert alert-danger'>you have reserve a date </div>"; 
      }

      

      }

////////
    }
    else{
        echo "<div class='alert alert-danger'> the is a problem</div>";
    }
}
}
}
}
} 
?>
 

      <section class="why_section layout_padding">
         <div class="container">
         
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <div class="full">
                     <form action="" method="POST">
                        <fieldset>
                           <input  type="text" placeholder="Enter your full name" name="namefull" required />

                           <input  type="email" placeholder="Enter your email address" name="name" required />
                           <input  type="text" placeholder="Enter your password" name="pass" required />

                           <input type="datetime-local" name="date" id="">
                           
                           <input type="submit" value="Submit" name="login" />
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end why section -->
      <!-- arrival section -->
      <section class="arrival_section">
         <div class="container">
            <div class="box">
               <div class="arrival_bg_box">
                  <img src="images/arrival-bg.png" alt="">
               </div>
               <div class="row">
                  <div class="col-md-6 ml-auto">
                     <div class="heading_container remove_line_bt">
                        <h2>
                           #NewArrivals
                        </h2>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px;">
                        Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
                     </p>
                     <a href="">
                     Shop Now
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end arrival section -->
      <?php
include('inc/footer.php');

?>
    
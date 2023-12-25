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
                     <h3>accept reservation detail</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->

<?php
   
       
    
    require('admin/dbconnect.php');
    if(isset($_GET['action'] ,$_GET['id'])&& $_GET['action']=='edit')
    {
        echo $_GET['action'];
        
       $id=$_GET['id'] ;
       $sql="select * from reservation where re_id=:res_id";
       $stm=$conn->prepare($sql);
       $stm->execute(array("res_id"=>$id));
       if($stm->rowcount()==1)
       {
        foreach($stm->fetchall() as $row)
        {
            
            if(isset($_POST['login']))
            {
               $accpt=$_POST['accpetion'];
                $sql="update  reservation set acception=? where re_id=?";
                $stm=$conn->prepare($sql);
                $stm->execute(array($accpt ,$id));
                if($stm->rowcount()==1)
                {
                 echo "<script>
                 alert('accepted')
                 window.open('login.php','_self');
                 </script>";  }
                 else{
                     echo "<div class='alert alert-danger'>requst  not accepted</div>";
                 }
             }
          }
 
     
         }
         else{
         
         
             echo "<div class='alert alert-danger'>there is probelm </div>"; 
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
                            <input value="requst has been accpeted"  name="accpetion" id="">
                           
                           <input type="submit" value="accept" name="login" />
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
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
                     <h3>Product Grid</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>Barber Shops </span>
               </h2>
             <?php
               $sql="select * from shops";
               $stm =$conn->prepare($sql);
               $stm->execute();
               if($stm->rowCount())
               {
                  foreach($stm->fetchall() as $row)
                  {
                      $id=$row['shop_id'];
                     $name=$row['name'];
                      $address=$row['address'];
                     $img=$row['imge'];
              


?>
            </div>
            <div class="row" >
               <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="" class="option1">
                           <?php echo $address ; ?>
                           </a>
                           <a href="reserve.php?action=reserve&idshop=<?php echo $id ?>" class="option2">
                           take your seat 
                           </a>
                        </div>
                     </div>
                     <div class="img-box">
                        <img  src="admin/upload/<?php echo $img ; ?>" style='background-image: cover ;' alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                        <?php echo $name ; ?>
                        </h5>
                        <h6>
                        <a href="reserve.php?action=reserve&idshop=<?php echo $id ?>" class='btn btn-success' >Rerserve</a>
                        </h6>
                     </div>
                  </div>
             
               </div> 
               </div>   
               <?php
                  }
               }
               else{
                  echo "<div class='alert alert-danger>no connection </div>";
               }

               ?>     
            <div class="btn-box">
               <a href="">
               View All products
               </a>
            </div>
         </div>
      </section>
      <!-- end product section -->
      <?php
include('inc/footer.php');

?>
      
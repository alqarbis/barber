<?php
session_start();
if(isset($_SESSION['user_info']))
{
   

require('admin/dbconnect.php');

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Responsive Table + Detail View</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<?php
$id=$_SESSION['user_info']['id'];
$name=$_SESSION['user_info']['name'];

$sql="select name , re_id ,data_to_reserv ,acception from shops s join reservation  r on (s.shop_id=r.shop_id) where user_id=:uid";
$stm=$conn->prepare($sql);
$stm->execute(array("uid"=>$id));
if($stm->rowcount())
{
  foreach($stm->fetchall() as $row)
  {
    $nameshop=$row['name'];
    $date=$row['data_to_reserv'];
    
    $re_id=$row['re_id'];
    $accp=$row['acception'];

          

   
?>
<h1>
  
  reservation
</h1>
<p>
  chechk your reservation modify or remove
</p>
<main>
  <table>
    <thead>
      <tr>
        <th>
          Name
        </th>
        <th>
          barber shop name
        </th>
        <th>
          date
        </th>
        <th>
          acception
        </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan='3'>
          Year: 2014
        </th>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td data-title='Provider Name'>
          <?php echo $name; ?>
        </td>
        <td data-title='Provider Name'>
        <?php echo $nameshop; ?>
        </td>
        <td data-title='Provider Name'>
        <?php echo $date; ?>
        </td>
        <td data-title='Provider Name'>
        <?php 
        if($accp=="")
        {
          echo 'requst in waiting';
        }else{
          echo $accp ;
        }
         ?>
        </td>
       
        <td class='select'>
          <a class='button' href='editreserve.php?action=edit&id=<?php echo $re_id ;?>'>
            change date
          </a>
        </td>
      </tr>
     
    </tbody>
  </table>
  <?php
}

}
else{
  echo "<div style='background-color: yellow; color:black; height:60px; text-align: center;' class='aleart alert-danger'>there isnot info about this clint</div>";
 }

 ?>
  <div class='detail'>
    <div class='detail-container'>
      <dl>
        <dt>
          Provider Name
        </dt>
        <dd>
          John Doe
        </dd>
        <dt>
          E-mail
        </dt>
        <dd>
          email@example.com
        </dd>
        <dt>
          City
        </dt>
        <dd>
          Detroit
        </dd>
        <dt>
          Phone-Number
        </dt>
        <dd>
          555-555-5555
        </dd>
        <dt>
          Last Update
        </dt>
        <dd>
          Jun 20 2014
        </dd>
        <dt>
          Notes
        </dt>
        <dd>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
        </dd>
      </dl>
    </div>
    <div class='detail-nav'>
      <button class='close'>
        Close
      </button>
    </div>
  </div>
</main>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
<?php

}
?>
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <h1 class="heading">category</h1>

   <div class="box-container">

   <?php
      $category = $_GET['category'];

      $select_products = $conn->prepare("SELECT * FROM `products` WHERE sub_category = :category");
      $select_products->bindParam(':category', $category, PDO::PARAM_STR);
      $select_products->execute();

      if ($select_products->rowCount() > 0) {
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

   <form action="" method="post" class="box">
   <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
   <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     
                     <input type="hidden" name="discount" value="<?= $fetch_product['discount']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name">
                        <?= $fetch_product['name']; ?>
                     </div>

                     <?php
                     if ($fetch_product['discount'] !== null && $fetch_product['discount'] !== 0) {
                        echo '<div class="discount-div">';
                        echo '<span>' . $fetch_product['discount'] . '%</span><span>Off</span>';
                        echo '</div>';
                     }
                     ?>


                     <div class="flex">
                        <div class="price"> 
                        <?php
                           if ($fetch_product['discount'] !== null && $fetch_product['discount'] !== 0) {
                              echo '<span class="og-price">₹ ' . $fetch_product['price'] . '  </span>';
                              // echo '<span>₹ ' . $fetch_product['price'] - $fetch_product['price']*$fetch_product['discount']/100 . '</span>';
                              echo '<span> &nbsp ₹ ' . ($fetch_product['price'] - $fetch_product['price'] * $fetch_product['discount'] / 100) . '</span>';

                           }else{
                              echo '<span>₹ ' . $fetch_product['price'] . '</span>';
                           }
                        ?>
                        
                        <!-- <span class="og-price">₹  $fetch_product['price']; ?></span> -->
                        <!-- <span>₹ </span><$fetch_product['price'] - $fetch_product['price']*$fetch_product['discount']/100; ?><span></span> -->
                           
                     </div>
                        
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>

   
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>
   <div class="parent-categories-nav">


      <div class="categories-nav">

         <span class="nav-category"> Fresh Produce</span>
         <span class="nav-category">Pantry Staples</span>
         <span class="nav-category">Beverages</span>
         <span class="nav-category">Snacks</span>
         <span class="nav-category">Dairy and Eggs</span>
         <span class="nav-category">Fish and Meat</span>
         <span class="nav-category">Personal Care</span>
      </div>


      <div class="sub_categories">
         <div class="sub-list">

         </div>
      </div>
      <!-- Add more subcategory sections for other categories... -->
   </div>


   <div class="home-bg">

      <section class="home">

         <div class="swiper home-slider">

            <div class="swiper-wrapper">

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/slider.png" alt="">
                  </div>
                  <div class="content">
                     
                     <span>GROCEREASE</span>
                     <h3>Serving fresh ingredients</h3>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/h.jpg" alt="">
                  </div>
                  <div class="content">
                     <span>upto 50% off</span>
                     <h3>on vegetables</h3>
                     <a href="category.php?category=Vegetables" class="btn">Shop now</a>
                  </div>
               </div>

               <!-- <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/h1.jpg" alt="">
                  </div>
                  
               </div> -->

               <!-- <div class="swiper-slide slide"> -->
               <!-- <div class="image">
            <img src="images/s1.jpg" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest headsets</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div> -->
               <!-- </div> -->

            </div>

            <div class="swiper-pagination"></div>

         </div>

      </section>

   </div>

   <section class="category">

      <h1 class="heading">DAILY NEEDS</h1>

      <div class="swiper category-slider">

         <div class="swiper-wrapper">

            <a href="category.php?category=Fruits" class="swiper-slide slide">
               <img src="images/frulogo.avif" alt="">
               <h3>Fruits</h3>
            </a>

            <a href="category.php?category=Vegetables" class="swiper-slide slide">
               <img src="images/veglogo.jpg" alt="">
               <h3>Vegetables</h3>
            </a>

            <a href="category.php?category=Milk" class="swiper-slide slide">
               <img src="images/dairylogo.jpeg" alt="">
               <h3>Dairy</h3>
            </a>

            <!-- <a href="category.php?category=mouse" class="swiper-slide slide">
               <img src="images/bevarages.avif" alt="">
               <h3>Beavarages</h3>
            </a> -->

            <!-- <a href="category.php?category=fridge" class="swiper-slide slide">
      <img src="images/snacks.jpg" alt="">
      <h3>Snacks</h3>
   </a> -->

            <!-- <a href="category.php?category=washing" class="swiper-slide slide">
               <img src="images/icon-6.png" alt="">
               <h3>washing machine</h3>
            </a> -->

            <!-- <a href="category.php?category=smartphone" class="swiper-slide slide">
      <img src="images/icon-7.png" alt="">
      <h3>smartphone</h3>
   </a> -->

            <!-- <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/icon-8.png" alt="">
      <h3>watch</h3>
   </a> -->

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="home-products">

      <h1 class="heading">latest products</h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id DESC LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
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
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>
         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>









   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
    function validateForm() {
        var qtyInput = document.querySelector('.qty');
        if (qtyInput && qtyInput.value != 5) {
            alert("Quantity must be 5.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>



   <script>

      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         autoplay: {
            delay: 3000, // Delay between slides in milliseconds
            disableOnInteraction: false, // Continue sliding even when the user interacts with the slider
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });



      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
         autoplay: {
            delay: 4000, // Delay between slides in milliseconds
            disableOnInteraction: false, // Continue sliding even when the user interacts with the slider
         },
      });

   </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   




   <!-- <script>$(document).ready(function() {
   const subCategories = {
      'Fresh Produce': ['Fruits', 'Vegetables'],
      'Pantry Staples': ['Rice', 'Flours', 'Pulses', 'Edible Oil', 'Salt & Sugar'],
      'Beverages': ['Tea', 'Coffee', 'Water', 'Fruit Juices', 'Energy and Soft drinks'],
      'Snacks': ['Biscuits & Cookies', 'Noodles, Pasta', 'Chocolates', 'Snacks and Namkeens', 'Indian Mithai'],
      'Dairy and Eggs': ['Milk', 'Eggs', 'Cheese'],
      'Fish and Meat': ['Fish', 'Chicken', 'Beef', 'Pork'],
      'Personal Care': ['Shampoo', 'Soap', 'Toothpaste', 'Body Lotion', 'Deodorant'],
      // Add more categories and subcategories here...
   };

   $('.nav-category, .sub_categories').hover(
      function() {
         const category = $(this).text().trim();
         const subCategoryList = subCategories[category];
         const subList = $('.sub-list');
         
         subList.empty();
         if (subCategoryList) {
            subCategoryList.forEach(subCategory => {
               subList.append(`<li><i class="fas fa-angle-right arrow"></i>${subCategory}</li>`);
            });
            $('.sub_categories').show();
         } else {
            // $('.sub_categories').hide();
         }
      },
      function() {
         $('.sub_categories').hide();
      }
   );
});
</script> -->

<script>
    const subCategories = {
      'Fresh Produce': ['Fruits', 'Vegetables'],
      'Pantry Staples': ['Rice', 'Flours', 'Pulses'],
      'Beverages': ['Tea', 'Coffee', 'Water',  'Energy and Soft drinks'],
      'Snacks': ['Biscuits and Cookies',  'Chocolates',  'Indian Mithai'],
      'Dairy and Eggs': ['Milk', 'Eggs', 'Cheese'],
      'Fish and Meat': ['Fish', 'Chicken'],
      'Personal Care': ['Shampoo', 'Soap', 'Toothpaste', 'Body Lotion', 'Deodorant'],
      // Add more categories and subcategories here...
    };

    $('.nav-category').hover(function() {
    const selectedCategory = $(this).text().trim();
    const subCategoriesList = subCategories[selectedCategory];
    const subList = $('.sub-list');

    if (subCategoriesList) {
      const subListHTML = subCategoriesList.map(subCategory => '<a href="category.php?category=' +subCategory+ '"> <i class="fas fa-angle-right arrow"></i> <span>' + subCategory + '</span></a>').join('');

      console.log(subListHTML)
      subList.html(subListHTML);
      $('.sub-list').css('display', 'block');
    } else {
      subList.empty();
      $('.sub-list').css('display', 'none');
    }
  });

  $('.sub-list').hover(function() {
    $(this).css('display', 'block');
  }, function() {
    $(this).css('display', 'none');
  });
  </script>
</body>
</html>





</body>

</html>
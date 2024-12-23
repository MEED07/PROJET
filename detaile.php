<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/M.css"> 
</head>
<body>
    <?php 
        include "include/nav.php";  
        include "include/db.php";   

        
        $query = "SELECT * FROM produit WHERE id_categorie = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="back-video">
    <img src="images/phone.jpg" alt="Background Image">
    </div>


    <section class="products-slider">
  <div class="slider-heading">
    <h3 style="padding-top:2%">All Models. <span>Take your pick.</span></h3>
  </div>

  <div class="product-container">
    <ul class="autoWidth cs-hidden">
      <?php foreach ($products as $product): ?>
        <li class="item-a">
          <div class="product-box">
            <a href="#" class="product-link" 
               data-id="<?= $product['id']; ?>" 
               data-libelle="<?= htmlspecialchars($product['libelle']); ?>"
               data-description="<?= htmlspecialchars($product['description']); ?>"
               data-prix="<?= number_format($product['prix'], 2); ?>"
               data-image="<?= htmlspecialchars($product['image']); ?>"
               data-year="<?= htmlspecialchars($product['date_creation']); ?>"
               data-processor="A14 Bionic">
              <strong><?= htmlspecialchars($product['libelle']); ?></strong>
              <img alt="<?= htmlspecialchars($product['libelle']); ?>" src="upload/produit/<?= htmlspecialchars($product['image']); ?>" width="50">
              <div class="available-colors"></div>
              <div class="buy-price">
                <p>From $<?= number_format($product['prix'], 2); ?> or $41.62/mo. for 24 mo. before trade-in*</p>
                <a href="#" class="buy-btn">Buy</a>
              </div>
            </a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>





<div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
      <div class="product-modal-content">
         <button type="button" class="product-modal-close-btn" onclick="closeModal()">×</button>
         <div class="product-details-thumb-wrapper">
            <nav>
               <div class="nav-tabs">
                  <button class="nav-link active" onclick="openTab('tab1')">
                     <img src="img_phone/01.png" alt="Product Thumbnail 1">
                  </button>
                  <button class="nav-link" onclick="openTab('tab2')">
                     <img src="img_phone/01.png" alt="Product Thumbnail 2">
                  </button>
                  <button class="nav-link" onclick="openTab('tab3')">
                     <img src="img_phone/01.png" alt="Product Thumbnail 3">
                  </button>
                  <button class="nav-link" onclick="openTab('tab4')">
                     <img src="img_phone/01.png" alt="Product Thumbnail 4">
                  </button>
               </div>
            </nav>
            <div class="tab-content">
               <div id="tab1" class="tab-pane active">
                  <img src="img_phone/01.png" alt="Main Product Image 1">
               </div>
               <div id="tab2" class="tab-pane">
                  <img src="img_phone/01.png" alt="Main Product Image 2">
               </div>
               <div id="tab3" class="tab-pane">
                  <img src="img_phone/01.png" alt="Main Product Image 3">
               </div>
               <div id="tab4" class="tab-pane">
                  <img src="img_phone/01.png" alt="Main Product Image 4">
               </div>
            </div>
         </div>
         <div class="product-details-wrapper">
            <h3 class="product-title">Samsung Galaxy A8 Tablet</h3>
            <div class="price-wrapper">
               <span class="old-price">$320.00</span>
               <span class="new-price">$236.00</span>
            </div>
            <div class="product-variation">
               <h4>Color:</h4>
               <button class="color-btn" style="background-color: #F8B655;" onclick="changeColor('#F8B655')">Yellow</button>
               <button class="color-btn active" style="background-color: #CBCBCB;" onclick="changeColor('#CBCBCB')">Gray</button>
               <button class="color-btn" style="background-color: #494E52;" onclick="changeColor('#494E52')">Black</button>
               <button class="color-btn" style="background-color: #B4505A;" onclick="changeColor('#B4505A')">Brown</button>
            </div>
            <div class="product-action">
               <div class="quantity">
                  <button onclick="decreaseQuantity()">-</button>
                  <input type="text" id="quantity" value="1" />
                  <button onclick="increaseQuantity()">+</button>
               </div>
               <button class="add-to-cart-btn" onclick="addToCart()">Add To Cart</button>
               <button class="buy-now-btn" onclick="buyNow()">Buy Now</button>
            </div>
         </div>
      </div>
   </div>
</div>



<script>
   let activeTab = 'nav-1';
let quantity = 1;

function openTab(tabId) {
   document.querySelector(`#${activeTab}`).classList.remove('active');
   document.querySelector(`#${tabId}`).classList.add('active');
   activeTab = tabId;
}

function closeModal() {
   // Logic to close the modal
}

function changeColor(color) {
   // Logic to change the product color
}

function increaseQuantity() {
   quantity++;
   document.getElementById('quantity').value = quantity;
}

function decreaseQuantity() {
   if (quantity > 1) {
      quantity--;
      document.getElementById('quantity').value = quantity;
   }
}

function addToCart() {
   alert('Product added to cart');
}

function buyNow() {
   alert('Proceeding to buy');
}

</script>
    
</body>
</html>
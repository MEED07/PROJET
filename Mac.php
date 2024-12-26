<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
    <link rel="stylesheet" href="style/P.css">
    <script defer src="dark-mode.js"></script>
  
</head>
<body>

<?php 

include "include/nav.php";
include "include/db.php"; 

$query = "SELECT * FROM produit WHERE id_categorie = 13";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="back-video"style="
    width: 100%; 
    height:670px; 
    ">
    <img src="img/MacBook.png" alt="">
</div>

<section class="products-slider">
    <div class="slider-heading">
        <h3 style="padding-top:2%">All Models.<span>Take your pick.</span></h3>
    </div>

    <div class="product-container">
        <ul class="autoWidth cs-hidden">
            <?php foreach ($products as $product): ?>
                <li class="item-a">
                    <div class="product-box">
                       <div class="icon">
                       <button class="wishlist-btn" data-product-id="<?= $product['id']; ?>">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                        <button class="add-to-cart-btn" 
                                data-product-id="<?= $product['id']; ?>"
                                data-product-name="<?= $product['libelle']; ?>">
                                <i class="fas fa-shopping-cart"></i>
                        </button>
                       </div>
                        <a href="#" class="product-link" 
                           data-id="<?= $product['id']; ?>" 
                           data-libelle="<?= ($product['libelle']); ?>"
                           data-description="<?= ($product['description']); ?>"
                           data-prix="<?= number_format($product['prix'], 2); ?>"
                           data-image="<?= ($product['image']); ?>"
                           data-year="<?= ($product['date_creation']); ?>"
                           data-processor="A14 Bionic" 
                        >
                            <strong><?= ($product['libelle']); ?></strong>
                            <img alt="<?= ($product['libelle']); ?>" src="upload/produit/<?= ($product['image']); ?>" alt="Image" width="50">

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


<!-- Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="modal-body" style="display: flex; align-items: flex-start;">
            <div class="image-container">
                <img src="" alt="Produit" id="modal-product-image" class="modal-product-image" style="width: 300px; margin-right: 20px;" />
                <div class="color-options"></div>
            </div>
            <div class="product-info">
                <h2 id="modal-product-name" class="modal-product-name"></h2>
                <p id="modal-product-description" class="modal-product-description"></p>
                <p><strong>Price:</strong> $<span id="modal-product-price" class="modal-product-price"></span></p>
                <p><strong>Year:</strong> <span id="modal-product-year" class="modal-product-year"></span></p>
                <p><strong>Processor:</strong> <span id="modal-product-processor" class="modal-product-processor"></span></p>
                <p><strong>Camera:</strong> <span id="modal-product-camera" class="modal-product-camera"></span></p>
                <button id="modal-buy-btn" class="modal-buy-btn">Buy</button>
                <button class="wishlist-btn modal-buy-btn" data-product-id="<?= $product['id']; ?>">
                            ajoutez-le 
                        </button>
                        <button class="add-to-cart-btn" 
                                data-product-id="<?= $product['id']; ?>"
                                data-product-name="<?= $product['libelle']; ?>">
                                <i class="fas fa-shopping-cart"></i>
                        </button>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightslider/dist/js/lightslider.min.js"></script>




<script>

document.querySelectorAll('.product-link').forEach(function(productLink) {
    productLink.addEventListener('click', function(event) {
        event.preventDefault();

        
        const productName = this.getAttribute('data-libelle');
        const productDescription = this.getAttribute('data-description');
        const productPrice = this.getAttribute('data-prix');
        const productImage = this.getAttribute('data-image');
        const productYear = this.getAttribute('data-year');
        const productProcessor = this.getAttribute('data-processor');
        const productCamera = this.getAttribute('data-camera'); 

        // Remplir les données dans le modal
        document.getElementById('modal-product-name').textContent = productName;
        document.getElementById('modal-product-description').textContent = productDescription;
        document.getElementById('modal-product-price').textContent = productPrice;
        document.getElementById('modal-product-year').textContent = productYear;
        document.getElementById('modal-product-processor').textContent = productProcessor;
        document.getElementById('modal-product-camera').textContent = productCamera || 'N/A'; // Valeur par défaut si aucune donnée de caméra
        document.getElementById('modal-product-image').src = "upload/produit/" + productImage;

        // Afficher le modal
        document.getElementById('productModal').style.display = 'block';
    });
});

// Fonction pour fermer la modale
function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

// Fermeture de la modale si on clique en dehors
window.onclick = function(event) {
    if (event.target === document.getElementById('productModal')) {
        closeModal();
    }
}

</script>

    <?php 
 
    include "include/footer.php";
    ?>

    
    <script>
        $(document).ready(function () {
           
            $('.autoWidth').lightSlider({
                autoWidth: true,
                onSliderLoad: function () {
                    $('.autoWidth').removeClass('cs-hidden');
                }
            });
        });

// When opening the modal
function openModal() {
    const modal = document.getElementById('productModal');
    modal.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

// When closing the modal
function closeModal() {
    const modal = document.getElementById('productModal');
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Replace existing click event listeners with these
document.querySelectorAll('.product-link').forEach(function(productLink) {
    productLink.addEventListener('click', function(event) {
        event.preventDefault();
        // ... (existing modal population code)
        openModal(); // Use the new openModal function
    });
});

// Update window click event
window.onclick = function(event) {
    const modal = document.getElementById('productModal');
    if (event.target === modal) {
        closeModal();
    }
}




const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            
            // AJAX request to add to wishlist
            fetch('add_to_wishlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to wishlist!');
                } else {
                    alert('Failed to add product to wishlist.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding to wishlist.');
            });
        });
    });



    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + productId + '&quantity=1'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added to cart!');
                // Optional: Update cart icon/count
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});



    </script>





<style>
      /* Dark Mode Styles */
body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}
body.dark-mode .products-slider {
    background-color: #121212;
    color: #ffffff;
}
body.dark-mode .slider-heading h3, span  {
   
    color: #ffffff;
}
body.dark-mode .slider-heading  span  {
   
   color: #ffffff;
}
body.dark-mode .product-box {
    background-color:rgb(255, 255, 255);
    color : rgb(248, 248, 248);
    
}
/* .dark-mode .product-box  data-libelle   {
    background-color:rgb(238, 230, 230);
    color : rgb(248, 248, 248); */
    
    


body.dark-mode .icon .wishlist-btn  {
    background-color:rgb(255, 255, 255);
    color :rgb(0, 0, 0);
}
body.dark-mode .icon .add-to-cart-btn  {
    background-color:rgb(255, 255, 255);
    color :rgb(0, 0, 0);
}

body.dark-mode a {
    color: #1e90ff;
}



       </style>
</body>
</html>
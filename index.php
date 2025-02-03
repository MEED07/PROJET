<?php 

include "include/nav.php";
include "include/db.php"; 

    // التحقق من وجود رسالة في معلمات URL وعرضها
    if (isset($_GET['message'])) {
        echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    
$query = "SELECT * FROM categorie";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="dark-mode.js"></script>

    <link rel="stylesheet" href="style/index.css">
</head>




<body>


    
    <div class="back-video">
            <video autoplay loop muted play-inline >
                <source src="./Videos/y2mate.com - iPhone Xr Official Trailer_1080p(1).mp4"  type="video/mp4">  
            </video>
        </div>
        <div class="section">
            <div class="titles">
                <h1> Our categorie.  </h1>
            </div>
            
            
            </div>
            <div class="products">
    <?php foreach ($categories as $categorie) : ?>
        <?php
        $link = "#"; 
        switch ($categorie['id']) {
            case 1:
                $link = "phone.php";
                break;
            case 12:
                $link = "ipad.php"; 
                break;
            case 13:
                $link = "mac.php"; 
                break;
            case 14:
                $link = "airpods.php"; 
                break;
            case 15:
                $link = "watch.php"; 
                break;
        }
        ?>
        <a href="<?= $link; ?>" style="text-decoration:none;">
            <div class="product">
                <img 
                    alt="<?= htmlspecialchars($categorie['libelle']); ?>" 
                    src="upload/categorie/<?= htmlspecialchars($categorie['icone']); ?>" 
                    alt="Image">
                <?= $categorie['libelle'] ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>

        <div class="card-container">
            <h1>The latest. Take a look at what’s new right now. </h1>
            <div class="cards">
                 <div class="card" onclick="window.location.href='ipad.php'">
                    <span>LIMITED TIME OFFER</span>
                    <h1>Save on Mac or iPad for university.</h1>
                    <p>You’ll also save on Apple Pencil, Magic Keyboard for iPad</p>
                    <img style="height: 245px;" src="./images/blue-6.webp" alt="macbook">
                 </div>
                 <div class="card" onclick="window.location.href='mac.php'">
                    <span>LIMITED TIME OFFER</span>
                    <h1>MacBook Air 15. Buy Now </h1>
                    <p>You’ll also save on Apple Pencil, Magic Keyboard for iPad</p>
                    <img src="./images/Macbook-laptop.png" alt="macbook">
                 </div>
                 <div  class="card" id="cardblack" onclick="window.location.href='phone.php'">
                    <span>LIMITED TIME OFFER</span>
                    <h1>iPhone 16 Pro . Buy Now</h1>
                    <p>You’ll also save on Apple Pencil, Magic Keyboard for iPad, get 20% off AppleCare+, and more.²</p>
                    <img style="height: 190px;" src="./images/iPhone_16_Pro_Black_Titanium_Hero_Vertical_Screen__WWEN_420e94fd-3a92-420d-b797-771c759398e6.webp" alt="iphone">
                 </div>
            </div>
        </div>
        <div class="apple-events">
            <h1>
                Let's Explore Apple Events
                photos photos</h1>
                <div class="event-pictures">
                    <img src="./images/APPLE-EVENT-SEP-2023-WALLPAPER-mod1.jpg" alt="events">
                    <img src="./images/apple-event-wallpaper-iphone.png" alt="events">
                </div>
        </div>
        <div class="section-3">
            <img src="./images/iphone-14-mockup-png-890-download-96223.png" alt="phone">
            <h1> iphone16
                iPhone 16 Pro Leather Case <br>
                with MagSafe - Ink
                </h1>
        </div>
       <?php 
       include "include/footer.php"
       
       ?>

       <style>
       /* Dark Mode Styles */
body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}
a {
    color:rgb(0, 0, 0);
}
body.dark-mode a {
    color:rgb(241, 244, 248);
}

.dark-mode .card {
        background-color:rgb(255, 255, 255);
        color: #000000;
    }

    #cardblack   {
    background-color: #121212;
    color: #ffffff;
} 
.dark-mode #cardblack {
        background-color:rgb(255, 255, 255);
        color: #000000;
    }
       </style>
</body>
</html>
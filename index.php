<?php 

include "include/nav.php";
include "include/db.php"; 

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
        <a href="<?= $link; ?>" style="text-decoration:none;color:black">
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
                 <div class="card">
                    <span>LIMITED TIME OFFER</span>
                    <h1>Save on Mac or iPad for university.</h1>
                    <p>You’ll also save on Apple Pencil, Magic Keyboard for iPad</p>
                    <img src="./images/Apple_new-macbookair-wallpaper-screen_11102020_big.jpg.large.jpg" alt="macbook">
                 </div>
                 <div class="card">
                    <span>LIMITED TIME OFFER</span>
                    <h1>MacBook Air 15. Buy Now </h1>
                    <p>You’ll also save on Apple Pencil, Magic Keyboard for iPad</p>
                    <img src="./images/Apple-WWDC23-MacBook-Air-15-in-hero-230605.jpg.news_app_ed.jpg" alt="macbook">
                 </div>
                 <div style="background: black;" class="card">
                    <span style="color: white;" >LIMITED TIME OFFER</span>
                    <h1 style="color: white;" >MacBook Air 15. Buy Now</h1>
                    <p style="color: white;">You’ll also save on Apple Pencil, Magic Keyboard for iPad, get 20% off AppleCare+, and more.²</p>
                    <img style="height: 180px;" src="./images/gsmarena_001.jpg" alt="iphone">
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
            <h1> iphone14
                iPhone 14 Pro Leather Case <br>
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

body.dark-mode a {
    color: #1e90ff;
}

.dark-mode .card {
        background-color:rgb(145, 141, 141);
        color: #000000;
    }
       </style>
</body>
</html>
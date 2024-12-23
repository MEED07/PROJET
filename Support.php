<?php

include "include/nav.php";
include "include/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Support</title>
    <script defer src="dark-mode.js"></script>
    
</head>
<body>
    <header>
        <h1>Apple Support</h1>
    </header>
    <main class="support-grid">
        <div class="support-box">
            <img src="images\69890.png" alt="Contact Us">
            <h3>Contact Us</h3>
            <p>Have an issue? We're here to help.</p>
            <a href="contact.php">Learn More</a>
        </div>
        <div class="support-box">
            <img src="images\Andres-Apple-Logo.png" alt="Device Repair">
            <h3>Device Repair</h3>
            <p>Professional repair services for Apple devices.</p>
            <a href="repair.html">Learn More</a>
        </div>
        <div class="support-box">
            <img src="images\untitled_folder_Subscription-512.webp" alt="Billing & Subscriptions">
            <h3>Billing & Subscriptions</h3>
            <p>Manage your subscriptions with ease.</p>
            <a href="billing.html">Learn More</a>
        </div>
        <div class="support-box">
            <img src="images\3681701.png" alt="Order Tracking">
            <h3>Order Tracking</h3>
            <p>Track your orders and deliveries easily.</p>
            <a href="tracking.php">Learn More</a>
        </div>
    </main>
    <?php
include "include/footer.php";?>
    <footer>
        <p>&copy; 2024 Apple Support. All rights reserved.</p>
    </footer>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    padding-top: 60px;
}
/* Add spacing below the navigation bar */
main {
    margin-top: 80px; /* Adjust this value as needed */
    padding: 20px;
}

/* Header */
header {
    background: linear-gradient(135deg, #000000, #333333);
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

header h1 {
    font-size: 2.5rem;
    font-weight: 700;
}

/* Support Grid */
.support-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Support Boxes */
.support-box {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 25px;
    transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
}

.support-box img {
    width: 100px;
    margin-bottom: 15px;
}

.support-box h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #222;
}

.support-box p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}

.support-box a {
    text-decoration: none;
    color: #007aff;
    font-weight: bold;
    padding: 10px 15px;
    border: 1px solid #007aff;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.support-box a:hover {
    background-color: #007aff;
    color: #fff;
    border-color: #0056cc;
}

.support-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    background-color: #f5f5f5;
}

/* Footer */
footer {
    text-align: center;
    background: #000000;
    color: #ffffff;
    padding: 15px 0;
    margin-top: 30px;
    font-size: 0.9rem;
}
/* dark mod */
body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}
.dark-mode .support-box  {
    background-color: #333333;
    border: 1px solid #333333;
}
.dark-mode .support-box h3  {
    color:rgb(255, 255, 255);
    
}
.dark-mode .support-box p  {
    color:rgb(255, 255, 255);
    
}

.dark-mode .support-box:hover {

    background-color: #f5f5f5;
    
}
.dark-mode .support-box:hover  h3 {

color:rgb(0, 0, 0);

}
.dark-mode .support-box:hover  p {

color:rgb(0, 0, 0);

}
</style>
</body>
</html>

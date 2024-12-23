<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iPhone 16 Pro Page</title>
  <style>
    /* Global Styles */
body {
  margin: 0;
  font-family: 'Helvetica Neue', Arial, sans-serif;
  background-color: #f5f5f7;
  color: #333;
  line-height: 1.6;
}

header {
  background: #1d1d1f;
  padding: 10px 20px;
}

header nav ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  justify-content: center;
}

header nav ul li {
  margin: 0 15px;
}

header nav ul li a {
  text-decoration: none;
  color: #fff;
  font-size: 16px;
  padding: 8px 12px;
}

header nav ul li a:hover {
  background: #333;
  border-radius: 8px;
}

.main-content {
  display: flex;
  padding: 40px 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.product-section {
  display: flex;
  gap: 40px;
  width: 100%;
}

.left-column {
  flex: 1;
  text-align: center;
}

.badge {
  font-size: 18px;
  background: #f5f5f7;
  display: inline-block;
  padding: 5px 15px;
  border-radius: 50px;
  border: 1px solid #ddd;
  margin-bottom: 20px;
  color: #555;
}

.product-image-container {
  background: #fff;
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

.product-image {
  max-width: 100%;
  display: block;
}

.color-options {
  margin-top: 20px;
}

.color-options p {
  font-size: 14px;
  color: #888;
}

.colors {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.color {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  margin: 0 5px;
  cursor: pointer;
  border: 1px solid #ddd;
}

.color:hover {
  transform: scale(1.2);
}

.right-column {
  flex: 1;
  padding-left: 20px;
}

.right-column h1 {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 10px;
}

.price {
  font-size: 18px;
  color: #555;
  margin: 15px 0;
}

.buy-btn {
  background: #007bff;
  color: #fff;
  border: none;
  padding: 12px 30px;
  border-radius: 30px;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s;
}

.buy-btn:hover {
  background: #0056b3;
}

.features {
  list-style: none;
  padding: 0;
  margin-top: 20px;
}

.features li {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.features .icon {
  font-size: 24px;
  color: #007bff;
  margin-right: 10px;
}

.features p {
  font-size: 16px;
  color: #444;
}

  </style>
</head>
<body>
  <!-- En-tête -->
  <header class="header">
    <nav>
      <ul>
        <li><a href="#">iPhone 16 Pro</a></li>
        <li><a href="#">iPhone 16</a></li>
        <li><a href="#">iPhone 15</a></li>
        <li><a href="#">iPhone 14</a></li>
        <li><a href="#">iPhone SE</a></li>
      </ul>
    </nav>
  </header>

  <!-- Contenu Principal -->
  <main class="main-content">
    <div class="product-section">
      <!-- Colonne gauche -->
      <div class="left-column">
        <p class="badge">iPhone 16 Pro</p>
        <div class="product-image-container">
          <img src="img_phone/01.png" alt="iPhone 16 Pro" class="product-image">
        </div>
        <div class="color-options">
          <p>Available in 4 finishes</p>
          <div class="colors">
            <span class="color" style="background: #555;"></span>
            <span class="color" style="background: #ddd;"></span>
            <span class="color" style="background: #c8a165;"></span>
            <span class="color" style="background: #000;"></span>
          </div>
        </div>
      </div>

      <!-- Colonne droite -->
      <div class="right-column">
        <h1>iPhone 16 Pro</h1>
        <p class="price">From $999 or $41.62/mo for 24 mo.*</p>
        <button class="buy-btn">Buy</button>

        <ul class="features">
          <li>
            <span class="icon">📱</span>
            <p>Titanium design with larger 6.3-inch Super Retina XDR display...</p>
          </li>
          <li>
            <span class="icon">🤖</span>
            <p>The first iPhone designed for Apple Intelligence...</p>
          </li>
          <li>
            <span class="icon">📸</span>
            <p>Camera Control gives you an easier way to quickly access...</p>
          </li>
        </ul>
      </div>
    </div>
  </main>
</body>
</html>

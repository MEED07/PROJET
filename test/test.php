<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Global reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  background-color: #f5f5f7;
  color: #1d1d1f;
  margin: 20px;
}

/* Product Card Styles */
.product-card {
  max-width: 900px;
  margin: auto;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.product-header {
  display: flex;
  justify-content: center;
  background-color: #f8f8f8;
  padding: 10px 0;
}

.switch-tab {
  border: none;
  background: transparent;
  font-size: 16px;
  padding: 10px 20px;
  cursor: pointer;
  color: #6e6e73;
  transition: color 0.3s, border-bottom 0.3s;
}

.switch-tab.active {
  color: #0071e3;
  border-bottom: 2px solid #0071e3;
  font-weight: bold;
}

/* Main Layout */
.product-main {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  padding: 20px;
}

/* Slider styles */
.slider {
  position: relative;
  width: 100%;
  max-width: 400px;
  overflow: hidden;
  border-radius: 10px;
}

.slider-wrapper {
  display: flex;
  transition: transform 0.4s ease;
}

.slide {
  min-width: 100%;
  max-height: 350px;
  object-fit: cover;
  display: none;
}

.slide.active {
  display: block;
}

.slider-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 18px;
  border-radius: 50%;
  z-index: 10;
}

.slider-btn.prev {
  left: 10px;
}

.slider-btn.next {
  right: 10px;
}

/* Product Info */
.product-info {
  flex: 1;
  text-align: left;
}

.product-info h1 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 15px;
}

.price {
  font-size: 20px;
  color: #6e6e73;
  margin-bottom: 20px;
}

.product-features {
  list-style: none;
  margin-bottom: 20px;
}

.product-features li {
  font-size: 16px;
  line-height: 1.8;
  position: relative;
  padding-left: 20px;
  margin-bottom: 10px;
}

.product-features li:before {
  content: "✔";
  position: absolute;
  left: 0;
  color: #0071e3;
  font-size: 16px;
}

/* Buttons */
.buy-now {
  background-color: #0071e3;
  color: white;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  margin-right: 15px;
  transition: background-color 0.3s;
}

.buy-now:hover {
  background-color: #005bb5;
}

.learn-more {
  font-size: 16px;
  color: #0071e3;
  text-decoration: none;
  transition: color 0.3s;
}

.learn-more:hover {
  text-decoration: underline;
}

    </style>
</head>
<body>
<div class="product-card">
  <div class="product-header">
    <button class="switch-tab active">iPhone 16 Pro</button>
    <button class="switch-tab">iPhone 16 Pro Max</button>
  </div>

  <div class="product-main">
    <div class="product-gallery">
      <div class="slider">
        <div class="slider-wrapper">
          <img src="./img_phone/01.png" alt="Product 1" class="slide active">
          <img src="./img_phone/02.png" alt="Product 2" class="slide">
          <img src="./img_phone/03.png" alt="Product 3" class="slide">
          <img src="./img_phone/04.png" alt="Product 4" class="slide">
        </div>
        <button class="slider-btn prev">‹</button>
        <button class="slider-btn next">›</button>
      </div>
    </div>

    <div class="product-info">
      <h1>iPhone 16 Pro Max</h1>
      <p class="price">From $1199 or $49.95/mo. for 24 mo.*</p>
      <ul class="product-features">
        <li>Titanium design with larger 6.9" Super Retina XDR display.</li>
        <li>The first iPhone designed for Apple Intelligence.</li>
        <li>Camera Control gives you an easier way to quickly access camera tools.</li>
        <li>A18 Pro chip powers advanced gaming with AAA performance.</li>
        <li>4K 120 fps Dolby Vision and 4 studio-quality mics.</li>
        <li>Capture magical spatial photos and videos.</li>
      </ul>
      <button class="buy-now">Buy</button>
      <a href="#" class="learn-more">Explore iPhone 16 Pro Max further &gt;</a>
    </div>
  </div>
</div>
<script>
    const slides = document.querySelectorAll('.slide');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

let currentIndex = 0;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === index) {
      slide.classList.add('active');
    }
  });
}

prevBtn.addEventListener('click', () => {
  currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
  showSlide(currentIndex);
});

nextBtn.addEventListener('click', () => {
  currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
  showSlide(currentIndex);
});

showSlide(currentIndex);

</script>

</body>
</html>
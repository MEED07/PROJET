<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        
        .products-slider{
            background-color: #f5f5f7;
            padding: 0px 20px;
            box-sizing: border-box;
        }
        .slider-heading{
            font-family:Arial, Helvetica, sans-serif;
            display: flex;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0px auto;
          	padding:0px 20px;
        }
        .slider-heading h3{
            font-size: 1.75rem;
            color: #1d1d1f;
            font-weight: 500;
            letter-spacing: 0.5px;
          line-height:34px;
        }
        .slider-heading h3 span{
            color: #6e6e73;
        }
        .product-box{
            display: flex;
            flex-direction: column;
            width: 400px;
            text-decoration: none;
            background-color: #ffffff;
            border-radius: 20px;
            margin: 20px;
            padding: 25px;
            box-sizing: border-box;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.08);
            transition: all ease 0.3s;
            overflow: hidden;
        }
        .product-box:hover{
            box-shadow: 2px 2px 18px rgba(0,0,0,0.10);
            transform: scale(1.008);
            transition: all  0.3s ease;
        }
        .product-box strong{
            color: #29292c;
            font-size: 1.75rem;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
            margin-top: 24px;
        }
        .product-box img{
            width: 210px;
          	height:250px;
   			padding:20px 0px;
            object-fit: contain;
            object-position: center;
            margin: 20px auto;
        }
        .available-colors{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .available-colors .product-color{
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: flex;
            border: 1px solid rgba(0,0,0,0.1);
            box-shadow: inset 2px 2px 30px rgba(0,0,0,0.03);
            margin: 3px;
        }
        .buy-price{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0px 0px 0px;
        }
        .buy-price p{
            color: #6e6e73;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.9rem;
          	max-width:250px;
            line-height:20px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-box a{
            text-decoration: none;
            display: flex;
            flex-direction: column;
        }
        .buy-price .buy-btn{
            color: #ffffff;
            background-color: #0071e3;
            text-decoration: none;
            width: 80px;
            height: 40px;
          	padding:0px;
          	margin:0px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }
      .lSPager{
      	display:none;
      }
      .lSAction > a {
        
        background-color:#00000033;
        width:50px;
        height:50px;
        border-radius:50%;
        opacity:0.8;
        background-image:none;
        display: flex;
        justify-content: center;
         align-items: center;
      }
      .lSAction > a::after{
        position:absoult;
        content:'';
        margin:auto;
        border: solid #ffffff;
 		border-width: 0 4px 4px 0;
  		display: inline-block;
  		padding: 5px;
      }
      .lSAction > .lSPrev::after {
  		transform: rotate(135deg);
  		-webkit-transform: rotate(135deg);
		}
      
      .lSAction > .lSNext::after {
  		transform: rotate(-45deg);
  		-webkit-transform: rotate(-45deg);
		}
        .explore-products{
        height: 530px;
        position: relative;
        box-shadow: 2px 2px 15px rgba(0,0,0,0.10);
        box-sizing:border-box;
                }
        .explore-products strong{
        z-index: 2;
         }
        .explore-img{
        width:100% !important;
        height: 100% !important;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 1;
        }
        .explore-img img{
        width:100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
        margin: 0px;
        padding: 0px;
            }
        /*making-responsive-css-------*/
        @media(max-width:300px){
            .slider-heading h3{
                font-size: 21px;
            }        
            .product-box{
                width: 310px;
                margin: 10px;
                box-sizing: border-box;
            }
            .explore-products{
                height: 427px;
            }
          .product-box img{
          		height:190px;
          		width:160px;
          padding:0px;}
            .product-box strong{
                font-size: 21px;
            }
        
       
        .lSAction > a{
            display:none;
        }
        .products-slider{
            background-color: #f5f5f7;
            padding: 0px;}
    }
    @media(max-width:400px){
        .product-box{
                width: 280px;
            }
            .buy-btn{
                font-size: 0.8rem;
            }
    }
    @media(max-width:324px){
        .product-box{
            width: 225px;
        }
        .product-box img{
            width: 140px;
          	height:165px;
        }
        .explore-products{
            height: 445px;
        }
        .buy-price{
            flex-direction: column;
        }
        .buy-price .buy-btn{
            width: 100%;
        }
        .back-video {
    width: 100%; 
    overflow: hidden; 
}

    .back-video img {
        width: 100%;
        height: auto;
        display: block;
        
    }
        

}
    .back-video {
    width: 100%; 
    overflow: hidden; 
    
    
}

    .back-video img {
        width: 100%;
        height: auto;
        display: block;
    }


    /* Style pour la fenêtre contextuelle */
.modal {
    display: none; /* Cache la fenêtre contextuelle par défaut */
    position: fixed; /* Positionne la fenêtre de manière fixe */
    z-index: 1; /* S'assure que la fenêtre est au-dessus du contenu */
    left: 0;
    top: 0;
    width: 100%; /* Prend toute la largeur */
    height: 100%; /* Prend toute la hauteur */
    background-color: rgba(0, 0, 0, 0.7); /* Fond semi-transparent */
    overflow: auto; /* Permet de faire défiler si nécessaire */
}

/* Contenu de la fenêtre contextuelle */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%; /* Largeur de la modal */
    border-radius: 8px;
}

/* Bouton de fermeture (X) */
.close-btn {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 25px;
    font-family: Arial, sans-serif;
}

/* Changer la couleur du bouton de fermeture au survol */
.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Contenu du produit dans la modal */
.modal-body {
    display: flex;
    align-items: center;
}

/* Image du produit dans la modal */
#modal-product-image {
    width: 150px;
    height: auto;
    margin-right: 20px;
}

/* Informations du produit */
.product-info {
    max-width: 80%;
}

/* Bouton d'achat */
#modal-buy-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 5px;
}

#modal-buy-btn:hover {
    background-color: #45a049;
}


   

    </style>
</head>
<body>
   <?php 
   include "include/nav.php"
   
   ?>
   <div class="back-video">
            <img src="images/phone.jpg" alt="">
        </div>
    <section class="products-slider">
     
        <div class="slider-heading">
            <h3 style="padding-top:2%">All Models.<span>Take your pick.</span></h3>
        </div>

        <div class="product-container">
        <ul class="autoWidth cs-hidden">
            <li class="item-a">
                <div class="product-box">
                    <a href="#" class="product-link" data-productid="1">
                        <strong>iPhone 12 Pro</strong>
                        <img alt="iPhone 12 Pro" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhgavdrpTRowMSXzNENhCX9vOMRViT_2oZv3YXT4eL1Nyx8tQrisiVllb2BtX5VoB2u6TiE0FU-Q74DfQ0CKQ8jLLEcWXHMz0yqVyDnNVqIUFApKXH3uNofjjG27KTZjR09K-fjQxrRzefo/s400/iphone.png"/>
                        <div class="available-colors">
                            <div class="product-color" style="background-color: #5c5b58;"></div>
                            <div class="product-color" style="background-color: #e5e6e2;"></div>
                            <div class="product-color" style="background-color: #fcebd5;"></div>
                            <div class="product-color" style="background-color: #3f5d6a;"></div>
                        </div>
                        <div class="buy-price">
                            <p>From $999 or $41.62/mo. for 24 mo. before trade-in*</p>
                            <a href="#" class="buy-btn">Buy</a>
                        </div>
                    </a>
                </div>
            </li>
      
   

    <!-- Section des détails du produit -->
   

            
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#" class="product-link" data-productid="2">
                    
                    <strong>iPhone 12</strong>
                    
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjPOv8AoaMnQMlBwBBj66bpNoVUfM8TuICMVYHHzkKMSXA6R2B_zZ3uPnXZ_5_AXjcwwBJjpj2XhzpeG8M_-xg-MKHLtMdTJ4vaQLI3ZpKW0A4XeFtr3d9wKqrGAQ6nYj-RNda34lwTWd_J/s320/2.png"/>
                    
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f6f2ef;"></div>
                        <div class="product-color" style="background-color: #6e6d72;"></div>
                        <div class="product-color" style="background-color: #164a6f;"></div>
                        <div class="product-color" style="background-color: #daefd8;"></div>
                        <div class="product-color" style="background-color: #bab2e6;"></div>
                        <div class="product-color" style="background-color: #da3c3c;"></div>
                    </div>
                    
                    <div class="buy-price">
                        
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                        
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
                
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                    
                    <strong>iPhone SE</strong>
                    
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiBpynnfmR9JN1gBxbSGmBYOaZsMvS0tioODtfGahyphenhyphennUvrPpg3DmSaIszYBku8i4P7W8BqDgOWpjuE1Uzx6qqHk-Odgv3T31pFD1Hq8u_SOGVFR-qJ3IWze-lOqppmd_-kvsFYZ_-jkqr4H/s320/3.png"/>
                    
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f3f3f3;"></div>
                        <div class="product-color" style="background-color: #1d1d1e;"></div>
                        <div class="product-color" style="background-color: #ba0d2f;"></div>
                    </div>
                    
                    <div class="buy-price">
                        
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                        
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
                
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                    
                    <strong>iPhone 11</strong>
                    
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjdjN3Wy-wxXcu64TqZUZ1UiAKQ4VapWk0mEw3ZRlVkk2fTH03kmLUEg3oTMdgZyvFZNPpic1aOLFZ4PvN7ePkuuhfFET_eKtoHF23FBMoUGZFUKCRv-Rgyj8yrc_xwdHkwglQbL5lc_Lsj/s320/4.jpg"/>
                    
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f9f6ef;"></div>
                        <div class="product-color" style="background-color: #1f2020;"></div>
                        <div class="product-color" style="background-color: #aee1cd;"></div>
                        <div class="product-color" style="background-color: #ffe681;"></div>
                        <div class="product-color" style="background-color: #d1cdda;"></div>
                        <div class="product-color" style="background-color: #ba0c2e;"></div>
                    </div>
                    
                    <div class="buy-price">
                        
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                        
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
                
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                    
                    <strong>iPhone XR</strong>
                    
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjT3BzPJLTG9Yqeu55fb6OsRN7WjpBYu654-RJvVTJFnkpKjN1wGxJvBsEjO0TUT7_NHH8KfS2Qj42XNUVZ1q6wsrgMN8QTpFhpGeakTPdE8e1r_L0QReVMEvTlymkZKQvGsp-KebDsCRl2/s320/5.png"/>
                    
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f4f4f4;"></div>
                        <div class="product-color" style="background-color: #1d1d1e;"></div>
                        <div class="product-color" style="background-color: #49aee6;"></div>
                        <div class="product-color" style="background-color: #fe9a8b;"></div>
                        <div class="product-color" style="background-color: #f9d045;"></div>
                        <div class="product-color" style="background-color: #990211;"></div>
                    </div>
                    
                    <div class="buy-price">
                        
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                        
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
                
                <li class="item-a">
            
                    <div class="product-box explore-products">
                        <a href="#">
                            
                            <strong>Explore all iPhone accessories.</strong>
                            
                            <div class="explore-img">
                                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhYbMUW2iGmX96mcvSnehvP4rAaPVm965j-9Fa4bL5aBnXHJ6wXDDzj9Mdb7sEJw2LyxsBP2NB75MW2eIlzmuna94Gxj7Uhf4JMFIu_jQoD-OpA0CJpq4g0xfuMkHPa6zZgVgWLON-LOuOp/s320/end.jpg"/>
                            </div>
                        </a> 
                    </div>
                </li>
            </ul>
               
        </div>
    </section>




<!-- Section pour afficher les détails du produit -->
<!-- Section pour la fenêtre contextuelle -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="modal-body">
            <img src="" alt="Produit" id="modal-product-image" />
            <div class="product-info">
                <h2 id="modal-product-name"></h2>
                <p id="modal-product-description"></p>
                <p><strong>Price:</strong> <span id="modal-product-price"></span></p>
                <button id="modal-buy-btn">Buy</button>
            </div>
        </div>
    </div>
</div>








    <section class="products-slider">
    
        <div class="slider-heading">
            <h3>All Models.<span>Take your pick.</span></h3>
        </div>
       
        <div class="product-container">
            
            <ul class="autoWidth" class="cs-hidden">
            
            <li class="item-a">
            
            <div class="product-box">
                <a href="#">
                
                <strong>iPhone 12 Pro</strong>
                
               <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhgavdrpTRowMSXzNENhCX9vOMRViT_2oZv3YXT4eL1Nyx8tQrisiVllb2BtX5VoB2u6TiE0FU-Q74DfQ0CKQ8jLLEcWXHMz0yqVyDnNVqIUFApKXH3uNofjjG27KTZjR09K-fjQxrRzefo/s400/iphone.png"/>
                
                <div class="available-colors">
                    <div class="product-color" style="background-color: #5c5b58;"></div>
                    <div class="product-color" style="background-color: #e5e6e2;"></div>
                    <div class="product-color" style="background-color: #fcebd5;"></div>
                    <div class="product-color" style="background-color: #3f5d6a;"></div>
                </div>
                
                <div class="buy-price">
                    
                    <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                    
                    <a href="#" class="buy-btn">Buy</a>
                </div>
            </a>
            </div>
            </li>
            
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                 
                    <strong>iPhone 12</strong>
             
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjPOv8AoaMnQMlBwBBj66bpNoVUfM8TuICMVYHHzkKMSXA6R2B_zZ3uPnXZ_5_AXjcwwBJjpj2XhzpeG8M_-xg-MKHLtMdTJ4vaQLI3ZpKW0A4XeFtr3d9wKqrGAQ6nYj-RNda34lwTWd_J/s320/2.png"/>
                
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f6f2ef;"></div>
                        <div class="product-color" style="background-color: #6e6d72;"></div>
                        <div class="product-color" style="background-color: #164a6f;"></div>
                        <div class="product-color" style="background-color: #daefd8;"></div>
                        <div class="product-color" style="background-color: #bab2e6;"></div>
                        <div class="product-color" style="background-color: #da3c3c;"></div>
                    </div>
                    
                    <div class="buy-price">
                    
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                        
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
            
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                    
                    <strong>iPhone SE</strong>
                 
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiBpynnfmR9JN1gBxbSGmBYOaZsMvS0tioODtfGahyphenhyphennUvrPpg3DmSaIszYBku8i4P7W8BqDgOWpjuE1Uzx6qqHk-Odgv3T31pFD1Hq8u_SOGVFR-qJ3IWze-lOqppmd_-kvsFYZ_-jkqr4H/s320/3.png"/>
                    
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f3f3f3;"></div>
                        <div class="product-color" style="background-color: #1d1d1e;"></div>
                        <div class="product-color" style="background-color: #ba0d2f;"></div>
                    </div>
                    
                    <div class="buy-price">
                
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                 
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
  
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
         
                    <strong>iPhone 11</strong>
              
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjdjN3Wy-wxXcu64TqZUZ1UiAKQ4VapWk0mEw3ZRlVkk2fTH03kmLUEg3oTMdgZyvFZNPpic1aOLFZ4PvN7ePkuuhfFET_eKtoHF23FBMoUGZFUKCRv-Rgyj8yrc_xwdHkwglQbL5lc_Lsj/s320/4.jpg"/>
              
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f9f6ef;"></div>
                        <div class="product-color" style="background-color: #1f2020;"></div>
                        <div class="product-color" style="background-color: #aee1cd;"></div>
                        <div class="product-color" style="background-color: #ffe681;"></div>
                        <div class="product-color" style="background-color: #d1cdda;"></div>
                        <div class="product-color" style="background-color: #ba0c2e;"></div>
                    </div>
                   
                    <div class="buy-price">
                  
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                      
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
               
            <li class="item-a">
            
                <div class="product-box">
                    <a href="#">
                 
                    <strong>iPhone XR</strong>
                   
                    <img alt="" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjT3BzPJLTG9Yqeu55fb6OsRN7WjpBYu654-RJvVTJFnkpKjN1wGxJvBsEjO0TUT7_NHH8KfS2Qj42XNUVZ1q6wsrgMN8QTpFhpGeakTPdE8e1r_L0QReVMEvTlymkZKQvGsp-KebDsCRl2/s320/5.png"/>
               
                    <div class="available-colors">
                        <div class="product-color" style="background-color: #f4f4f4;"></div>
                        <div class="product-color" style="background-color: #1d1d1e;"></div>
                        <div class="product-color" style="background-color: #49aee6;"></div>
                        <div class="product-color" style="background-color: #fe9a8b;"></div>
                        <div class="product-color" style="background-color: #f9d045;"></div>
                        <div class="product-color" style="background-color: #990211;"></div>
                    </div>
                 
                    <div class="buy-price">
                    
                        <p>From $999or $41.62/mo. for 24 mo.before trade-in*</p>
                       
                        <a href="#" class="buy-btn">Buy</a>
                    </div>
                </a>
                </div>
                </li>
   
                <li class="item-a">
            
                    <div class="product-box explore-products">
                        <a href="#">
                   
                            <strong>Explore all iPhone accessories.</strong>
                  
                            <div class="explore-img">
                                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhYbMUW2iGmX96mcvSnehvP4rAaPVm965j-9Fa4bL5aBnXHJ6wXDDzj9Mdb7sEJw2LyxsBP2NB75MW2eIlzmuna94Gxj7Uhf4JMFIu_jQoD-OpA0CJpq4g0xfuMkHPa6zZgVgWLON-LOuOp/s320/end.jpg"/>
                            </div>
                        </a> 
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <?php 
    include "include/footer.php"
    ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightslider/dist/js/lightslider.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialisation du slider
            $('.autoWidth').lightSlider({
                autoWidth: true,
                onSliderLoad: function () {
                    $('.autoWidth').removeClass('cs-hidden');
                }
            });
        });
// Fonction pour afficher les détails du produit dans la fenêtre contextuelle
function showProductModal(productId) {
    const products = [
        { id: 1, name: "iPhone 12 Pro", image: "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhgavdrpTRowMSXzNENhCX9vOMRViT_2oZv3YXT4eL1Nyx8tQrisiVllb2BtX5VoB2u6TiE0FU-Q74DfQ0CKQ8jLLEcWXHMz0yqVyDnNVqIUFApKXH3uNofjjG27KTZjR09K-fjQxrRzefo/s400/iphone.png", description: "Description de l'iPhone 12 Pro", price: "$999" },
        { id: 2, name: "iPhone 12", image: "https://example.com/iphone12.jpg", description: "Description de l'iPhone 12", price: "$899" },
        { id: 3, name: "iPhone SE", image: "https://example.com/iphonese.jpg", description: "Description de l'iPhone SE", price: "$499" }
    ];
    
    const product = products.find(p => p.id === productId);

    // Mettre à jour le contenu de la fenêtre contextuelle avec les détails du produit
    document.getElementById('modal-product-name').innerText = product.name;
    document.getElementById('modal-product-image').src = product.image;
    document.getElementById('modal-product-description').innerText = product.description;
    document.getElementById('modal-product-price').innerText = product.price;

    // Afficher la fenêtre contextuelle
    document.getElementById('productModal').style.display = 'block';
}

// Fonction pour fermer la fenêtre contextuelle
function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

// Ajouter un événement de clic sur chaque produit
document.querySelectorAll('.product-link').forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault(); // Empêcher la redirection
        const productId = parseInt(link.getAttribute('data-productid'));
        showProductModal(productId);
    });
});


    </script>

  
</body>
</html>
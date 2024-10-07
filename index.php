<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
          .cta {
                background-color: #007BFF;
                color: pink;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
            }
            .banner {
                background-color: #e0f7fa;
                padding: 50px 20px;
                text-align: center;
            }
            .banner h1 {
                font-size: 2.5em;
                margin: 0 0 20px 0;
            }
            .stats {
                display: flex;
                justify-content: center;
                gap: 20px;
                margin: 20px 0;
            }
            .stat {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .stat h3 {
                margin: 0;
            }
            .stat p {
                margin: 5px 0 0 0;
                color: #007BFF;
                font-weight: bold;
            }
            .doctors {
                display: flex;
                justify-content: center;
                gap: 20px;
                padding: 20px;
            }
            .doctor {
                text-align: center;
            }
            .doctor img {
                width: 100%;
                max-width: 200px;
                border-radius: 50%;
            }
            .doctor h3 {
                margin: 10px 0 0 0;
            }
           
            @media (max-width: 768px) {
                .nav-links {
                    flex-direction: column;
                    align-items: flex-start;
                }
                .banner h1 {
                    font-size: 2em;
                }
                .stats {
                    flex-direction: column;
                    gap: 10px;
                }
                .doctors {
                    flex-direction: column;
                    align-items: center;
                         }
                        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>E-Pharmacy</h1>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>                
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="sidebar">
        <h2>BSIT-> Medicals</h2>
        <img  src="https://img.freepik.com/free-photo/portrait-female-pharmacist-working-drugstore_23-2151684906.jpg?size=626&ext=jpg&ga=GA1.1.34260737.1721296807&semt=ais_hybrid">
    </div>
    <main>
        <div class="container">
            <section class="content">
                <h2>Welcome to BSIT-Pharmacy</h2>
                <p>Find the best medicines and health products here.</p>
                    
                <section class="banner">
                            <h1>BSIT-Pharmacy care for your health </h1>
                            <div class="stats">
                                <div class="stat">
                                    <h3>8+</h3>
                                    <p>Years of experience</p>
                                </div>
                                <div class="stat">
                                    <h3>50k+</h3>
                                    <p>Customer trust </p>
                                </div>
                                <div class="stat">
                                    <h3>60k Above</h3>
                                    <p>Products Delivered</p>
                                </div>
                            </div>
                            
                        </section>
                        
                <!-- Featured Products Section -->
                <section class="featured-products">
                    <marquee> <h3><b>Hurry up! 40% Discount on Below products purchase above 500rs...!</b></h3></marquee>
                    <div class="product-grid">
                        <!-- Example product item -->
                        <div class="product-item">
                            <img src="data:image/jpeg;base64,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" alt="Product 1">
                            <h4>Product Name 1</h4>
                            <p>$19.99</p>
                           
                        </div>
                        <div class="product-item">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR59q40UF-o6wPNeTD7h4Bkknyu7RAGmVL8odDulMB09522Ehz-dEiQvRJUilBDhFhBaGs&usqp=CAU" alt="Product 2">
                            <h4>Product Name 2</h4>
                            <p>$15.99</p>
                           
                        </div>
                        <div class="product-item">
                            <img src="data:image/jpeg;base64,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" alt="Product 1">
                            <h4>Product Name 3</h4>
                            <p>$29.99</p>
                           
                        </div>
                        <div class="product-item">
                            <img src="data:image/jpeg;base64,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" alt="Product 1">
                            <h4>Product Name 4</h4>
                            <p>$111.99</p>
                           
                        </div>
                        <div class="product-item">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2YnngqIPqwuFfDd1Oeisx8zqGZQaSU0Ue7FbvFsQkUgt52AxEs1d0O7SwRRSQXDeldt8&usqp=CAU" alt="Product 1">
                            <h4>Product Name 5</h4>
                            <p>$185.99</p>
                           
                        </div>
                        <div class="product-item">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF1_tCm_-JBz-NYQAVqhpXqvUNDKTONNfwjOBsNbOHMqFcr5vCJ4xyw7iLPOCn_pdYfuU&usqp=CAU" alt="Product 1">
                            <h4>Product Name 6</h4>
                            <p>$119.99</p>
                         
                        </div>
                        <div class="product-item">
                            <img src="https://c1.wallpaperflare.com/preview/494/735/688/medical-treatment-pill-capsule.jpg" alt="Product 1">
                            <h4>Product Name 7</h4>
                            <p>$69.99</p>
                         
                        </div>
                        
                    </div>
                </section>

                <!-- Categories Section -->
                

                <!-- Special Offers Section -->
                <section class="special-offers">
                    <h3>Reasons To Buy Medicine From BSIT-Pharmacy</h3>
                    <p>For over 39 years, BSIT Pharmacy has been providing you with genuine medicines round-the-clock,
                        through 24-hour pharmacies. And now through BSIT Pharmacy, we intend to make your lives easier 
                        – by getting your medicines delivered to you. Yes, no more stepping out to get your medicines, 
                        no more standing in long queues, no more worrying about the genuineness of medicines, 
                        no more sweat! Here are more reasons why you should buy your medicines from BSIT Pharmacy:!</p>
                    
                    <ul>
                        <li>Super-fast deliveries. In select cities, deliveries are done in as less as 1 day</li>
                        <li>Largest pharmacy chain in India with over 5,600 stores</li>
                        <li>Attractive deals on medicines and other FMCG products</li>
                        <li>Option to consult with a pharmacologist to check medicine interactions</li>
                    </ul>
                </section>
            </section>
            <section class="doctors">
                            <div class="doctor">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVfBCro8xXy1wr7LAgXWQJaSE6WW0RWcA2Lgw7sOb1nOcygIAVAqUebVHuz0rqqPxEMmY&usqp=CAU" alt="Doctor 1">
                                <h3>CORONA</h3>
                          
                      </div>
                            <div class="doctor">
                                <img src="data:image/jpeg;base64,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" alt="Doctor 2">
                                <h3>LUKEMIA</h3>
                            </div>
                <div class="doctor">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEtNY_uQfbBHyNhrc-FSD7PlQAXoXUJDfa8pacVEOeoGs3o_AydS3a5xHEnHIxkm1vuxc&usqp=CAU" alt="Doctor 1">
                                <h3>ZIKARTA</h3>
                          
                      </div>
                </div>
                        </section>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('show');
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>
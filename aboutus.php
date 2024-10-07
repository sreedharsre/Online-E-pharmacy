<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Pharmacy</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            .lo {
                padding: 20px;
                margin: 0;
            }
            .AboutUs  {
                font-size: 20px;
                margin-bottom: 20px;
                line-height: 1.6;
            }
            .AboutUs  {
                position: relative;
                background-color:white;
                width: calc(100% + 40px);
                margin: 0 -20px;
                padding: 20px;
                color: black;
                border-radius: 8px;
                display: flex;
                align-items: center;
            }
            .featured-products img{
                position: relative;
                
                width: calc(100% + 20px);
                
                
                
                border-radius: 8px;
                display: flex;
                align-items: center;
            }
            .lo p{
                font-size:23px;
                font-family: initial;
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
           
            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/pharmacy-4706070-3915252.png?f=webp">
        </div>
        <main>
            <div class="container">
                <section class="content">
                    <h1>AboutUs</h1>
                    <hr style="border-top: 2px solid #ff5252;">
                    <p> Best medicines and health products are there.</p>

                    <!-- Featured Products Section -->
                    <section class="featured-products">
                      <img class="AboutUs" src="https://images.apollo247.in/images/img_aboutus.png"><br>
                        
                        
                        <p>Welcome to BSIT, the convergence of innovation and excellence. 
                            Since our establishment in 2015, BSIT Software Services has been scripting a
                            compelling narrative of success and technological advancement. Our odyssey is 
                            characterized by an unwavering commitment to delivering top-tier software solutions 
                            to a varied global clientele. From modest origins to pioneering the industry, our tale 
                            is interwoven with the strands of passion, dedication, and an unyielding pursuit of excellence.
                        </p>
                        <p>At BSIT, we take pride in our expansive skill set that equips us to navigate the ever-changing
                            landscape of the digital realm. Our team comprises highly skilled professionals adept in the latest
                            technologies and industry trends. From software development to cutting-edge solutions in artificial
                            intelligence, cloud computing, and beyond, our diverse skill set situates us as the 
                            go-to hub for comprehensive IT services. We don't merely keep pace with change; we set the pace.
                        </p>
                    </section>
                    <h1><i class="fas fa-bars menu-icon"></i>&ensp;&ensp;<u>Contact Us</u></h1>
                    <div class="lo">
                        <p>BSIT Hospital</p>
                        <p>Land line NO:060-0114-102</p>
                        <p>9650975241</p>
                        <p>info@BSITHospital.com</p>
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
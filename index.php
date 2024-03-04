<?php 
    include 'config.php';
    
    $query = "SELECT MAX(id) AS last_id FROM home_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $lastId = $result['last_id'];

    function getMaxId($pdo, $table) {
        $query = "SELECT MAX(id) AS last_id FROM $table";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['last_id'];
    }

    function getDataById($pdo, $table, $id) {
        $query = "SELECT * FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $lastIdhome = getMaxId($pdo, 'home_table');
    $dataHome = getDataById($pdo, 'home_table', $lastIdhome);

    $lastIdabout = getMaxId($pdo, 'about_table');
    $dataAbout = getDataById($pdo, 'about_table', $lastIdabout);

    $lastIdskill = getMaxId($pdo, 'skillset_table');
    $dataSkill = getDataById($pdo, 'skillset_table', $lastIdskill);

    $lastIdacheivement = getMaxId($pdo, 'achievement_table');
    $dataAcheivement = getDataById($pdo, 'achievement_table', $lastIdacheivement);

    $lastIdcontact = getMaxId($pdo, 'contact_table');
    $dataContact = getDataById($pdo, 'contact_table', $lastIdcontact);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>Personal Portfolio</title>
  <meta name="title" content="Amit's Personal Portfolio">
  <meta name="description" content="This is a personal portfolio html template made by Amit">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.png" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./assets/font/font.css">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-1.png">
  <link rel="preload" as="image" href="./assets/images/hero-shape-2.png">

</head>

<body id="top">

  <!-- 
    - #PRELOADER
  -->
  <div class="preloader" data-preloader>
    <span class="line"></span>
  </div>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <!-- <a href="#" class="logo">
        Amit
      </a> -->

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <!-- <a href="#" class="logo">
            <img src="./assets/images/logo.svg" width="84" height="26" alt="logo">
          </a> -->

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li>
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li>
            <a href="#service" class="navbar-link" data-nav-link>Timeline</a>
          </li>

          <li>
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>

          <li>
            <a href="#project" class="navbar-link" data-nav-link>Project</a>
          </li>

          <li>
            <a href="#activities" class="navbar-link" data-nav-link>Activities</a>
          </li>

          <li>
            <a href="#contact" class="navbar-link" data-nav-link>Contact</a>
          </li>

        </ul>

      </nav>

      <!-- <a href="#" class="btn btn:hover">
        <span class="span">Get A Quote</span>

        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
      </a> -->

      <button class="nav-open-btn btn:hover" aria-label="open menu" data-nav-toggler>
        <span class="line line-1"></span>
        <span class="line line-2"></span>
      </button>

      <div class="overlay" data-overlay data-nav-toggler></div>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <div class="hero text-center" id="home">
        <div class="container">

          <div class="banner-outline has-after">

            <div class="hero-banner img-holder has-after" style="--width: 500; --height: 680;" data-tilt>
            <?php
              $mime_type = 'image/jpg'; 
      
              $base64_image = base64_encode($dataHome['image']); 
              
              $data_uri = "data:$mime_type;base64,$base64_image";
              
              echo "<img src=\"$data_uri\" width=\"500\" height=\"680\" alt=\"Home Image\" class=\"img-cover\">";
            ?>
            </div>

            <span class="span title"><?php echo $dataHome['name'] ?></span>

          </div>

          <div class="hero-content">

            <h1 class="h1 title"><?php echo $dataHome['quote1'] ?></h1>

            <div class="wrapper">
              <a href="#" class="btn btn:hover">
                <span class="span">Download CV</span>
                
                <ion-icon name="cloud-download-outline" aria-hidden="true"></ion-icon>
              </a>

              <p class="hero-text">
                <?php echo $dataHome['quote2'] ?>
              </p>
            </div>

          </div>

          <img src="./assets/images/hero-shape-1.png" width="559" height="232" alt="shape" class="shape shape-1">

          <img src="./assets/images/hero-shape-2.png" width="1358" height="497" alt="shape" class="shape shape-2">

        </div>
      </div>





      <!-- 
        - #SERVICE
      -->

      <section class="service text-center" aria-label="my services" id="service">
        <div class="container">

          <ul class="service-list">

            <li class="service-item">
              <div class="service-card">

                <div class="card-icon">
                  <img src="./assets/images/service-icon-1.svg" width="80" height="80" loading="lazy"
                    alt="service icon">
                </div>

                <h3 class="card-title">
                  <a href="#">
                    Web <br>
                    Development
                  </a>
                </h3>

              </div>
            </li>

            <li class="service-item">
              <div class="service-card">

                <div class="card-icon">
                  <img src="./assets/images/service-icon-2.png" width="80" height="80" loading="lazy"
                    alt="service icon">
                </div>

                <h3 class="card-title">
                  <a href="#">
                    Competitive <br>
                    Programming
                  </a>
                </h3>

              </div>
            </li>

            <li class="service-item">
              <div class="service-card">

                <div class="card-icon">
                  <img src="./assets/images/service-icon-3.svg" width="80" height="80" loading="lazy"
                    alt="service icon">
                </div>

                <h3 class="card-title">
                  <a href="#">
                    IOT <br>
                    Services
                  </a>
                </h3>

              </div>
            </li>

            <li class="service-item">
              <div class="service-card">

                <div class="card-icon">
                  <img src="./assets/images/service-icon-4.svg" width="80" height="80" loading="lazy"
                    alt="service icon">
                </div>

                <h3 class="card-title">
                  <a href="#">
                    Mobile <br>
                    Application
                  </a>
                </h3>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      <section class="section about" aria-label="about-me" id="about">
        <div class="container">

          <div class="tab-container">

            <ul class="tab-btn-list">

              <li class="tab-btn-item">
                <button class="tab-btn title h6 active" data-tab-btn="about">About Me</button>
              </li>

              <li class="tab-btn-item">
                <button class="tab-btn title h6" data-tab-btn="skillset">Skillset</button>
              </li>

              <li class="tab-btn-item">
                <button class="tab-btn title h6" data-tab-btn="interview">Education</button>
              </li>

              <li class="tab-btn-item">
                <button class="tab-btn title h6" data-tab-btn="awward">Achievements</button>
              </li>

              <li class="tab-btn-item">
                <button class="tab-btn title h6" data-tab-btn="exhibition">Hobbies</button>
              </li>

            </ul>

            <div class="tab-content active" data-tab-content="about">
              <div class="grid-list">

                <figure class="about-banner img-holder" style="--width: ; --height: ;" data-tilt>
                    <?php
                      $mime_type = 'image/jpg'; 
              
                      $base64_image = base64_encode($dataAbout['aboutimage']); 
                      
                      $data_uri = "data:$mime_type;base64,$base64_image";
                      
                      echo "<img src=\"$data_uri\" width=\"570\" height=\"420\" alt=\"About Image\" class=\"img-cover\">";
                    ?>
                </figure>

                <div class="about-content">

                  <h2 class="h4 title section-title">
                    <?php echo $dataAbout['about_quote'] ?>
                  </h2>

                  <p class="section-text">
                    <?php echo $dataAbout['description'] ?>
                  </p>

                  <ul class="about-list">

                    <li class="about-item">
                      <p class="list-title">Name</p>

                      <span class="span title h5"><?php echo $dataAbout['name'] ?></span>
                    </li>

                    <li class="about-item">
                      <p class="list-title">Phone Number</p>

                      <span class="span title h5"><?php echo $dataAbout['phone'] ?></span>
                    </li>

                    <li class="about-item">
                      <p class="list-title">Email Address</p>

                      <span class="span title h5"><?php echo $dataAbout['email'] ?></span>
                    </li>

                    <li class="about-item">
                      <p class="list-title">Social Network</p>

                      <div class="social-list">

                        <a href="<?php echo $dataAbout['facebook'] ?>" target="_blank" class="social-link h6" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        <a href="<?php echo $dataAbout['instagram'] ?>" class="social-link h6" target="_blank" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="<?php echo $dataAbout['linkedin'] ?>" class="social-link h6" target="_blank" title="Linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                        <a href="<?php echo $dataAbout['github'] ?>" class="social-link h6" target="_blank" title="Github"><i class="fa fa-github-square" aria-hidden="true"></i></a>

                      </div>
                    </li>

                  </ul>

                </div>

              </div>
            </div>

            <div class="tab-content" data-tab-content="skillset">
              <div class="grid-list">

                <div class="skill-content">

                  <h3 class="h4 title section-title">
                    Let's take an overview of my skillset.
                  </h3>

                  <p class="section-text">
                    <?php echo $dataSkill['description'] ?>
                  </p>

                  <ul class="skill-list">

                    <li>
                      <div class="skill-wrapper">
                        <span class="span"><?php echo $dataSkill['skill_1'] ?></span>

                        <span class="value"><?php echo $dataSkill['skill_1percent'] ?>%</span>
                      </div>

                      <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $dataSkill['skill_1percent']?>%"></div>
                      </div>
                    </li>

                    <li>
                      <div class="skill-wrapper">
                        <span class="span"><?php echo $dataSkill['skill_2'] ?></span>

                        <span class="value"><?php echo $dataSkill['skill_2percent'] ?>%</span>
                      </div>

                      <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $dataSkill['skill_2percent']?>%"></div>
                      </div>
                    </li>

                  </ul>

                </div>

                <figure class="skill-banner img-holder" style="--width: 570; --height: 420;" data-tilt>
                  <?php
                    $mime_type = 'image/jpg'; 
            
                    $base64_image = base64_encode($dataSkill['skillimage']); 
                    
                    $data_uri = "data:$mime_type;base64,$base64_image";
                    
                    echo "<img src=\"$data_uri\" width=\"570\" height=\"420\" loading=\"lazy\" alt=\"skill banner\" class=\"img-cover\">";
                  ?>
                </figure>

              </div>
            </div>


            <div class="tab-content" data-tab-content="interview">
              <div class="grid-list">

                <div class="interview-card img-holder" style="--width: 376; --height: 420;" data-tilt>
                    <h3>Undergraduation</h3>
                    <hr>
                    <div class="education-details">
                        <h4>University:</h4>
                        <p class="card-text">Khulna University of Engineering & Technology (KUET)</p>
                    </div>
                    <div class="education-details">
                        <h4>Department:</h4>
                        <p class="card-text">Computer Science and Engineering (CSE)</p>
                    </div>
                    <div class="education-details">
                        <h4>Year of Study:</h4>
                        <p class="card-text">3rd Year</p>
                    </div>
                    <div class="education-details">
                        <h4>Expected Graduation Date:</h4>
                        <p class="card-text">March 2026</p>
                    </div>
                    
                </div>


                <div class="interview-card img-holder" style="--width: 376; --height: 420;" data-tilt>
                    <h3>Higher Secondary</h3>
                    <hr>
                    <div class="education-details">
                        <h4>College:</h4>
                        <p class="card-text">Jalalabad Cantonment Public School and College, Sylhet</p>
                    </div>
                    <div class="education-details">
                        <h4>Background:</h4>
                        <p class="card-text">Science</p>
                    </div>
                    <div class="education-details">
                        <h4>Ended:</h4>
                        <p class="card-text">5 June, 2020</p>
                    </div>
                    <div class="education-details">
                        <h4>Grade:</h4>
                        <p class="card-text">5.0</p>
                    </div>
                </div>

                <div class="interview-card img-holder" style="--width: 376; --height: 420;" data-tilt>
                    <h3>Secondary</h3>
                    <hr>
                    <div class="education-details">
                        <h4>School:</h4>
                        <p class="card-text">Border Guard Public School</p>
                    </div>
                    <div class="education-details">
                        <h4>Group:</h4>
                        <p class="card-text">Science</p>
                    </div>
                    <div class="education-details">
                        <h4>Ended:</h4>
                        <p class="card-text">3 November, 2018</p>
                    </div>
                    <div class="education-details">
                        <h4>Grade</h4>
                        <p class="card-text">5.0</p>
                    </div>
                </div>

              </div>
            </div>

            <div class="tab-content" data-tab-content="awward">

              <h3 class="h4 title section-title">
                Let's take an overview of my achievements.
              </h3>

              <ul class="grid-list">

                <li>
                  <div class="award-card">
                    <figure class="card-banner img-holder" style="--width: 534; --height: 383;" data-tilt>
                    <?php
                      $mime_type = 'image/jpg'; 
              
                      $base64_image = base64_encode($dataAcheivement['img1']); 
                      
                      $data_uri = "data:$mime_type;base64,$base64_image";
                      
                      echo "<img src=\"$data_uri\" width=\"534\" height=\"383\" loading=\"lazy\" alt=\"certificate\" class=\"img-cover\">";
                    ?>
                    </figure>
                  </div>
                </li>

                <li>
                  <div class="award-card">
                    <figure class="card-banner img-holder" style="--width: 534; --height: 383;" data-tilt>
                    <?php
                      $mime_type = 'image/jpg'; 
              
                      $base64_image = base64_encode($dataAcheivement['img2']); 
                      
                      $data_uri = "data:$mime_type;base64,$base64_image";
                      
                      echo "<img src=\"$data_uri\" width=\"534\" height=\"383\" loading=\"lazy\" alt=\"certificate\" class=\"img-cover\">";
                    ?>
                    </figure>
                  </div>
                </li>

                <li>
                  <div class="award-card">
                    <figure class="card-banner img-holder" style="--width: 534; --height: 383;" data-tilt>
                    <?php
                      $mime_type = 'image/jpg'; 
              
                      $base64_image = base64_encode($dataAcheivement['img3']); 
                      
                      $data_uri = "data:$mime_type;base64,$base64_image";
                      
                      echo "<img src=\"$data_uri\" width=\"534\" height=\"383\" loading=\"lazy\" alt=\"certificate\" class=\"img-cover\">";
                    ?>
                    </figure>
                  </div>
                </li>

              </ul>

            </div>

            <div class="tab-content" data-tab-content="exhibition">
              <ul class="grid-list">

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/guitar.jpg" width="376" height="200" loading="lazy" alt="image"
                        class="img-cover">
                    </figure>
                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/painting.jpg" width="376" height="200" loading="lazy" alt="video"
                        class="img-cover">
                    </figure>
                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/game.jpg" width="376" height="200" loading="lazy" alt="music"
                        class="img-cover">
                    </figure>

                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/reading.jpg" width="376" height="200" loading="lazy" alt="image"
                        class="img-cover">
                    </figure>

                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/travelling.jpg" width="376" height="200" loading="lazy" alt="image"
                        class="img-cover">
                    </figure>

                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

                <li>
                  <div class="exhibition-card">

                    <figure class="card-banner img-holder" style="--width: 376; --height: 200;" data-tilt>
                      <img src="./assets/images/movies.jpg" width="376" height="200" loading="lazy" alt="image"
                        class="img-cover">
                    </figure>

                    <div class="card-icon">
                      <ion-icon name="image-outline" aria-hidden="true"></ion-icon>
                    </div>

                  </div>
                </li>

              </ul>
            </div>

          </div>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="section cta" aria-label="work with me">
        <div class="container">

          <h2 class="title h2 section-title text-center">
            Let's have an overview of what Projects I've done!
          </h2>

          

        </div>
      </section>





      <!-- 
        - #PROJECTS
      -->

      <section class="section project" aria-label="my latest projects" id="project">

        <ul class="slider-list">

          <li class="slider-item">
            <div class="project-card text-center">

              <div class="card-banner img-holder has-before" style="--width: 1000; --height: 763;">
                <img src="./assets/images/chat_project.jpg" width="1000" height="763" loading="lazy"
                  alt="Project poster: Creative & experienced digital design studio" class="img-cover">

                <a href="https://github.com/superXnova21/ChatLink" target ="_blank" class="btn btn:hover">
                  <span class="span">Project Details</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <div class="card-content">
                <p class="card-subtitle">Software</p>

                <h3 class="title h3">
                  <a href="#" class="card-title">A social media <br> app for people to connect.</a>
                </h3>
              </div>

            </div>
          </li>

          <li class="slider-item">
            <div class="project-card text-center">

              <div class="card-banner img-holder has-before" style="--width: 1000; --height: 763;">
                <img src="./assets/images/hardware_project.jpg" width="1000" height="763" loading="lazy"
                  alt="Project poster: Front End Development & Maintenance" class="img-cover">

                <a href="#" class="btn btn:hover">
                  <span class="span">Project Details</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <div class="card-content">
                <p class="card-subtitle">Hardware</p>

                <h3 class="title h3">
                  <a href="#" class="card-title">A complete <br> line follower and maze solver.</a>
                </h3>
              </div>

            </div>
          </li>

          <li class="slider-item">
            <div class="project-card text-center">

              <div class="card-banner img-holder has-before" style="--width: 1000; --height: 763;">
                <img src="./assets/images/oop_project.webp" width="1000" height="763" loading="lazy"
                  alt="Project poster: Flutter Framework & Warframe Design" class="img-cover">

                <a href="https://github.com/superXnova21/Lab_OOP" class="btn btn:hover">
                  <span class="span">Project Details</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <div class="card-content">
                <p class="card-subtitle">OOP</p>

                <h3 class="title h3">
                  <a href="#" class="card-title">Inventory management system with oop and c++</a>
                </h3>
              </div>

            </div>
          </li>

          <li class="slider-item">
            <div class="project-card text-center">

              <div class="card-banner img-holder has-before" style="--width: 1000; --height: 763;">
                <img src="./assets/images/project-4.jpg" width="1000" height="763" loading="lazy"
                  alt="Project poster: Full Web Development Project With JavaScript" class="img-cover">

                <a href="#" class="btn btn:hover">
                  <span class="span">Project Details</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <div class="card-content">
                <p class="card-subtitle">Web, Product</p>

                <h3 class="title h3">
                  <a href="#" class="card-title">Full Web Development Project With JavaScript</a>
                </h3>
              </div>

            </div>
          </li>

          <li class="slider-item">
            <div class="project-card text-center">

              <div class="card-banner img-holder has-before" style="--width: 1000; --height: 763;">
                <img src="./assets/images/project-5.jpg" width="1000" height="763" loading="lazy"
                  alt="Project poster: Cloud Migration & AWS Services" class="img-cover">

                <a href="#" class="btn btn:hover">
                  <span class="span">Project Details</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <div class="card-content">
                <p class="card-subtitle">Web, Product</p>

                <h3 class="title h3">
                  <a href="#" class="card-title">Cloud Migration & AWS Services</a>
                </h3>
              </div>

            </div>
          </li>

        </ul>

      </section>


      <!-- 
        - #CONTACT
      -->

      <section class="section contact" aria-label="contact me" id="contact">
        <div class="container">

          <h2 class="title h2 section-title">Get In Touch</h2>

          <div class="contact-content">

            <form action="./message.php" method="post" class="contact-form" id="messageForm">

              <input type="text" name="user" placeholder="Full name" autocomplete="off" required class="input-field">

              <input type="email" name="email" placeholder="Email address" autocomplete="off" required
                class="input-field">

              <input type="tel" name="phone" placeholder="Phone" autocomplete="off" class="input-field">

              <textarea name="message" placeholder="Enter massges" required class="input-field"></textarea>

              <button type="submit" class="btn btn:hover">
                <span class="span">Get A Quote</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
              </button>

            </form>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.347439662425!2d89.49978157520786!3d22.90055237925955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff9bda1d0ff6e5%3A0x123a926908efcd0c!2sKhulna%20University%20of%20Engineering%20%26%20Technology!5e0!3m2!1sen!2sbd!4v1709471866345!5m2!1sen!2sbd"
                width="600" height="450" style="border: 0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" class="map">
            </iframe>



            <ul class="contact-list">

              <li class="contact-item">

                <div class="item-icon">
                  <img src="./assets/images/contact-icon-1.png" width="50" height="50" loading="lazy"
                    alt="contact icon">
                </div>

                <div>
                  <span class="title h6"><?php echo $dataContact['phone']?></span>

                  <!-- <span class="title h6">789 (569) 126 35</span> -->
                </div>

              </li>

              <li class="contact-item">

                <div class="item-icon">
                  <img src="./assets/images/contact-icon-2.png" width="50" height="50" loading="lazy"
                    alt="contact icon">
                </div>

                <div>
                  <address class="title h6">
                  <?php echo $dataContact['address']?>
                  </address>
                </div>

              </li>

              <li class="contact-item">

                <div class="item-icon">
                  <img src="./assets/images/contact-icon-3.png" width="50" height="50" loading="lazy"
                    alt="contact icon">
                </div>

                <div>
                  <span class="title h6"><?php echo $dataContact['mail']?></span>
                </div>

              </li>

            </ul>

          </div>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <div class="container">

      <p class="copyright">
        Copyright & Design By @amit - 2024
      </p>

      <a href="#top" class="back-top-btn">
        <span class="span">Back To Top</span>

        <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
      </a>

    </div>
  </footer>





  <!-- 
    - #CUSTOM CURSOR
  -->

  <div class="cursor-dot" data-cursor></div>
  <div class="cursor-outline" data-cursor></div>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.getElementById("messageForm");
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            // AJAX request to submit the form data
            let formData = new FormData(form);
            fetch("message.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    // Clear form fields
                    form.reset();
                    // Display success alert
                    alert(data.message);
                } else {
                    // Display error alert
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
    </script>

</body>

</html>
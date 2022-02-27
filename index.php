<?php
if(!isset($_SESSION)) 
{ 
  session_start();
  $_SESSION['id']=999;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="./dist/css/style.css">
  <title>Sipsewana EDU</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#home">
            <h1><span>S</span>ipsewana <span>E</span>DU</h1>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="#home" data-after="Home">Home</a></li>
            <li><a href="#lecturers" data-after="Lecturers">Lecturers</a></li>
            <li><a href="#classes" data-after="Classes">Classes</a></li>
            <li><a href="#about" data-after="About">About</a></li>
            <li><a href="#contact" data-after="Contact">Contact</a></li>
            <li><a href="./pages/Student/Login.php" data-after="Login">Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->


  <!-- Home Section  -->
  <section id="home">
    <div class="home container">
      <div>
        <h1>Hello, <span></span></h1>
        <h1>Welcome to <span></span></h1>
        <h1>Sipsewana EDU <span></span></h1>
        <a data-toggle="modal" data-target="#modal-default" type="button" class="ctas">Enroll as Student!</a>
        <a href="./pages/Lecturer/Register.php" type="button" class="ctal">Enroll as Lecturer!</a>
      </div>
    </div>
  </section>
  <!-- End Home Section  -->

  <!-- lecturers Section -->
  <section id="lecturers">
    <div class="lecturers container">
      <div class="lecturers-top">
        <h1 class="section-title"><span>T</span>eachers</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum deleniti maiores pariatur assumenda quas
          magni et, doloribus quod voluptate quasi molestiae magnam officiis dolorum, dolor provident atque molestias
          voluptatum explicabo!</p>
      </div>
      <div class="lecturers-bottom">
        <div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>

        <div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div><div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div><div class="lecturers-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
      </div>
    </div>
  </section>
  <!-- End lecturers Section -->

  <!-- classes Section -->
  <section id="classes">
    <div class="classes container">
      <div class="classes-header">
        <h1 class="section-title"><span>C</span>lasses</h1>
      </div>
      <div class="all-classes">
        <div class="classes-item">
          <div class="classes-info">
            <h1>Project 1</h1>
            <h2>Coding is Love</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, iusto cupiditate voluptatum impedit unde
              rem ipsa distinctio illum quae mollitia ut, accusantium eius odio ducimus illo neque atque libero non sunt
              harum? Ipsum repellat animi, fugit architecto voluptatum odit et!</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/img-1.png" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Project 2</h1>
            <h2>Coding is Love</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, iusto cupiditate voluptatum impedit unde
              rem ipsa distinctio illum quae mollitia ut, accusantium eius odio ducimus illo neque atque libero non sunt
              harum? Ipsum repellat animi, fugit architecto voluptatum odit et!</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/img-1.png" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Project 3</h1>
            <h2>Coding is Love</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, iusto cupiditate voluptatum impedit unde
              rem ipsa distinctio illum quae mollitia ut, accusantium eius odio ducimus illo neque atque libero non sunt
              harum? Ipsum repellat animi, fugit architecto voluptatum odit et!</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/img-1.png" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Project 4</h1>
            <h2>Coding is Love</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, iusto cupiditate voluptatum impedit unde
              rem ipsa distinctio illum quae mollitia ut, accusantium eius odio ducimus illo neque atque libero non sunt
              harum? Ipsum repellat animi, fugit architecto voluptatum odit et!</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/img-1.png" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Project 5</h1>
            <h2>Coding is Love</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, iusto cupiditate voluptatum impedit unde
              rem ipsa distinctio illum quae mollitia ut, accusantium eius odio ducimus illo neque atque libero non sunt
              harum? Ipsum repellat animi, fugit architecto voluptatum odit et!</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/img-1.png" alt="img">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End classes Section -->

  <!-- About Section -->
  <section id="about">
    <div class="about container">
      <div class="col-left">
        <div class="about-img">
          <img src="./dist/img/dashboardImages/sipsewanaLogo.jpg" alt="img">
        </div>
      </div>
      <div class="col-right">
        <h1 class="section-title">About <span>Us</span></h1>
        <h2>Front End Developer</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores, velit alias eius non illum beatae atque
          repellat ratione qui veritatis repudiandae adipisci maiores. At inventore necessitatibus deserunt
          exercitationem cumque earum omnis ipsum rem accusantium quis, quas quia, accusamus provident suscipit magni!
          Expedita sint ad dolore, commodi labore nihil velit earum ducimus nulla quae nostrum fugit aut, deserunt
          reprehenderit libero enim!</p>
        <a href="#" style="color: black;" class="ctas">Download Resume</a>
      </div>
    </div>
  </section>
  <!-- End About Section -->

  <!-- Contact Section -->
  <section id="contact">
    <div class="contact container">
      <div>
        <h1 class="section-title">Contact <span>info</span></h1>
      </div>
      <div class="contact-items">
        <div class="contact-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/phone.png" /></div>
          <div class="contact-info">
            <h1>Phone</h1>
            <h2>+1 234 123 1234</h2>
            <h2>+1 234 123 1234</h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/new-post.png" /></div>
          <div class="contact-info">
            <h1>Email</h1>
            <h2><a href="#">info@gmail.com</a></h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/map-marker.png" /></div>
          <div class="contact-info">
            <h1>Address</h1>
            <h2>Fatikchhari, Chittagong, Bangladesh</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section -->

  <!-- Footer -->
  <div class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Crew Logins</h3>
            <a href="./pages/Front Officer/Login.php">Front Officer</a>
            <a href="./pages/Cashier/Login.php">Cashier</a>
            <a href="./pages/Director/Login.php">Director</a>
        </div>

        <div class="box">
            <h3>Quick links</h3>
            <a href="#"><p><i class="fas fa-search"></i>Find a class</p></a>
            <a href="#"><p><i class="fas fa-search"></i>Find a teacher</p></a>
        </div>
        <div class="box">
          <h3>Social links</h3>
          <a href="#"><p><i class="fab fa-facebook"></i>Facebook</p></a>
          <a href="#"><p><i class="fab fa-twitter"></i>Twitter</p></a>
      </div>
    </div>

    <h1 class="credit">Copyright &copy; 2021-2024 <a href="#">SipsewanaEDU</a>.All rights reserved.</h1>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h4 class="modal-title text-center">Select One</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
        <div class="row mt-4">
          <div class="col-md-5">
          <button type="button" onclick="location.href='./pages/Student/olRegister.php';" class="btn btn-block btn-primary btn-lg text-center">O/L Student</button>
          </div>
          <div class="col-md-5">
            <button type="button" onclick="location.href='./pages/Student/alRegister.php';" class="btn btn-block btn-primary btn-lg text-center">A/L Student</button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <!-- End Footer -->
  <script src="./dist/js/app.js"></script>
  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
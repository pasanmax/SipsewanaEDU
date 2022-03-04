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
        <p>An unparalleled array of qualified and experienced lecturers are available.
           Some have small groups enabling them to give individual attention to the student, while others have large groups which help sharpen the competitive instincts of the student.</p>
      </div>
      <div class="lecturers-bottom">
        <div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>THARINDU AKALANKA</h2>
          <h4 style="color: whitesmoke;"><i>ICT</i></h4>
          <p>Bachelor of ICT (Hon.) - University of Jayawardanapura, BIT - UCSC, HDIT - FITP<br>&nbsp;</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>KITHSIRI KUMARA</h2>
          <h4 style="color: whitesmoke;"><i>CHEMISTRY SINHALA MEDIUM</i></h4>
          <p>BSc. (Engineering) 1st class , University of Moratuwa , Dip. in CIMA<br>&nbsp;</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>CHANAKA JAYAMAL</h2>
          <h4 style="color: whitesmoke;"><i>COM MATHS SINHALA MEDIUM</i></h4>
          <p>BSc. (Engineering) Hons, University of Moratuwa, Dip. in CIMA,P.G Dip in Industrial Mathematics</p>
        </div>
        <div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>DULIP LUCKSHAN</h2>
          <h4 style="color: whitesmoke;"><i>ECONOMICS ENGLISH MEDIUM</i></h4>
          <p>BSc. Business Administration ( Business Economics) Sp.University of Sri Jayawardanapura</p>
        </div>
      
        <div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>UPUL JAYASOMA</h2>
          <h4 style="color: whitesmoke;"><i>SCIENCE</i></h4>
          <p>Sinhala Medium<br>&nbsp;</p>
        </div><div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>THARAKA JAYASINGHE</h2>
          <h4 style="color: whitesmoke;"><i>COMMERCE</i></h4>
          <p>Sinhala Medium<br>&nbsp;</p>
        </div><div class="lecturers-item">
          <div class="icon"><img src="./dist/img/appImages/lecturer.png" /></div>
          <h2>IVON ARAVINDA</h2>
          <h4 style="color: whitesmoke;"><i>COMMERCE</i></h4>
          <p>English Medium<br>&nbsp;</p>
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
            <h1>Chemistry</h1>
            <h2>A/L Chemistry</h2>
            <p>Discusses all the practicals related to chemistry and teaches do live practicals to the students when required. 
              Necessary tutorials and question paper sets are provided to each student.
            </p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/chemistry.jpg" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Biology</h1>
            <h2>A/L Biology</h2>
            <p>Biology lessons are taught in a very interesting way and tutorials with color pictures related to the lessons are also provided.</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/bio.jpg" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Physics</h1>
            <h2>A/L Physics</h2>
            <p>The tutorial for all the physics related lessons is given at the beginning and videos are shown.
              In addition, past papers problmes related to them are also discussed at the same time.</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/physics.jpg" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>ICT</h1>
            <h2>A/L ICT</h2>
            <p>It teaches the ICT subject in a very simple way and also explains how to write answers to the question papers through practical activities.</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/ict.jpg" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>History</h1>
            <h2>O/L History</h2>
            <p>Students are taught to memorize very intersting ancient stories about the history of the country and the world. All tutorials and notes are provided at the beginning of the lesson.</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/history.jpg" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Sinhala</h1>
            <h2>O/L Sinhala</h2>
            <p>Sinhala language and literature are taught correctly from beginning. Students are also taught to write grammar rules and answer questions correctly.</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/sinhala.png" alt="img">
          </div>
        </div>
        <div class="classes-item">
          <div class="classes-info">
            <h1>Commerce</h1>
            <h2>O/L Commerce</h2>
            <p>The subject of Business Studies  is taught in a very interesting and simple way. Identifies new business opportunities and guides every student to enter the world through them</p>
          </div>
          <div class="classes-img">
            <img src="./dist/img/appImages/commerce.jpg" alt="img">
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
        <h2>Sipsewana</h2>
        <p>Sipsewana Institute is the pioneer Higher Education in Sri Lanka sice 2010.The Sipsewana brand is now synonymou with educational excellence and market leadership in the country's educational landscape.
        Our sole aim is to encourage the children of our nation to reach goals in such a place where they can fully concenrate without any disturbance while enjoying the great facilities with the sole intention of winnig the future.
        </p>
        <a href="#contact" style="color: black;" class="ctas">Contact US</a>
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
            <h2>071 778 2366</h2>
            
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/new-post.png" /></div>
          <div class="contact-info">
            <h1>Email</h1>
            <h2><a href="mailto:sipsewana@gmail.com">sipsewana@gmail.com</a></h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/map-marker.png" /></div>
          <div class="contact-info">
            <h1>Address</h1>
            <h2>Sipsewana Institute,Ihala-Karagahamuna,Ganemulla Rd,Kadawatha.</h2>
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

        <!-- <div class="box">
            <h3>Quick links</h3>
            <a href="#"><p><i class="fas fa-search"></i>Find a class</p></a>
            <a href="#"><p><i class="fas fa-search"></i>Find a teacher</p></a>
        </div> -->
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Front Officer | Register Director</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../../../dist/img/dashboardImages/sipsewanaLogo.jpg" alt="SipsewanaLogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar log out -->
      <li class="nav-item">
        <a href="../../Login.php" class="nav-link">Log out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../../../dist/img/dashboardImages/sipsewanaLogo.jpg" alt="SipsewanaLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sipsewana EDU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../../../dist/img/dashboardImages/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">User's name</a>
        </div>
      </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="../../Dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- Registrations -->
        <li class="nav-item">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
            <p>
              Manage Registrations
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Pending Student Registrations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Pending Lecturer Registrations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php" class="nav-link">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Pending Front Officer Registrations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php" class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>Pending Director Registrations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>Pending Cashier Registrations</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Students -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Students
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Students/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Students</p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="../../Students/Payment/List.php" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>View Payments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Students/Homework/List.php" class="nav-link">
                <i class="nav-icon far fa-file-archive"></i>
                <p>View Homeworks</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Students/OnlineAttendance/List.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>View Online Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Students/OfflineAttendance/List.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>View Offline Attendance</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Lectures -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Lecturers
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Lecturers/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Lecturers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Lecturers/Payment/List.php" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>View Payments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Lecturers/Homework/List.php" class="nav-link">
                <i class="nav-icon far fa-file-archive"></i>
                <p>View Homeworks</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Lecturers/OnlineAttendance/List.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>View Online Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Lecturers/OfflineAttendance/List.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>View Offline Attendance</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Front Officer -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
              Front Officers
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../FrontOfficers/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Front Officers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../FrontOfficers/Register/Register.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>Register Front Officers</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Cashiers -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>
              Cashiers
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Cashiers/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Cashiers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Cashiers/Register/Register.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>Register Cashiers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Cashiers/PaidPayment/List.php" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>View Paid Payments</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Director -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
              Directors
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Directors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon far fa-address-card"></i>
                <p>Register Directors</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Subject -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Subjects
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Subjects/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Subjects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Subjects/Add/Add.php" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>Add Subjects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Subjects/EnrolledStudents/List.php" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>View Enrolled Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Subjects/AssignedLecturers/List.php" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>View Assigned Lecturers</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Class -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-file-alt"></i>
            <p>
              Classes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Classes/OnlineClasses/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Online Classes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Classes/OfflineClasses/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Offline Classes</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Director Registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../Dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Directors</li>
              <li class="breadcrumb-item active">Register Directors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Registration Form</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form id="registration" action="">
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="dob">Date of Birth
                    <!-- <span class="text-danger font-weight-bold">*</span> -->
                  </label>
                  <div class="input-group date" data-target-input="nearest">
                      <input id="dob" type="text" class="form-control datetimepicker-input" data-target="#dob" required>
                      <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                      <!-- <div class="invalid-feedback">Birth Date is required</div> -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" id="email" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="cno">Contact Number</label>
                  <input type="text" id="cno" class="form-control"/>
                </div>
                <div class="card-footer">
                  <button type="submit" id="reset" class="btn btn-info">Register</button>
                  <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2024 <a href="#">SipsewanaEDU</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../../../plugins/moment/moment.min.js"></script>
<script src="../../../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../../dist/js/adminlte.min.js"></script>
<!-- Page Specific Script -->
<script>
  $(function () {
    //Date picker
    $('#dob').datetimepicker({
          format: 'L'
    });
  });
</script>
</body>
</html>

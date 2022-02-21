<?php
include('../../models/frontofficer.php');
if(isset($_SESSION['id']))
{
  $frontofficer = new FrontOfficer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Front Officer | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/dashboardImages/sipsewanaLogo.jpg" alt="SipsewanaLogo" height="60" width="60">
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
        <a href="../../models/frontofficer.php?logout=1" class="nav-link" onclick="return confirm('Are you sure?')">Log out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/dashboardImages/sipsewanaLogo.jpg" alt="SipsewanaLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sipsewana EDU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/dashboardImages/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$frontofficer->getName($_SESSION['id'])?></a>
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
            <a href="#" class="nav-link active">
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
                <a href="./ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Pending Student Registrations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php" class="nav-link">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>Pending Lecturer Registrations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./ManageRegistrations/PendingFrontOfficerRegistrations/PendingRegistrations.php" class="nav-link">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>Pending Front Officer Registrations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./ManageRegistrations/PendingDirectorRegistrations/PendingRegistrations.php" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>Pending Director Registrations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./ManageRegistrations/PendingCashierRegistrations/PendingRegistrations.php" class="nav-link">
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
                <a href="./Students/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Students/Payment/List.php" class="nav-link">
                  <i class="nav-icon fas fa-money-check-alt"></i>
                  <p>View Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Students/Homework/List.php" class="nav-link">
                  <i class="nav-icon far fa-file-archive"></i>
                  <p>View Homeworks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Students/OnlineAttendance/List.php" class="nav-link">
                  <i class="nav-icon far fa-address-card"></i>
                  <p>View Online Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Students/OfflineAttendance/List.php" class="nav-link">
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
                <a href="./Lecturers/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Lecturers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Lecturers/Payment/List.php" class="nav-link">
                  <i class="nav-icon fas fa-money-check-alt"></i>
                  <p>View Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Lecturers/Homework/List.php" class="nav-link">
                  <i class="nav-icon far fa-file-archive"></i>
                  <p>View Homeworks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Lecturers/OnlineAttendance/List.php" class="nav-link">
                  <i class="nav-icon far fa-address-card"></i>
                  <p>View Online Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Lecturers/OfflineAttendance/List.php" class="nav-link">
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
                <a href="./FrontOfficers/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Front Officers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./FrontOfficers/Register/Register.php" class="nav-link">
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
                <a href="./Cashiers/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Cashiers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Cashiers/Register/Register.php" class="nav-link">
                  <i class="nav-icon far fa-address-card"></i>
                  <p>Register Cashiers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Cashiers/PaidPayment/List.php" class="nav-link">
                  <i class="nav-icon fas fa-money-check-alt"></i>
                  <p>View Paid Payments</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Director -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Directors
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./Directors/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Directors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Directors/Register/Register.php" class="nav-link">
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
                <a href="./Subjects/Manage/List.php" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>Manage Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Subjects/Add/Add.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>Add Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Subjects/EnrolledStudents/List.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>View Enrolled Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Subjects/AssignedLecturers/List.php" class="nav-link">
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
                <a href="./Classes/OnlineClasses/List.php" class="nav-link">
                  <i class="nav-icon fas fa-eye"></i>
                  <p>View Online Classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./Classes/OfflineClasses/List.php" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Front Officer Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php $count = $frontofficer->getRegisteredStudentCount()?>
                <h3><?= $count ?></h3>

                <p>Registered Students</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="../Front Officer/Students/Manage/List.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php $count = $frontofficer->getRegisteredLecturerCount()?>
                <h3><?= $count ?></h3>
                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->

                <p>Registered Lectures</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="../Front Officer/Lecturers/Manage/List.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php $count = $frontofficer->getSubjectCount()?>
                <h3><?= $count ?></h3>

                <p>Total Subjects</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-folder"></i>
              </div>
              <a href="../Front Officer/Subjects/Manage/List.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <?php $count = $frontofficer->getPendingStudentsCount()?>
                <h3><?= $count ?></h3>

                <p>Pending Student Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="./ManageRegistrations/PendingStudentRegistrations/PendingRegistrations.php" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <?php $count = $frontofficer->getPendingLecturersCount()?>
                <h3><?= $count ?></h3>

                <p>Pending Lecturer Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="./ManageRegistrations/PendingLecturerRegistrations/PendingRegistrations.php" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-7 connectedSortable">
            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/Front Officer/dashboard.js"></script>
</body>
</html>
<?php
}
else
{
  header('location:./Login.php');
}
?>
<?php
include('../../../../models/frontofficer.php');
if(isset($_SESSION['id']))
{
  $frontofficer = new FrontOfficer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Front Officer | Subject List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
        <a href="../../../../models/frontofficer.php?logout=1" class="nav-link" onclick="return confirm('Are you sure?')">Log out</a>
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
              <a href="../../Directors/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Directors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Directors/Register/Register.php" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>Register Directors</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Subject -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Subjects
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Subjects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Add/Add.php" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>Add Subjects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../EnrolledStudents/List.php" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>View Enrolled Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../AssignedLecturers/List.php" class="nav-link">
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
            <h1>Subject List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../Dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Subjects</li>
              <li class="breadcrumb-item active">Manage Subjects</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php if(isset($_SESSION['response'])){?>
                <div class="alert alert-<?=$_SESSION['response']?> alert-dismissible fade show" role="alert">
                  <?=$_SESSION['message']?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php } unset($_SESSION['response']); unset($_SESSION['message']); ?>
              <?php $list = $frontofficer->getSubjectList();?>
              <table id="subjectList" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Subject ID</th>
                    <th>Name</th>
                    <th>Medium</th>
                    <th>Fee</th>
                    <th>Type</th>
                    <th hidden>Description</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if($list==null){}else{ foreach($list as $item) {?>
                  <tr>
                    <td><?= $item['subject_id']?></td>
                    <td><?= $item['subjectname']?></td>
                    <td><?= $item['medium']?></td>
                    <td><?= $item['fee']?></td>
                    <td><?= $item['type']?></td>
                    <td hidden><?= $item['description']?></td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-success editClass" data-toggle="modal" data-target="#modal-update"><i class="far fa-edit"></i></a>
                        <a href="../../../../models/frontofficer.php?delSub=<?= $item['subject_id']?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php }}?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Subject ID</th>
                    <th>Name</th>
                    <th>Medium</th>
                    <th>Fee</th>
                    <th>Type</th>
                    <th hidden>Description</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="modal fade" id="modal-update">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Update Subject</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="updateSubject" action="../../../../models/frontofficer.php" method="POST">
                    <table width="500px" height="300px">
                      <tr hidden>
                        <div class="form-group">
                          <td><label for="subjectid">Subject ID : </label></td>
                          <td><input type="text" id="subjectid" name="subjectid" required></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="subname">Subject Name : </label></td>
                          <td>
                            <input id="subname" name="subname" required>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="medium">Medium : </label></td>
                          <td>
                            <select name="medium" id="medium" class="select2" required>
                              <option value="English">English</option>
                              <option value="Sinhala">Sinhala</option>
                              <option value="Tamil">Tamil</option>
                            </select>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="fee">Fee : </label></td>
                          <td>
                            <input id="fee" name="fee" required>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="type">Type : </label></td>
                          <td>
                            <select name="type" id="type" class="select2" required>
                              <option value="O/L">O/L</option>
                              <option value="A/L">A/L</option>
                            </select>
                          </td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="description">Description : </label></td>
                          <td>
                            <input id="description" name="description" required>
                          </td>
                        </div>
                      </tr>
                    </table>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" name="updateSubject" class="btn btn-info">Update</button>
                      <button type="button" class="btn btn-default float-right" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


        </div>
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
<!-- DataTables  & Plugins -->
<script src="../../../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../../dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#subjectList").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#subjectList_wrapper .col-md-6:eq(0)');
  });

  $('.editClass').on('click', function() {
    // $('#modal-default').modal('show');

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function () {
      return $(this).text();
    }).get();

    document.getElementById('subjectid').value = data[0];
    document.getElementById('subname').value = data[1];
    document.getElementById('medium').value = data[2];
    document.getElementById('fee').value = data[3];
    document.getElementById('type').value = data[4];
    document.getElementById('description').value = data[5];
  });
</script>
</body>
</html>
<?php
}
else
{
  header('location:../../Login.php');
}
?>
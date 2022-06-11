<?php
include('../../../../models/lecturer.php');
include('../../../../models/subject.php');
if(isset($_SESSION['id']))
{
  $lecturer = new Lecturer();
  $subject = new Subject();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lecturer | Offline Class List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
        <a href="../../../../models/lecturer.php?logout=1" class="nav-link" onclick="return confirm('Are you sure?')">Log out</a>
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
          <a href="#" class="d-block"><?=$lecturer->getName($_SESSION['id'])?></a>
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
        <!-- Classes -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-address-book"></i>
            <p>
              Classes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../ManageOnline/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Online Class</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Offline Class</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Attendance -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
              Attendance
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Attendance/StudentOnlineAttendance/List.php" class="nav-link">
                <i class="nav-icon fas fa-pen"></i>
                <p>Update Student Online Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Attendance/OnlineAttendance/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Online Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Attendance/OfflineAttendance/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Offline Attendance</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Register -->
        <li class="nav-item">
          <a href="../../Register/Register.php" class="nav-link">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              Register for a Subject
            </p>
          </a>
        </li>
        <!-- Homeworks -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Homeworks
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Homeworks/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Homeworks</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Homeworks/Submissions/Submission.php" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>Homework Submissions</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Learning Modules -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Learning Modules
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../LearningModule/Manage/List.php" class="nav-link">
                <i class="nav-icon far fa-edit"></i>
                <p>Manage Learning Modules</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Payments -->
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              Payments
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Payments/View/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Payments</p>
              </a>
            </li>
          </ul>
        </li> -->
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
            <h1>Offline Class List</h1>
            <div class="row mt-4">
              <div class="col-md-4">
                <button type="button" class="btn btn-block btn-primary text-left" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i> Add Offline Class</button>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../Dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Classes</li>
              <li class="breadcrumb-item active">Manage Offline Class</li>
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
              <?php $list = $lecturer->getOfflinelist($_SESSION['id'])?>
              <table id="offlineList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Subject</th>
                  <th>Hall No</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Start Time</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if($list==null){}else{ foreach($list as $item) {?>
                <tr>
                  <td><?= $item['of_cls_id']?></td>
                  <td><?= $item['subjectname']?></td>
                  <td><?= $item['hallno']?></td>
                  <td><?= $item['date']?></td>
                  <td><?= $item['duration']?></td>
                  <td><?= $item['starttime']?></td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-success editClass" data-toggle="modal" data-target="#modal-update"><i class="far fa-edit"></i></a>
                      <a href="../../../../models/offline_class.php?delClass=<?= $item['of_cls_id']?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                <?php }}?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Subject</th>
                  <th>Hall No</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Start Time</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="modal fade" id="modal-add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Offline Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="offlineclass" action="../../../../models/offline_class.php" method="POST">
                  <table width="500px" height="300px">
                    <tr>
                      <div class="form-group">
                        <td><label for="subname">Subject Name : </label></td>
                        <td>
                          <?php $list = $subject->getRegSubNameL($_SESSION['id'])?>
                          <select name="subname" class="form-control select2" style="width: 50%;" required>
                            <?php if($list==null){} else { foreach($list as $item) {?>
                            <option><?= $item['subjectname']?></option>
                            <?php }}?>
                          </select>
                        </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="hallno">Hall No : </label></td>
                        <td><input type="text" name="hallno" required></td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="date">Date : </label></td>
                        <td>
                          <div class="col-6" style="padding-left: 0px; padding-right: 0px;">
                            <div class="input-group date" data-target-input="nearest">
                              <input id="date" name="date" type="text" class="form-control datetimepicker-input" data-target="#date" placeholder="Select a Date" required>
                              <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="duration">Duration : </label></td>
                        <td><input type="number" name="duration" value="" id="duration" required></input><label> Hour/s</label></td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="starttime">Start time : </label></td>
                        <td>
                          <div class="col-6" style="padding-left: 0px; padding-right: 0px;">
                            <div class="input-group starttime" data-target-input="nearest">
                              <input id="starttime" name="starttime" type="text" class="form-control datetimepicker-input" data-target="#starttime" placeholder="Select a time" required>
                              <div class="input-group-append" data-target="#starttime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </div>
                    </tr>
                  </table>
                  <div class="modal-footer justify-content-between">
                    <button type="submit" name="offlineclass" class="btn btn-info">Add</button>
                    <button type="button" class="btn btn-default float-right" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-update">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Offline Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="uofflineclass" action="../../../../models/offline_class.php" method="POST">
                  <table width="500px" height="300px">
                    <tr hidden>
                      <div class="form-group">
                        <td><label for="uclassid">Class ID : </label></td>
                        <td><input type="text" id="uclassid" name="uclassid"></td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="usubname">Subject Name : </label></td>
                        <td>
                          <?php $list = $subject->getRegSubNameL($_SESSION['id'])?>
                          <select id="usubname" name="usubname" class="form-control select2" style="width: 50%;" required>
                            <?php if($list==null){} else { foreach($list as $item) {?>
                              <option><?= $item['subjectname']?></option>
                            <?php }}?>
                          </select>
                        </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="uhallno">Hall No : </label></td>
                        <td><input id="uhallno" type="text" name="uhallno" required></td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="udate">Date : </label></td>
                        <td>
                          <div class="col-6" style="padding-left: 0px; padding-right: 0px;">
                            <div class="input-group udate" data-target-input="nearest">
                              <input id="udate" name="udate" type="text" value="" class="form-control datetimepicker-input" data-target="#udate" placeholder="Select a Date" required>
                              <div class="input-group-append" data-target="#udate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="uduration">Duration : </label></td>
                        <td><input type="number" name="uduration" value="" id="uduration" required></input><label> Hour/s</label></td>
                      </div>
                    </tr>
                    <tr>
                      <div class="form-group">
                        <td><label for="ustarttime">Start time : </label></td>
                        <td>
                          <div class="col-6" style="padding-left: 0px; padding-right: 0px;">
                            <div class="input-group ustarttime" data-target-input="nearest">
                              <input id="ustarttime" name="ustarttime" type="text" value="" class="form-control datetimepicker-input" data-target="#ustarttime" placeholder="Select a time" required>
                              <div class="input-group-append" data-target="#ustarttime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </div>
                    </tr>
                  </table>
                  <div class="modal-footer justify-content-between">
                    <button type="submit" name="updateOfflineclass" class="btn btn-info">Update</button>
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
<script src="../../../../plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../../dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#offlineList").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#offlineList_wrapper .col-md-6:eq(0)');
  });

  $('#date').datetimepicker({
    format: 'Y-MM-DD',
    minDate: 'now'
  });

  $('#udate').datetimepicker({
    format: 'Y-MM-DD',
    minDate: 'now'
  });

  $('#starttime').datetimepicker({
    format: 'hh:mm:ss'
  });

  $('#ustarttime').datetimepicker({
    format: 'hh:mm:ss'
  });

  $('.editClass').on('click', function() {
    // $('#modal-default').modal('show');

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function () {
      return $(this).text();
    }).get();

    document.getElementById('uclassid').value = data[0];
    document.getElementById('uhallno').value = data[2];
    document.getElementById('udate').value = data[3];
    document.getElementById('uduration').value = data[4];
    document.getElementById('ustarttime').value = data[5];
  });

</script>
</body>
</html>
<?php
}
else
{
  header('location:./Login.php');
}
?>
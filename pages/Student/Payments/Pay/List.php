<?php
include('../../../../models/student.php');
if(isset($_SESSION['id']))
{
  $student = new Student();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student | Class Fees List</title>

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
        <a href="../../../../models/student.php?logout=1" class="nav-link" onclick="return confirm('Are you sure?')">Log out</a>
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
          <a href="#" class="d-block"><?=$student->getName($_SESSION['id'])?></a>
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
        <li class="nav-item">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
            <p>
              Classes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../Classes/OnlineClass/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Online Class</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../Classes/OfflineClass/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Offline Class</p>
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
          </ul>
        </li>
        <!-- Learning Modules -->
        <li class="nav-item">
          <a href="../../LearningModule/List.php" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Learning Modules
            </p>
          </a>
        </li>
        <!-- Payments -->
        <!-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              Payments
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../View/List.php" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>View Payments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon far fa-credit-card"></i>
                <p>Pay Class Fees</p>
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
            <h1>Class Fees List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../Dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Payments</li>
              <li class="breadcrumb-item active">Pay Class Fees</li>
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
              <?php
              include('../../../../models/payment.php');
              $payment = new Payment();
              $list = $payment->getStudentPayments($_SESSION['id'])?>
              <table id="paymentList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th hidden>Pay ID</th>
                  <th>Subject</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($list==null){}else{ foreach($list as $item) {?>
                <tr>
                  <td hidden><?= $item['pay_id']?></td>
                  <td><?= $item['subjectname']?></td>
                  <td><?= $item['month']?></td>
                  <td><?= $item['amount']?></td>
                  <td><?= $item['date']?></td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-success pay" data-toggle="modal" data-target="#modal-default">Pay Now!</a>
                    </div>
                  </td>
                </tr>
                <?php }}?>
                </tbody>
                <tfoot>
                <tr>
                  <th hidden>Pay ID</th>
                  <th>Subject</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card -->
          </div>
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Pay</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="pay" action="../../../../models/payment.php" method="POST">
                    <table width="500px" height="300px">
                      <tr>
                        <div class="form-group">
                          <td><input type="text" name="pay_id" value="" id="pay_id" hidden></input></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="subject">Subject : </label></td>
                          <td><input type="text" name="subject" value="" id="subject" required readonly></input></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="month">Month : </label></td>
                          <td><input type="text" name="month" value="" id="month" required readonly></input></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="amount">Amount : </label></td>
                          <td><input type="text" name="amount" value="" id="amount" required readonly></input></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="date">Date : </label></td>
                          <td><input type="text" name="date" value="" id="date" required readonly></input></td>
                        </div>
                      </tr>
                      <tr>
                        <div class="form-group">
                          <td><label for="reamount">Re-Enter Amount : </label></td>
                          <td><input type="text" name="reamount" value="" id="reamount" required></input></td>
                        </div>
                      </tr>
                    </table>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" name="pay" class="btn btn-info">Pay</button>
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
    $("#paymentList").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#paymentList_wrapper .col-md-6:eq(0)');
  });

  $('.pay').on('click', function() {

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function () {
      return $(this).text();
    }).get();

    //console.log(data);
    document.getElementById('pay_id').value = data[0];
    document.getElementById('subject').value = data[1];
    document.getElementById('month').value = data[2];
    document.getElementById('amount').value = data[3];
    document.getElementById('date').value = data[4];
  });
</script>
</body>
</html>
<?php
}
else
{
  header('location:../Login.php');
}
?>
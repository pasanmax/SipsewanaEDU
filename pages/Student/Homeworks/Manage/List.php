<?php
include('../../../../models/student.php');
include('../../../../models/homework.php');
if(isset($_SESSION['id']))
{
  $student = new Student();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student | Homework List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
        <a href="../../../../models/student.php?logout=1" class="nav-link">Log out</a>
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
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Homeworks
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
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
        <li class="nav-item">
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
            <li class="nav-item">
              <a href="../../Payments/Pay/List.php" class="nav-link">
                <i class="nav-icon far fa-credit-card"></i>
                <p>Pay Class Fees</p>
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
            <h1>Homework List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../Dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Homework</li>
              <li class="breadcrumb-item active">Manage Homeworks</li>
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
              <?php $list = $student->getHomewrokList($_SESSION['id'])?>
              <table id="homeworkList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th hidden>HS ID</th>
                  <th hidden>ID</th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th>Created Date</th>
                  <th>Deadline Date</th>
                  <th>Submit Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($list==null){}else{ foreach($list as $item) {?>
                <tr>
                  <td hidden><?= $item['id']?></td>
                  <td hidden><?= $item['hw_id']?></td>
                  <td><?= $item['name']?></td>
                  <td><?= $item['subjectname']?></td>
                  <td><?= $item['createddate']?></td>
                  <td><?= $item['deadlinedate']?></td>
                  <td><?= $item['submitdate']?></td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <?php
                        $homework = new Homework();
                        $fileName = $homework->getFileName($item['hw_id']);
                        $path = $homework->getPath($item['hw_id']);
                        if ($fileName == null) {} else {
                          if ($path == null) {} else {
                      ?>
                      <a download="<?= $fileName ?>" href="../../../<?= $path ?><?= $fileName ?>" class="btn btn-info"><i class="fas fa-download"></i></a>
                      <?php }} ?>
                      <a href="#" class="btn btn-success upload" data-toggle="modal" data-target="#modal-default"><i class="fas fa-upload"></i></a>
                      <!-- data-toggle="modal" data-target="#modal-default"> -->
                    </div>
                  </td>
                </tr>
                <?php }}?>
                </tbody>
                <tfoot>
                <tr>
                  <th hidden>HS ID</th>
                  <th hidden>ID</th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th>Created Date</th>
                  <th>Deadline Date</th>
                  <th>Submit Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload Homework</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="hwsubmit" action="../../../../models/hw_submission.php" method="POST" enctype="multipart/form-data">
                <table width="500px" height="300px">
                  <tr>
                    <div class="form-group">
                      <td><input type="text" name="hs_id" value="" id="hs_id" hidden></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><input type="text" name="id" value="" id="id" hidden></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><label for="name">Homework Name : </label></td>
                      <td><input type="text" name="name" value="" id="name"></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><label for="subject">Subject : </label></td>
                      <td><input type="text" name="subject" value="" id="subject"></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><label for="createdate">Created Date : </label></td>
                      <td><input type="text" name="createdate" value="" id="createdate"></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><label for="deadlinedate">Deadline Date : </label></td>
                      <td><input type="text" name="deadlinedate" value="" id="deadlinedate"></input></td>
                    </div>
                  </tr>
                  <tr>
                    <div class="form-group">
                      <td><label for="uploadfile">Upload File : </label></td>
                      <td><input type="file" id="file" name="file" accept="application/pdf" required/></td>
                    </div>
                  </tr>
                </table>
                <div class="modal-footer justify-content-between">
                  <button type="submit" name="hwSubmit" class="btn btn-info">Submit</button>
                  <button type="button" class="btn btn-default float-right" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
<!-- dropzonejs -->
<script src="../../../../plugins/dropzone/min/dropzone.min.js"></script>
<script>
  $(function () {
    $("#homeworkList").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#homeworkList_wrapper .col-md-6:eq(0)');
  });

  // // DropzoneJS Demo Code Start
  // Dropzone.autoDiscover = false

  // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  // var previewNode = document.querySelector("#template")
  // previewNode.id = ""
  // var previewTemplate = previewNode.parentNode.innerHTML
  // previewNode.parentNode.removeChild(previewNode)

  // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  //   url: "upload.php", // Set the url
  //   thumbnailWidth: 80,
  //   thumbnailHeight: 80,
  //   parallelUploads: 20,
  //   acceptedFiles: ".pdf,.docx,.doc,",
  //   previewTemplate: previewTemplate,
  //   autoQueue: false, // Make sure the files aren't queued until manually added
  //   previewsContainer: "#previews", // Define the container to display the previews
  //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  // })

  // // Update the total progress bar
  // myDropzone.on("totaluploadprogress", function(progress) {
  //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  // })

  // myDropzone.on("sending", function(file) {
  //   // Show the total progress bar when upload starts
  //   document.querySelector("#total-progress").style.opacity = "1"
  // })

  // // Hide the total progress bar when nothing's uploading anymore
  // myDropzone.on("queuecomplete", function(progress) {
  //   document.querySelector("#total-progress").style.opacity = "0"
  // })

  $('.upload').on('click', function() {
    // $('#modal-default').modal('show');

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function () {
      return $(this).text();
    }).get();

    //console.log(data);
    document.getElementById('hs_id').value = data[0];
    document.getElementById('id').value = data[1];
    document.getElementById('name').value = data[2];
    document.getElementById('subject').value = data[3];
    document.getElementById('createdate').value = data[4];
    document.getElementById('deadlinedate').value = data[5];
    //$('#name').html(data[1]);
    // $('#subject').html(data[2]);
    // $('#createdate').html(data[3]);
    // $('#deadlinedate').html(data[4]);

    //on modal closing
    // $('#modal-default').on('hidden.bs.modal', function () {
    //   myDropzone.removeAllFiles(true)
    //   console.clear()
    // })
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
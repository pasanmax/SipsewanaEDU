<?php
include('../../models/subject.php');
$subject = new Subject();
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lecturer | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
  <div class="card card-primary">
    <div class="card-header">
      <?php if(isset($_SESSION['response'])){?>
        <div class="alert alert-<?=$_SESSION['response']?> alert-dismissible fade show" role="alert">
          <?=$_SESSION['message']?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } unset($_SESSION['response']); unset($_SESSION['message']); ?>
      <div class="register-logo">
        <a href="#"><b>Lecturer</b>Registration</a>
      </div>
    </div>
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register as a new Lecturer</p>

      <div id="stepper" class="bs-stepper linear">
        <div class="bs-stepper-header" role="tablist">
          <div class="step active" data-target="#personal-info">
            <button type="button" class="step-trigger" role="tab" id="personal-info-trigger" aria-controls="personal-info" aria-selected="true">
              <span class="bs-stepper-circle">1</span>
              <span class="bs-stepper-label">Personal Info</span>
            </button>
          </div>
          <div class="bs-stepper-line"></div>
          <div class="step" data-target="#address">
            <button type="button" class="step-trigger" role="tab" id="address-trigger" aria-controls="address" aria-selected="false" disabled="disabled">
              <span class="bs-stepper-circle">2</span>
              <span class="bs-stepper-label">Address</span>
            </button>
          </div>
          <div class="bs-stepper-line"></div>
          <div class="step" data-target="#bank-info">
            <button type="button" class="step-trigger" role="tab" id="bank-info-trigger" aria-controls="bank-info" aria-selected="false" disabled="disabled">
              <span class="bs-stepper-circle">3</span>
              <span class="bs-stepper-label">Bank Info</span>
            </button>
          </div>
          <div class="bs-stepper-line"></div>
          <div class="step" data-target="#subject-info">
            <button type="button" class="step-trigger" role="tab" id="subject-info-trigger" aria-controls="subject-info" aria-selected="false" disabled="disabled">
              <span class="bs-stepper-circle">4</span>
              <span class="bs-stepper-label">Subject Info</span>
            </button>
          </div>
          <div class="bs-stepper-line"></div>
          <div class="step" data-target="#finish">
            <button type="button" class="step-trigger" role="tab" id="finish-trigger" aria-controls="finish" aria-selected="false" disabled="disabled">
              <span class="bs-stepper-circle">5</span>
              <span class="bs-stepper-label">Finish</span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <form id="register" class="needs-validation" method="POST" action="../../models/lecturer.php" novalidate>
            <div id="personal-info" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="personal-info-trigger">
              <div class="form-group">
                <label for="fname">First Name
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                <div class="invalid-feedback">First Name is required</div>
              </div>
              <div class="form-group">
                <label for="lname">Last Name
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                <div class="invalid-feedback">Last Name is required</div>
              </div>
              <div class="form-group">
                <label for="dob">Date of Birth
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <div class="input-group date" data-target-input="nearest">
                    <input id="dob" type="text" name="dob" class="form-control datetimepicker-input" data-target="#dob" placeholder="Date of Birth" required>
                    <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <div class="invalid-feedback">Birth Date is required</div>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <div class="invalid-feedback">Email is required</div>
              </div>
              <div class="form-group">
                <label for="cno">Contact Number
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <div class="input-group">
                  <input id="cno" name="cno" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <div class="invalid-feedback">Contact Number is required</div>
                </div>
              </div>
              <div class="form-group">
                <label for="certi">Certification
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="certi" name="certi" placeholder="Certification" required>
                <div class="invalid-feedback">Certification is required</div>
              </div>
              <button type="button" class="btn btn-primary btn-next-form">Next</button>
            </div>
            <div id="address" role="tabpanel" class="bs-stepper-pane" aria-labelledby="address-trigger">
              <div class="form-group">
                <label for="adrsl1">Address Line 1
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="adrsl1" name="adrsl1" placeholder="Address Line 1" required>
                <div class="invalid-feedback">Address Line 1 is required</div>
              </div>
              <div class="form-group">
                <label for="adrsl2">Address Line 2
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="adrsl2" name="adrsl2" placeholder="Address Line 2" required>
                <div class="invalid-feedback">Address Line 2 is required</div>
              </div>
              <div class="form-group">
                <label for="adrsl3">Address Line 3
                </label>
                <input type="text" class="form-control" id="adrsl3" name="adrsl3" placeholder="Address Line 3">
              </div>
              <div class="form-group">
                <label for="city">City
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                <div class="invalid-feedback">City is required</div>
              </div>
              <div class="form-group">
                <label for="district">District
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="district" name="district" placeholder="District" required>
                <div class="invalid-feedback">District is required</div>
              </div>
              <div class="form-group">
                <label for="zipcode">Zipcode
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="number" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" required>
                <div class="invalid-feedback">Zipcode is required</div>
              </div>
              <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
              <button type="button" class="btn btn-primary btn-next-form">Next</button>
            </div>
            <div id="bank-info" role="tabpanel" class="bs-stepper-pane" aria-labelledby="bank-info-trigger">
              <div class="form-group">
                <label for="accountno">Account Number
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="number" class="form-control" id="accountno" name="accountno" placeholder="Account Number" required>
                <div class="invalid-feedback">Account Number is required</div>
              </div>
              <div class="form-group">
                <label for="accountname">Account Name
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="accountname" name="accountname" placeholder="Account Name" required>
                <div class="invalid-feedback">Account Name is required</div>
              </div>
              <div class="form-group">
                <label for="bankname">Bank Name
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="bankname" name="bankname" placeholder="Bank Name" required>
                <div class="invalid-feedback">Bank Name is required</div>
              </div>
              <div class="form-group">
                <label for="branchname">Branch Name
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Branch Name" required>
                <div class="invalid-feedback">Branch Name is required</div>
              </div>
              <div class="form-group">
                <label for="branchcode">Branch Code
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <input type="number" class="form-control" id="branchcode" name="branchcode" placeholder="Branch Code" required>
                <div class="invalid-feedback">Branch Code is required</div>
              </div>
              <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
              <button type="button" class="btn btn-primary btn-next-form">Next</button>
            </div>
            <div id="subject-info" role="tabpanel" class="bs-stepper-pane" aria-labelledby="subject-info-trigger">
              <div class="form-group">
                <label for="subject">Select Subject
                  <span class="text-danger font-weight-bold">*</span>
                </label>
                <?php $list = $subject->getSubjects();?>
                <select id="subject" name="subject" class="form-control select2" style="width: 100%;" required>
                  <?php if($list==null){} else { foreach($list as $item) {?>
                    <option value="<?= $item['subjectname']?>"><?= $item['subjectname']?></option>
                  <?php }}?>
                </select>
                <div class="invalid-feedback">Subject is required</div>
              </div>
              <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
              <button type="button" class="btn btn-primary btn-next-form">Next</button>
            </div>
            <div id="finish" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="finish-trigger">
              <div class="form-group">
                <h3>All Set!</h3>
                <p class="text-danger font-weight-bold">You will get your login username and password through e-mail after Front Officer confirmation.</br>After clicking Register you will redirect to pay the registration fees.</br>Thank you!</p>
                <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                <button type="submit" name="regLecturer" class="btn btn-success">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <a href="./Login.php" class="text-center">Already have an Account? Sign In</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.card -->


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Register -->
<script src="../../dist/js/pages/Lecturer/register.js"></script>
<!-- Bootstrap Validate -->
<script src="../../plugins/bootstrap-validate/bootstrap-validate.js"></script>
<!-- Page specific script -->
<script>
  function register() {
    $("#register").submit();
  }
</script>
</body>
</html>

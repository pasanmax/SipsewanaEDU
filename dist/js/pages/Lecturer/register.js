var stepper;
document.addEventListener('DOMContentLoaded', function () {
    var stepperFormEl = document.querySelector('#stepper');
    stepper = new Stepper(stepperFormEl);
    //Date picker
    $('#dob').datetimepicker({
          format: 'L'
    });
    $('[data-mask]').inputmask();
    $('.select2').select2();
    $('#subject').val(null).trigger('change');

    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'));
    var fname = document.getElementById('fname');
    var lname = document.getElementById('lname');
    var dob = document.getElementById('dob');
    var email = document.getElementById('email');
    var cno = document.getElementById('cno');
    var certi = document.getElementById('certi');
    var adrsl1 = document.getElementById('adrsl1');
    var adrsl2 = document.getElementById('adrsl2');
    var city = document.getElementById('city');
    var district = document.getElementById('district');
    var zipcode = document.getElementById('zipcode');
    var accountno = document.getElementById('accountno');
    var accountname = document.getElementById('accountname');
    var bankname = document.getElementById('bankname');
    var branchname = document.getElementById('branchname');
    var branchcode = document.getElementById('branchcode');
    var subject = document.getElementById('subject');
    var form = stepperFormEl.querySelector('.bs-stepper-content form');

    btnNextList.forEach(function (btn) {
        btn.addEventListener('click', function () {
          stepper.next()
        })
    });

    stepperFormEl.addEventListener('show.bs-stepper', function (event) {
        form.classList.remove('was-validated')
        var nextStep = event.detail.indexStep
        var currentStep = nextStep
    
        if (currentStep > 0) {
          currentStep--
        }
    
        var stepperPan = stepperPanList[currentStep]
    
        if ((stepperPan.getAttribute('id') === 'personal-info' && !fname.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && !lname.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && !dob.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && !email.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && !cno.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && !certi.value.length)
        || (stepperPan.getAttribute('id') === 'address' && !adrsl1.value.length)
        || (stepperPan.getAttribute('id') === 'address' && !adrsl2.value.length)
        || (stepperPan.getAttribute('id') === 'address' && !city.value.length)
        || (stepperPan.getAttribute('id') === 'address' && !district.value.length)
        || (stepperPan.getAttribute('id') === 'address' && !zipcode.value.length)
        || (stepperPan.getAttribute('id') === 'bank-info' && !accountno.value.length)
        || (stepperPan.getAttribute('id') === 'bank-info' && !accountname.value.length)
        || (stepperPan.getAttribute('id') === 'bank-info' && !bankname.value.length)
        || (stepperPan.getAttribute('id') === 'bank-info' && !branchname.value.length)
        || (stepperPan.getAttribute('id') === 'bank-info' && !branchcode.value.length)
        || (stepperPan.getAttribute('id') === 'subject-info' && !subject.value.length)) {
          event.preventDefault()
          form.classList.add('was-validated');
        }
    });
});
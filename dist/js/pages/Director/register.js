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

    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'));
    var fname = document.getElementById('fname');
    var lname = document.getElementById('lname');
    var dob = document.getElementById('dob');
    var email = document.getElementById('email');
    var cno = document.getElementById('cno');
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
        || (stepperPan.getAttribute('id') === 'personal-info' && !cno.value.length)) {
          event.preventDefault()
          form.classList.add('was-validated');
        }
    });
});
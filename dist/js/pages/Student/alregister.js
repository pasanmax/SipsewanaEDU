var stepper;
document.addEventListener('DOMContentLoaded', function () {
    var stepperFormEl = document.querySelector('#stepper');
    stepper = new Stepper(stepperFormEl);
    //Date picker
    $('#dob').datetimepicker({
      format: 'Y-MM-DD'
    });
    $('[data-mask]').inputmask();
    $('.select2').select2();
    $('#subject').val(null).trigger('change');
    $('#relationship').val(null).trigger('change');

    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'));
    var fname = document.getElementById('fname');
    var lname = document.getElementById('lname');
    var dob = document.getElementById('dob');
    var nicno = document.getElementById('nicno');
    var email = document.getElementById('email');
    var cno = document.getElementById('cno');
    var school = document.getElementById('school');
    var adrsl1 = document.getElementById('adrsl1');
    var adrsl2 = document.getElementById('adrsl2');
    var city = document.getElementById('city');
    var district = document.getElementById('district');
    var zipcode = document.getElementById('zipcode');
    var gfname = document.getElementById('gfname');
    var glname = document.getElementById('glname');
    var gemail = document.getElementById('gemail');
    var gcno = document.getElementById('gcno');
    var relationship = document.getElementById('relationship');
    var subject = document.getElementById('subject');
    var form = stepperFormEl.querySelector('.bs-stepper-content form');
    var allowLetters = /^[A-Za-z\s]*$/;
    var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var numbers = /^[0-9]+$/;
    var numtxt = /^[a-zA-Z0-9_@.,/#&+-\/\s]*$/;

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
    
        if ((stepperPan.getAttribute('id') === 'personal-info' && (!fname.value.length || !fname.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'personal-info' && (!lname.value.length || !lname.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'personal-info' && !dob.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && (!nicno.value.length || !nicno.value.match(numtxt)))
        || (stepperPan.getAttribute('id') === 'personal-info' && (!email.value.length || !email.value.match(mailFormat)))
        || (stepperPan.getAttribute('id') === 'personal-info' && !cno.value.length)
        || (stepperPan.getAttribute('id') === 'personal-info' && (!school.value.length || !school.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'address' && (!adrsl1.value.length || !adrsl1.value.match(numtxt)))
        || (stepperPan.getAttribute('id') === 'address' && (!adrsl2.value.length || !adrsl2.value.match(numtxt)))
        || (stepperPan.getAttribute('id') === 'address' && (!city.value.length || !city.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'address' && (!district.value.length || !district.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'address' && (!zipcode.value.length || !zipcode.value.match(numbers)))
        || (stepperPan.getAttribute('id') === 'guardian-info' && (!gfname.value.length || !gfname.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'guardian-info' && (!glname.value.length || !glname.value.match(allowLetters)))
        || (stepperPan.getAttribute('id') === 'guardian-info' && (!gemail.value.length || !gemail.value.match(mailFormat)))
        || (stepperPan.getAttribute('id') === 'guardian-info' && !gcno.value.length)
        || (stepperPan.getAttribute('id') === 'guardian-info' && !relationship.value.length)
        || (stepperPan.getAttribute('id') === 'subject-info' && !subject.value.length)) {
          event.preventDefault()
          form.classList.add('was-validated');
        }
    });
    bootstrapValidate('#fname', 'alpha:You can enter characters only');
    bootstrapValidate('#lname', 'alpha:You can enter characters only');
    bootstrapValidate('#nicno', 'min:10:Enter a valid NIC no');
    bootstrapValidate('#email', 'email:Enter a valid email');
    bootstrapValidate('#school', 'alphanumeric:You can enter characters only');
    bootstrapValidate('#adrsl1', 'alphanumeric:You can enter characters only');
    bootstrapValidate('#adrsl2', 'alphanumeric:You can enter characters only');
    bootstrapValidate('#adrsl3', 'alphanumeric:You can enter characters only');
    bootstrapValidate('#city', 'alpha:You can enter characters only');
    bootstrapValidate('#district', 'alpha:You can enter characters only');
    bootstrapValidate('#gfname', 'alpha:You can enter characters only');
    bootstrapValidate('#glname', 'alpha:You can enter characters only');
    bootstrapValidate('#gemail', 'email:Enter a valid email');
});
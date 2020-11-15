$(function () {
  //Horizontal form basic
  $('#wizard_horizontal').steps({
    headerTag: 'h2',
    bodyTag: 'section',
    transitionEffect: 'slideLeft',
    onInit: function (event, currentIndex) {
      setButtonWavesEffect(event);
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      setButtonWavesEffect(event);
    }
  });

  //Vertical form basic
  $('#wizard_vertical').steps({
    headerTag: 'h2',
    bodyTag: 'section',
    transitionEffect: 'slideLeft',
    stepsOrientation: 'vertical',
    onInit: function (event, currentIndex) {
      setButtonWavesEffect(event);
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      setButtonWavesEffect(event);
    }
  });

  //Advanced form with validation
  var form = $('#wizard_with_validation').show();
  form.steps({
    headerTag: 'h3',
    labels: {
        current: "current step:",
        pagination: "Pagination",
        finish: "Tamamla",
        next: "İleri",
        previous: "Geri",
        loading: "Yükleniyor ..."
    },
    enableFinishButton: false,
    bodyTag: 'fieldset',
    transitionEffect: 'slideLeft',
    onInit: function (event, currentIndex) {
      // $.AdminOreo.input.activate();

      //Set tab width
      var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
      var tabCount = $tab.length;
      $tab.css('width', (100 / tabCount) + '%');

      form.validate().settings.ignore = ':disabled';

      //set button waves effect
      setButtonWavesEffect(event);
    },
    onStepChanging: function (event, currentIndex, newIndex) {
      if ($("#txtGuncellemeVarMi").val() == 0) {
        return false;
      }
      if(currentIndex == 1 && $("#txtYedekAlindiMi").val() == 0){
        if (newIndex > currentIndex) {
          return false;
        }
      }

      if (currentIndex > newIndex) { return true; }

      if (currentIndex < newIndex) {
        form.find('.body:eq(' + newIndex + ') label.error').remove();
        form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
      }


      form.validate().settings.ignore = ':disabled,:hidden';
      return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      setButtonWavesEffect(event);
    },
    onFinishing: function (event, currentIndex) {
      $("#wizard_with_validation .actions a[href='#finish']").prop("disabled",true);
      form.validate().settings.ignore = ':disabled';
      return form.valid();
    },
    onFinished: function (event, currentIndex) {
      swal("Good job!", "Submitted!", "success");
    }
  });

  form.validate({
    highlight: function (input) {
      $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
      $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
      $(element).parents('.form-group').append(error);
    },
    rules: {
      'confirm': {
        equalTo: '#password'
      }
    }
  });
});

function setButtonWavesEffect(event) {
  $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
  $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}

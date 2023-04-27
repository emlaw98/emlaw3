$(document).ready(function () {
  let currentLanguageApplication = $('html').attr('lang');
   
  if ($('.select2').length) {
    $('.select2').select2({
      // placeholder: '---Chọn---',
      // allowClear: true
    });
  }

  if ($('.datetimepicker').length) {
    $.datetimepicker.setLocale(currentLanguageApplication);
    $('.datetimepicker').datetimepicker({ format:'d/m/Y', timepicker:false});
  }

  if ($('#date_timepicker_start').length) {
    $('#date_timepicker_start').datetimepicker({
      format:'d/m/Y',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
       })
      },
      timepicker:false
     });

    $('#date_timepicker_end').datetimepicker({
      format:'d/m/Y',
      onShow:function( ct ){
        this.setOptions({
        minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
        })
      },
      timepicker:false
    });
  }

  if ($('#date_timepicker_start_discount').length) {
    $('#date_timepicker_start_discount').datetimepicker({
      format:'d/m/Y H:i',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#date_timepicker_end_discount').val()?jQuery('#date_timepicker_end_discount').val():false
       })
      },
      timepicker:true
     });

    $('#date_timepicker_end_discount').datetimepicker({
      format:'d/m/Y H:i',
      onShow:function( ct ){
        this.setOptions({
        minDate:jQuery('#date_timepicker_start_discount').val()?jQuery('#date_timepicker_start_discount').val():false
        })
      },
      timepicker:true
    });
  }

  var swalConfig = {

  };
});

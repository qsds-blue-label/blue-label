$(document).ready(function () {
    $('#data-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
    });               
  var clear_timer;
  $("#sample_form").on("submit", function (event) {
      $("#message").html("");
      event.preventDefault();
      $.ajax({
          url: "import-file",
          method: "post",
          data: new FormData(this),
          //dataType:"json",
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              $("#import").val("Importing");
          },
          success: function (data) {  console.log('data', data)
              toastr.success('Votes successfully imported.')
              setTimeout(() => {
                 location.reload();
              }, 2000);
          },
      });
  });
});

$(function() {
    $('[data-toggle="datepicker"]').datepicker({
      autoHide: true,
      zIndex: 2048,
      format: 'yyyy-mm-dd'
    });
  });
  $(document).on('change', 'input[type="file"]', function (event) { 
      var filename = $(this).val();
      if (filename == undefined || filename == ""){
      $(this).next('.custom-file-label').html('No file chosen');
      }
      else 
      { $(this).next('.custom-file-label').html(event.target.files[0].name); }
  });

  function import_details(){
      alert("Under Construction")
  }
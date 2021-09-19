$(function() {
    //$('[data-toggle="tooltip"]').tooltip();
    var oTable = $('#data-table').DataTable({
        "bDestroy": true,
        "aaSorting": [],
        "ordering": false,
        "searching": true,
        "iDisplayLength": 2,
        "aLengthMenu": [
            [10, 50, 100, 200, 500],
            [10, 50, 100, 200, 500]
        ],
        /* "responsive": true,*/
        "processing": true,
        // "scrollX": true, // enables horizontal scrolling    
        /* "stateSave": true,*/ //restore table state on page reload, 
        "oLanguage": {
            "sSearch": '<div class="input-group">_INPUT_<span class="input-group-addon"><i class="icon-search"></i></span></div>',
            "sSearchPlaceholder": "Search...",
            //"sProcessing": '' + image + '',
        },
        "serverSide": true,
        "columnDefs": [
            { className: 'center', targets: 4, "width": "100px" }
        ],
        "ajax": {
            url: "./import-list",
            type: 'POST',
            dataFilter: function(data) { ///console.log(data);
                var json = jQuery.parseJSON(data);
                json.recordsTotal = json.recordsFiltered;
                json.recordsFiltered = json.recordsFiltered;
                json.data = json.data;
                return JSON.stringify(json);
            }


        }

    });
});
$(document).ready(function() {
    var clear_timer;
    $("#import-form").on("submit", function(event) {
        if (document.getElementById("date_of_votes").value.length == 0) {
            toastr.error('Please select a date.')
            return false;
        }

        if (document.getElementById("inputGroupFile01").value.length == 0) {
            toastr.error('Please select a excel file to upload.')
            return false;
        }

        $(".overlay").show();
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
            beforeSend: function() {
                $("#import").val("Importing");
            },
            success: function(data) {  console.log(data)
                // $("#modal-upload").modal('hide')
                // toastr.success('Votes successfully imported.')
                // setTimeout(() => {
                //     location.reload();
                // }, 2000);
            },
            error: function(data) {
                $("#modal-upload").modal('hide')
                toastr.error('Error was occured while uploading your file. PLease contact administrator.')
                $(".overlay").hide();
            }
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

$(document).on('change', 'input[type="file"]', function(event) {
    var filename = $(this).val();
    if (filename == undefined || filename == "") {
        $(this).next('.custom-file-label').html('No file chosen');
    } else {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    }
});

function view_details(el) {
    window.location = `import-details?id=${parseInt($(el).attr('imported_id'))}`;
    
}

function delete_import(el) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        $(".overlay").show();
        $.ajax({
            url: "delete-imported",
            method: "get",
            data: { imported_id:  parseInt($(el).attr('imported_id')) },
            success: function (data) { 
                setTimeout(() =>{
                    $(".overlay").hide();
                    $(el).closest('tr').hide();
                    Swal.fire(
                        'Deleted!',
                        'Imported file has been deleted.',
                        'success'
                    )
                }, 1500)
            },
            error: function (data) {  
                $(".overlay").hide();
                toastr.error('Error was occured while uploading your file. PLease contact administrator.')
            }
        });
          
      })
}
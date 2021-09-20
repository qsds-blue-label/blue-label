// $(document).ready(function () {
//   $('#data-table').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": true,
//   });               
// });

$(function() {
    //$('[data-toggle="tooltip"]').tooltip();
    var oTable = $('#data-table').DataTable({
        "bDestroy": true,
        "aaSorting": [],
        "ordering": false,
        "searching": true,
        "iDisplayLength": 10,
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
        // "columnDefs": [
        //     { className: 'center', targets: 8, "width": "100px" }
        // ],
        "ajax": {
            url: "./votes-list",
            type: 'POST',
            dataFilter: function(data) {
                var json = jQuery.parseJSON(data);
                json.recordsTotal = json.recordsFiltered;
                json.recordsFiltered = json.recordsFiltered;
                json.data = json.data;
                return JSON.stringify(json);
            }
  
  
        }
  
    });
  });


function details(){
  alert("Under Construction")
}
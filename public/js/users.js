
function changeEnabled(data, id) {
    console.log(data.checked)
    console.log(id)

    const dataToSend = {
        id: id,
        value: data.checked ? 1 : 0,
    };

    console.log('dataToSend', dataToSend)

    $.ajax({
        url: "update-status",
        method: "post",
        data: dataToSend,
        dataType:"json",
        success: function (res) {  
            console.log(res)
        },
        error: function (err) {  
        }
    });
}

function validatePassword() {
    const con_pass = $('#confirmPass').val();
    const pass = $('#pass').val();

    console.log(con_pass === pass)
    if(con_pass !== pass) {
        console.log('not same')
        $('#subButton').attr("disabled", true);;
    } else {
        console.log('same')
    }
}


$('#data-table-users').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
});  

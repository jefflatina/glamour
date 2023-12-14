$(document).ready(function(){
    $('table').DataTable({
    "searching": true,
    "paging": true,
    "order": [[0, "desc" ]],
    "ordering": true,
        "columnDefs": [{
        "targets": [0, 7, 8],
        "orderable": false
        }]
    });
});
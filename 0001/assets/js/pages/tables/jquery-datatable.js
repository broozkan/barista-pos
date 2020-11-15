$(function () {
  $('.js-basic-example').DataTable( {
        "language": {
            "lengthMenu": "Her sayfada _MENU_ kayıt göster",
            "zeroRecords": "Eşleşme bulunamadı!",
            "info": " _PAGE_ sayfadan _PAGES_ gösteriliyor",
            "infoEmpty": "Kayıt Yok",
            "infoFiltered": "(_MAX_ veriden filtrelendi)",
            "search": "Ara:",
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "pageLength": 25
        }
    } );
    // $('.js-basic-example').DataTable();

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});

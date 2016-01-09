/**
 * Created by Denis on 01/01/2016.
 */

$(function () {
    $('table').DataTable();

    var table = $('table').DataTable();

    $('#solicitacaosearch-id').on('change', function () {

        var busca = $( "#solicitacaosearch-id option:selected" ).text();

        if(busca=="Todas")
        {
            busca='';
        }
        table
            .columns( 7 )
            .search( busca )
            .draw();
    });

});


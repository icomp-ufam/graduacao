/**
 * Created by Denis on 01/01/2016.
 */

$(function () {

    var table = $('table').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ itens por página",
            "zeroRecords": "Nenhum item encontrado.",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum item encontrado.",
        }
    });

    $('#solicitacaosearch-id').bind('load change', function () {

        var busca = $( "#solicitacaosearch-id option:selected" ).text();

        if( busca == "Todas")
        {
            busca = '';
        }
        table.columns( 7 ).search( busca ).draw();
    });

});


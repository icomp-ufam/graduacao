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
            "infoFiltered": "(filtrado de _MAX_  resultado(s) no total)"
        }


    });

    $('#solicitacaosearch-id').on('load change', function () {

        var busca = $( "#solicitacaosearch-id option:selected" ).text();
        console.log(busca);
		
        var COLUNA =  $('table thead th').length -2;  //coluna do status na tabela

        if( busca == "Todas")
        {	
            busca = '';
            table.columns(COLUNA).search( busca ).draw();
        }
        else
        {
            table.column(COLUNA).search("^" + busca + "$", true, false, true).draw();
        }

    });

    $("#solicitacaosearch-id").trigger('load');

});


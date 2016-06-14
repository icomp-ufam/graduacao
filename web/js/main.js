$(function(){

	//get the click of the yii2fullcalendar
	$(document).on('click', '.fc-day', function()
	{
		var date = $(this).attr('data-date');
		var id = location.search.split('id=')[1];

		$.get('index.php?r=frequencia/create', {'idmonitoria':id, 'date':date},function(data)
		{
			$('#modalRegistrarFrequencia').modal('show')
			.find('#modalRegistrarFrequenciaContent')
			.html(data)
		}
		);
	}
	);

	//get the click of the imprimirFrequenciasButton
	$('#imprimirFrequenciasButton').click(function ()
	{
		$('#modalImprimirFrequencias').modal('show')
			.find('#modalImprimirFrequenciasContent')
			.load($(this).attr('value')
		);
	}
	);

	/*
	$('#imprimirFrequenciasButton').click(function ()
	{
		var id = location.search.split('id=')[1];

		$.get('index.php?r=frequencia/modalimprimirfrequencias', {'idmonitoria':id},function(data)
		{
			$('#modalImprimirFrequencias').modal('show')
			.find('#modalImprimirFrequenciasContent')
			.html(data)
		}
		);
	}
	);
	*/

	//get the click of the planoSemestralButton
	$('#planoSemestralButton').click(function ()
	{
		$('#modalFiltroRelatorio').modal('show')
			.find('#modalFiltroRelatorioContent')
			.load($(this).attr('value')
		);
	}
	);

	//get the click of the gerarQuadroGeralButton
	$('#gerarQuadroGeralButton').click(function ()
	{
		$('#modalFiltroRelatorio').modal('show')
			.find('#modalFiltroRelatorioContent')
			.load($(this).attr('value')
		);
	}
	);

	//get the click of the frequenciaGeralButton
	$('#frequenciaGeralButton').click(function ()
	{
		$('#modalFiltroRelatorio').modal('show')
			.find('#modalFiltroRelatorioContent')
			.load($(this).attr('value')
		);
	}
	);
}
);

var url_servidor = 'http://www.iztec.com.br/financeiro/server';

function validaSessao()
{
	//VERICA LOCAL STORAGE - SESSAO
	if(window.localStorage.getItem('login') && window.localStorage.getItem('usuario_id'))
	{			
		var login = window.localStorage.getItem('login');
		var usuario_id = window.localStorage.getItem('usuario_id');		
		
		var sessao = {'login':login,'usuario_id':usuario_id};
		return sessao;		
	}
	else
	{
		window.localStorage.setItem('msg','Faça login');
		window.location = 'index.html';
	}
}


//CARREGA O COMBO CATEGORIA RECEITAS PELO TIPO DA CATEGORIA RECEITA OU DESPESA TIPO_ID
function selectCategorias(tipo_id,opcao_todos)
{	
	$.ajax(
	{
		url:url_servidor+"/monta_select_categoria.php",
		type:"post",
		dataType:"json",
		data:(tipo_id > 0) ? "tipo_id="+tipo_id+"&usuario_id="+usuario_id : "usuario_id="+usuario_id,
		success: function(data)
		{
			if (data.length > 0)
			{
				var option='<option value="">Escolha a Categoria</option>';
				if(opcao_todos==1 || tipo_id==0){option +='<option value="0">Todos</option>'};
				
				$.each(data, function(i, obj){
					option += '<option value="'+obj.id+'">'+obj.descricao+'</option>';
				})
				
				$("#categoria").html(option);				  
			}
			else
			{
			   alert('Você ainda não tem categorias. Primeiro cadastre suas categorias');
			}
			
		}
	});
}


//////////////////////// CORDOVA DATEPICKER /////////////////////

function abrirData(elm, options)
{
	event.stopPropagation();
	var currentField = $(elm);
	var opts = options || {};
	var minVal = opts.min || 0;
	var maxVal = opts.max || 0;

	/*
	var myNewDate = Date.parse(currentField.val()) || new Date();
	if(typeof myNewDate === "number") {			
		myNewDate = new Date (myNewDate);
	}
	*/

	window.plugins.datePicker.show({
		date : new Date(),
		mode : 'date',
		minDate: Date.parse(minVal),
		maxDate: Date.parse(maxVal)
	}, 
	function(returnDate)
	{
		if(returnDate !== "")
		{
			var newDate = new Date(returnDate);
			var dia=newDate.getDate();
			var mes=newDate.getMonth()+1;
			var ano=newDate.getFullYear();
			data = dia + '/' + mes + '/' + ano;
			
			currentField.val(data);
		}
		currentField.blur();
	});
}

////////////////////////////////////////////////////////////////////////


$( document ).ready(function()
{

	//FUNÇÃO QUE ORDENA DATA CORRETAMENTE
	jQuery.extend( jQuery.fn.dataTableExt.oSort,
	{
		 "date-br-pre": function ( a ) {
		  if (a == null || a == "") {
		   return 0;
		  }
		  var brDatea = a.split('/');
		  return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
		 },

		 "date-br-asc": function ( a, b ) {
		  return ((a < b) ? -1 : ((a > b) ? 1 : 0));
		 },

		 "date-br-desc": function ( a, b ) {
		  return ((a < b) ? 1 : ((a > b) ? -1 : 0));
		 }
	});
	
	
	//MASCARAS
	//$("#data").mask("99/99/9999");
	//$("#data_de").mask("99/99/9999");
	//$("#data_ate").mask("99/99/9999");

	
});


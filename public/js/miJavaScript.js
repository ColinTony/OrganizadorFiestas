$(document).ready(function(){
	function menu()
	{
		var horaSelect = $("#hora").val();
		var hora = horaSelect[0]+horaSelect[1];
		var desayunos = "<option value='Desayuno de la casa'>Desayuno de la casa</option>\n<option value='Desayuno mexicano'>Desayuno mexicano</option>"+
		"\n<option value='Desayuno saludable'>Desayuno saludable</option>";
		var comidas = "<option value='Comida de la casa'>Comida de la casa</option>\n<option value='Comida mexicana'>Comida mexicana</option>"
		+"\n<option value='Comida vegana'>Comida vegana</option>";
		var cenas = "<option value='Cena especial'>Cena especial</option>\n<option value='Cena mexicana'>Cena mexicana</option>"+
		"\n<option value='Cena saludable'>Cena saludable</option>";
		hora = parseInt(hora);

		$("#menu").empty();
		
		if( (hora >= 9) && (hora<12)){
			$("#menu").append(desayunos);
			activarBtn();
		}else
		{
			if((hora >= 12) && (hora<17)){
				$("#menu").append(comidas);
				activarBtn();
			}else
			{
				if((hora>=17) && (hora<23)){
					$("#menu").append(cenas);
					activarBtn();
				}
				else
				{
					alertEditado();
				}
			}
		}

	}
	function activarBtn()
	{
		$("#crear").attr("disabled",false);
	}
	function activar()
	{
		$('#menu').attr("disabled", false);
		menu();
	}
	function alertEditado()
	{
		$('#exampleModalCenter').modal("show");
		$("#crear").attr("disabled",true);
	}
	$("#hora").on("change",activar);
});
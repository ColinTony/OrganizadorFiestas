$(document).ready(function(){
	function menu()
	{
		var horaSelect = $("#hora").val();
		var hora = horaSelect[0]+horaSelect[1];
		var desayunos = "<option>Desayuno de la casa</option>\n<option>Desayuno mexicano</option>\n<option>Desayuno saludable</option>";
		var comidas = "<option>Comida de la casa</option>\n<option>Comida mexicana</option>\n<option>Comida vegana</option>";
		var cenas = "<option>Cena especial</option>\n<option>Cena mexicana</option>\n<option>Cena saludable</option>";
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
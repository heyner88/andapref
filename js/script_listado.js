$(document).ready(function(){

	$('select[name=departamento]').val(50);
	ciudades()

	$('select[name=departamento]').on('change',function(){
		ciudades();
		$('select[name=barrio] option').eq(0).nextAll().remove();
	})

	function ciudades()
	{
		$.getJSON('libs/acc_inmueble',{opc:'ciudad',departamento:$('select[name=departamento]').val()}).done(function(data){
			$('select[name=ciudad] option').eq(0).nextAll().remove();
			$.each(data.Ciudades,function(i,dat){
				$('select[name=ciudad]').append('<option value="'+dat.id+'">'+dat.nombre+'</option>');
			})
		})
	}

	$('select[name=ciudad]').on('change',function(){
		$.getJSON('libs/acc_inmueble',{opc:'barrio',ciudad:$(this).val()}).done(function(data){
			$('select[name=barrio] option').eq(0).nextAll().remove();
			$.each(data.Barrios,function(i,dat){
				$('select[name=barrio]').append('<option>'+dat.barrio+'</option>');
			})
		})
	})

	$('.detalle').live('click',function(){
		$('<form action="inmuebles-detalle" method="POST">' +
   				 '<input type="hidden" name="codigo" value="' + $(this).prop('id')+ '">' +
   		'</form>').submit();
	})


})
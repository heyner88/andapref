$(document).ready(function(){
maxf = 0;
tempcod=0,tempprop=0;

	$('select[name=departamento]').val(50);
	ciudades()

	$('select[name=departamento]').on('change',function(){
		ciudades();
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

	$('.agrega').live('click',function(){
		if(maxf<9)
		{
			$(this).parent().after('<div class="subir tmp"><input type="file"> <a href="javascript:void(0)"  class="agrega">Mas</a></div>');
			maxf++;
		}
	})

	$('#nuevo_inm').on('submit',function(e){
		e.preventDefault();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);
		var dataprov = new FormData();
		dataprov.append( 'action','libs/acc_inmueble');

		fdestacada = document.getElementById('destaca');
		destaca = fdestacada.files[0];
		dataprov.append('destacada',destaca);

		$.each($("input[type=file]").not('#destaca'), function(i, obj) {
	        $.each(obj.files,function(j,file){
	            dataprov.append('foto['+i+']', file);
	        })
		});

		otradata = $('#nuevo_inm').serializeArray();
		$.each(otradata,function(key,input){
    	    dataprov.append(input.name,input.value);
    	});
		dataprov.append('opc','crear');

		 $.ajax({
	        url:'libs/acc_inmueble',
	        data: dataprov,
	        cache: false,
	        contentType: false,
	        processData: false,
	        type: 'POST',
	        dataType:'json',
	        success: function(data){
		        if(data.status == 'correcto')
		        {
		        	$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Inmueble Creado!</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2500);
			        $('input').not('input[type=submit]').val('');
			        $('textarea').val('');
			        $('select').val('');
			        $('.tmp').remove();
			        $('select[name=ciudad] option').eq(0).nextAll().remove();
			    }
			    else
			    	if(data.status == 'error2')
			    	{
			    		$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Código del Inmueble ya existe</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
				        $('input[name=codigo]').css('background','rgba(250, 128, 114, 0.21)');
				        tempcod =  $('input[name=codigo]').val();
			    	}
			    else
			    	if(data.status == 'error1')
			    	{
			    		$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Id Propietario no existe</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
				        $('input[name=id_prop]').css('background','rgba(250, 128, 114, 0.21)');
				        tempprop =  $('input[name=id_prop]').val();
			    	}
	  		}
	    });
	})

	$('input[name=codigo]').on('blur',function(){
		if($(this).val()!=tempcod)
			$(this).removeAttr('style');
	})

	$('input[name=id_prop]').on('blur',function(){
		if($(this).val()!=tempprop)
			$(this).removeAttr('style');
	})

});
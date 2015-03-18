$(document).ready(function(){

	$('#inm').on('blur',function(){
		inmueble = $(this).val();
		if(inmueble!='')
		{
			$.getJSON('libs/acc_inmueble',{opc:'carga_basic',codigo:inmueble}).done(function(data){
				if(data.Inmueble=='error1')
				{
					$('#id_prop, #propietario, input[name=valor], #cod_inm').val('');
						$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Inmueble ya esta ligado</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
				        $('input[type=submit]').attr('disabled',true);
				        $('#inm').css('background','rgba(250, 128, 114, 0.21)');
				}
				else if(data.Inmueble=='error2')
					{
						$('#id_prop, #propietario, input[name=valor], #cod_inm').val('');
						$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Inmueble no existe</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
				        $('input[type=submit]').attr('disabled',true);
				        $('#inm').css('background','rgba(250, 128, 114, 0.21)');
					}
				else
				{
					$.each(data.Inmueble,function(i,dat){
						$('#id_prop').val(dat.Id_prop);
						$('#propietario').val(dat.Nom_prop+' '+dat.Apel_prop);
						$('input[name=valor]').val(dat.Val_inm);
					})
					$('#cod_inm').val(inmueble);
					$('input[type=submit]').removeAttr('disabled');
					$('#inm').removeAttr('style');
				}
			})
		}

	})


	$('#liga').on('submit',function(e){
		e.preventDefault();
		$('#fondo').remove();
		$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
		$('#fondo').append("<div style='position: absolute;top: 50%;left: 50%;'><img src='images/esperar.gif'></div>");
		setTimeout(function() {
        	$('#fondo').fadeIn('fast',function(){
            $('#rp').fadeIn();
         	});
        }, 400);

		data = $('#liga').serializeArray();
		data.push({name:'opc',value:'ligar'});

		$.post('libs/acc_inmueble',data).done(function(data){
			if(data== 'correcto')
			{
				$('#fondo').remove();
				$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
				$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Correcto!</span></div>");
				setTimeout(function() {
		        	$('#fondo').fadeIn('fast',function(){
		            $('#rp').animate({'top':'350px'},50).fadeIn();
		         	});
		        }, 400);
		        setTimeout(function() {
		            $("#rp").fadeOut();
		            $('#fondo').fadeOut('fast');
		        }, 3000);
		        $('input').not('input[type=submit]').val('');
			}
			 else
		    	if(data == 'error')
		    	{
		    		$('#fondo').remove();
					$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! El codigo del arrendatario ya existe</span></div>");
					setTimeout(function() {
			        	$('#fondo').fadeIn('fast',function(){
			            $('#rp').animate({'top':'350px'},50).fadeIn();
			         	});
			        }, 400);
			        setTimeout(function() {
			            $("#rp").fadeOut();
			            $('#fondo').fadeOut('fast');
			        }, 2500);
		    	}
		});

	})

});
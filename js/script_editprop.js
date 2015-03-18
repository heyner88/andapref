$(document).ready(function(){
carga = 0;
contr_elm = [];

	$('#id_prop').on('blur',function(){
		propiet = $(this).val();
		if(propiet!='' && propiet!=carga)
		{
			$.getJSON('libs/acc_propietario',{opc:'carga_basic',id_prop:propiet}).done(function(data){
				contr_elm = [];
				if(data.Propietario=='false')
					{
						$('input').not('#id_prop, input[type=submit]').val('');
						$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Propietario no existe</span></div>");
						setTimeout(function() {
				        	$('#fondo').fadeIn('fast',function(){
				            $('#rp').animate({'top':'350px'},50).fadeIn();
				         	});
				        }, 400);
				        setTimeout(function() {
				            $("#rp").fadeOut();
				            $('#fondo').fadeOut('fast');
				        }, 2500);
				        carga ='/&·(·';
				        $('#existente').empty();
				        $('input[type=submit]').attr('disabled',true);
				        $('#id_prop').css('background','rgba(250, 128, 114, 0.21)');
					}
				else
				{
					$('#existente').empty();
					$.each(data.Propietario,function(i,dat){
						if(dat.Arc_cont==undefined)
						{
							$('input[name=nombre]').val(dat.Nom_prop);
							$('input[name=apellido]').val(dat.Apel_prop);
							$('input[name=telefono]').val(dat.Tel_prop);
							$('input[name=movil]').val(dat.Mov_prop);
							$('input[name=email]').val(dat.Email_prop);
							$('input[name=direccion]').val(dat.Direc_prop);
						}
						else
						{
							$('#existente').append('<div><a href="'+dat.Arc_cont.replace('.','')+'" target="blank">'+dat.Arc_cont.substr(20)+'</a>      <a href="javascript:void(0)" id="'+dat.Id_cont+'" class="elm">Borrar</a></div><br>');
						}
						carga = propiet;
						$('input[type=submit]').removeAttr('disabled');
					})
					$('#id_prop').attr('readonly',true).css('background','rgba(202, 202, 202, 0.24)');
				}

			})
		}
		else
			$('#id_prop').attr('readonly',true).css('background','rgba(202, 202, 202, 0.24)');
	})

	$('#id_prop').on('dblclick',function(){
		$(this).removeAttr('readonly style');
	})

	$('.elm').live('click',function(){
		contr_elm.push($(this).prop('id'));
		$(this).parent().fadeOut(function(){
			$(this).remove();
		})
		$(this).parent().next('br').remove();
	})


	$('.agrega').live('click',function(){
		$(this).parent().after('<div class="subir tmp"><input type="file" name="contrato[]"> <a href="javascript:void(0)" class="agrega">Mas</a></div>');
	})

	$('#edit_prov').on('submit',function(e){
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
		dataprov.append( 'action','libs/acc_propietario');
		$.each($("input[type=file]"), function(i, obj) {
	        $.each(obj.files,function(j,file){
	            dataprov.append('contrato['+i+']', file);
	        })
		});

		otradata = $('#edit_prov').serializeArray();
		$.each(otradata,function(key,input){
    	    dataprov.append(input.name,input.value);
    	});

    	$.each(contr_elm,function(i,id){
    	    dataprov.append('elim[]',id);
    	});

		dataprov.append('opc','editar');

		 $.ajax({
	        url:'libs/acc_propietario',
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
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Cambios Realizados!</span></div>");
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
			        $('.tmp').remove();
			        $('#existente').empty();
			        carga = 0;
			        $('#id_prop').removeAttr('readonly style');
			    }
			    else
			    	if(data.status == 'error')
			    	{
			    		$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error!</span></div>");
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
	  		}
	    });
	})

});
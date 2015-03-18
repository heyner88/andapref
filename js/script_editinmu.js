$(document).ready(function(){
carga = 0;
maxf = 0;
tempprop=0;
tempciu = 0;
gale_elm = [];

	$('#cod_inm').on('blur',function(){
		codigin = $(this).val();
		if(codigin!='' && codigin!=carga)
		{
			$.getJSON('libs/acc_inmueble',{opc:'carga_editar',codigo:codigin}).done(function(data){
				gale_elm = [];
				if(data.Inmueble=='error')
					{
						$('input, textarea, select').not('#cod_inm, input[type=submit]').val('');
						$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El inmueble no existe</span></div>");
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
				        $('#destacada, #existentes').empty();
				        $('.tmp').remove();
				        $('input[type=submit]').attr('disabled',true);
					}
				else
				{
					maxf = 0;
				    $('#destacada, #existentes').empty();
					$.each(data.Inmueble,function(i,dat){
						if(dat.Id_img==undefined)
						{
							$('input[name=id_prop]').val(dat.Id_prop);
							$('select[name=tipo]').val(dat.Tipo_inm);
							$('input[name=mt2]').val(dat.Mt2_inm);
							$('input[name=habitaciones]').val(dat.Habit_inm);
							$('input[name=banos]').val(dat.Ban_inm);
							$('select[name=parqueadero]').val(dat.Parq_inm);
							$('select[name=servicio]').val(dat.Serv_inm);
							$('input[name=valor]').val(dat.Val_inm);
							$('select[name=departamento]').val(dat.Dep_inm);
							ciudades();
							tempciu = dat.Ciu_inm;
							$('input[name=barrio]').val(dat.Barr_inm);
							$('input[name=ux]').val(dat.X_inm);
							$('input[name=uy]').val(dat.Y_inm);
							$('textarea[name=des1]').val(dat.Desc1_inm);
							$('textarea[name=des2]').val(dat.Desc2_inm);
							$('#destacada').append('<div><a href="'+dat.Img_inm.replace('.','')+'" target="blank">'+dat.Img_inm.substr(20)+'</a></div>');
						}
						else
						{
							$('#existentes').append('<div><a href="'+dat.Arc_gal.replace('.','')+'" target="blank">'+dat.Arc_gal.substr(18)+'</a>      <a href="javascript:void(0)" id="'+dat.Id_img+'" class="elm">Borrar</a></div><br>');
							maxf++;
						}
						carga = codigin;
						$('input[type=submit]').removeAttr('disabled');
					})
					$('#cod_inm').attr('readonly',true).css('background','rgba(202, 202, 202, 0.24)');
				}

			})
		}
		else
			$('#cod_inm').attr('readonly',true).css('background','rgba(202, 202, 202, 0.24)');
	})

	$('#cod_inm').on('dblclick',function(){
		$(this).removeAttr('readonly style');
	})

	$('.elm').live('click',function(){
		gale_elm.push($(this).prop('id'));
		$(this).parent().fadeOut(function(){
			$(this).remove();
		})
		$(this).parent().next('br').remove();
	})

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
			if(tempciu!=0)
				$('select[name=ciudad]').val(tempciu);
		})
	}

	$('.agrega').live('click',function(){
		if(maxf<9)
		{
			$(this).parent().after('<div class="subir tmp"><input type="file"> <a href="javascript:void(0)"  class="agrega">Mas</a></div>');
			maxf++;
		}
	})

	$('#edit_inm').on('submit',function(e){
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

		otradata = $('#edit_inm').serializeArray();
		$.each(otradata,function(key,input){
    	    dataprov.append(input.name,input.value);
    	});

    	$.each(gale_elm,function(i,id){
    	    dataprov.append('elim[]',id);
    	});

		dataprov.append('opc','editar');

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
			        $('input, textarea, select').not('input[type=submit]').val('');
			        $('.tmp').remove();
			        $('#destacada, #existentes').empty();
			        carga = 0;
			        $('#cod_inm').removeAttr('readonly style');
			        $('select[name=ciudad] option').eq(0).nextAll().remove();
			    }
			    else
			    	if(data.status == 'error')
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

	$('input[name=id_prop]').on('blur',function(){
		if($(this).val()!=tempprop)
			$(this).removeAttr('style');
	})

});
$(document).ready(function(){
tempprop=0;

	$('.agrega').live('click',function(){
		$(this).parent().after('<div class="subir tmp"><input type="file" name="contrato[]"> <a href="javascript:void(0)" class="agrega">Mas</a></div>');
	})

	$('#nuevo_prov').on('submit',function(e){
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

		otradata = $('#nuevo_prov').serializeArray();
		$.each(otradata,function(key,input){
    	    dataprov.append(input.name,input.value);
    	});
		dataprov.append('opc','crear');

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
					$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Proveedor Creado!</span></div>");
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
			    }
			    else
			    	if(data.status == 'error')
			    	{
			    		$('#fondo').remove();
						$('body').append("<div class='fondo' id='fondo' style='display:none;'></div>");
						$('#fondo').append("<div class='rp' style='display: none; text-align: center' id='rp'><span>Error! - El Id propietario ya existe</span></div>");
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
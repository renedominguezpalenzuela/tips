jQuery(document).ready(function($)
{
	if (typeof wpcf7 !== 'undefined')
	{
		wpcf7.cached = 0;

		let successTitleMSG = $('#successTitleMSG').val();
		let successTextMSG = $('#successTextMSG').val();

		let errorMSG = $('#errorTextMSG').val();

		document.addEventListener( 'wpcf7invalid', function( event )
		{
			$('.wpcf7-response-output').attr('class', 'wpcf7-response-output alert alert-danger');
		    
		    if(errorMSG == '')
		    	errorMSG = 'Por favor diligencia los campos requeridos';

		    swal({
		  		title: '<div class="textSuccessFormulario">' + errorMSG + '</div>',
		  		type: 'error',
		  		showCloseButton: true,
		  		showConfirmButton: false,
			});

		}, false );

		document.addEventListener( 'wpcf7spam', function( event )
		{
			$('.wpcf7-response-output').attr('class', 'wpcf7-response-output alert alert-warning');
		}, false );

		document.addEventListener( 'wpcf7mailfailed', function( event )
		{
			$('.wpcf7-response-output').attr('class', 'wpcf7-response-output alert alert-warning');
		}, false );

		document.addEventListener( 'wpcf7mailsent', function( event )
		{
			$('.wpcf7-response-output').attr('class', 'wpcf7-response-output alert alert-success');

		    swal({
		  		title: '<div class="textSuccessFormulario">' + successTitleMSG + '</div>',
		  		text: successTextMSG,
		  		type: 'success',
		  		showCloseButton: true,
		  		showConfirmButton: false,
			});

		}, false );

		document.addEventListener( 'wpcf7submit', function( event )
		{
			HoldOn.close();
		}, false );

		$('form.wpcf7-form').on('submit',function()
		{
			var options = {
			     theme:"sk-rect",
			     message:'Enviando, Espere un momento',
			     textColor:"white"
			};

			HoldOn.open(options);
		});

		let formulario = document.getElementById('modalFormulario');

		if(formulario)
		{
			let modalFormulario = new bootstrap.Modal(formulario,
			{
				backdrop: true,
				keyboard: false
			});
		}
	}
});
jQuery(document).ready(function($)
{
	let disabledElement = document.getElementById("disabledElement");

	if(disabledElement)
	{
		disabledElement.addEventListener("click",function()
		{
		    swal({
		  		title: '<div class="textSuccessFormulario">Debes autenticarte para enviar una iniciativa</div>',
		  		type: 'error',
		  		showCloseButton: true,
		  		showConfirmButton: false,
				html:
				'<a href="' + loginURL + '" class="wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-12">Iniciar Sesión</a>',
			});
		});

		$('#disabledElement').find('input[type=text], input[type=email], textarea').attr('readonly','readonly');

		$('#disabledElement').find('input[type=file], input[type=checkbox],checkbox').attr('disabled','disabled');
	}
});
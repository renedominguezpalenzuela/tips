jQuery(document).ready(function ($)
{
  var url_params = new URLSearchParams(window.location.search);

  if(url_params.has('editar-perfil'))
  {
		$('.tabsMiPerfilArr').hide();
    $('#tabsMiPerfilArr4').show();
    $('.inputMiPerfilArr').removeClass('checked');
    $('#content-4').parent().addClass('checked');

    $("html").animate
    (
      {
        scrollTop: $("#tabsMiPerfilArr4").offset().top
      },
      800 //speed
    );
  }

	if(document.getElementById('editPhoto'))
	{
	  let options =
	  {
	    theme: "sk-rect",
	    message: 'Guardando, espere un momento',
	    textColor: "white"
	  };

    var avatar = document.getElementById('editPhoto');
    var image = document.getElementById('imagePhoto');
    var input = document.getElementById('updateFoto');
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modalPhoto');
    var cropper;

	  $( "#editUserForm" ).validate(
	  {
	    rules:
	    {
	      'updateTelefono':
	      {
	        required: true,
	        maxlength: 10,
	        minlength: 10,
	        digits: true
	      },
	      'updateEmail':
	      {
	        required: true,
	        custom_email: true
	      },
	      'userIdentidadGenero':
	      {
	        required: true,
	        valueNotEquals: "default"
	      },
	      'userLocalidad':
	      {
	        required: true,
	        valueNotEquals: "default"
	      },
	      'userOrganiacionCiudadana':
	      {
	        required: true,
	        valueNotEquals: "default"
	      },
	      'userPoblacionDiferencial':
	      {
	        required: true,
	        valueNotEquals: "default"
	      },
	      'updatePass':
	      {
	        minlength: 8,
	        maxlength: 25,
	        strong_password_optional: true
	      },
	      'updatePassConfirm':
	      {
	        equalTo: '[name="updatePass"]'
	      },
	    },
	    messages:
	    {
	      'updateTelefono':
	      {
	        required: "El campo es obligatorio",
	        maxlength: "El teléfono debe contener 10 digitos",
	        minlength: "El teléfono debe contener 10 digitos",
	        digits: "El campo solo acepta números"
	      },
	      'updateEmail':
	      {
	        required: "El campo es obligatorio",
	        email: "El campo debe tener formato de email correcto"
	      },
	      'userIdentidadGenero':
	      {
	        required: "El campo es obligatorio",
	        valueNotEquals: "El campo es obligatorio"
	      },
	      'userLocalidad':
	      {
	        required: "El campo es obligatorio",
	        valueNotEquals: "El campo es obligatorio"
	      },
	      'userOrganiacionCiudadana':
	      {
	        required: "El campo es obligatorio",
	        valueNotEquals: "El campo es obligatorio"
	      },
	      'userPoblacionDiferencial':
	      {
	        required: "El campo es obligatorio",
	        valueNotEquals: "El campo es obligatorio"
	      },
	      'updatePass':
	      {
	        maxlength: "El campo debe contener al entre 8 y 25 caracteres",
	        minlength: "El campo debe contener al entre 8 y 25 caracteres",
	      },
	      'updatePassConfirm':
	      {
	       	equalTo: "El campo debe coincidir con la contraseña"
	      },
	    },
	    submitHandler: function(form)
	    {
	      HoldOn.open(options);

	      var formData = new FormData(document.getElementById("editUserForm"));

	      for (var pair of formData.entries())
	      {
	        if(pair[0] == 'userPoblacionDiferencial')
	        {
	        	let temp = $.parseJSON(pair[1]);
						
						Object.entries(temp).forEach(([key, value]) =>
						{
		          formData.append('userPoblacionDiferencial[]', value['value']);
						});
	        }

	        if(pair[0] == 'userOrganiacionCiudadana')
	        {
	        	let temp = $.parseJSON(pair[1]);

						Object.entries(temp).forEach(([key, value]) =>
						{
		          formData.append('userOrganiacionCiudadana[]', value['value']);
						});
	        }
	      }

	      jQuery.ajax(
	      {
	        type: 'POST',
	        url: ajaxURL,
	        processData: false,
	        contentType: false,
	        data: formData,
	        success: function (response)
	        {
	          let data = null;

	          try
	          {
	            data = JSON.parse(response);
	          } catch (e) {}

	          if (data != null)
	          {
	              HoldOn.close();
	              swal('<div class="textSuccessFormulario">' + data.title + '</div>', data.message, data.type);
	          }
	          else
	          {
	            HoldOn.close();
	            swal('<div class="textSuccessFormulario">Error</div>', "Ocurrio un error", "error");
	          }
	        },
	        error: function (response)
	        {
	          console.log(response);
	          HoldOn.close();
	        },
	        fail: function (response)
	        {
	          console.log("Fail");
	          console.log(response);
	          HoldOn.close();
	        }
	      });
	    }
	  });

    input.addEventListener('change', function (e)
    {
      var files = e.target.files;

      var done = function (url)
      {
        input.value = '';
        image.src = url;
        $alert.hide();
        $modal.modal('show');
      };
      var reader;
      var file;
      var url;

      if (files && files.length > 0)
      {
        file = files[0];

        if (URL)
        {
          done(URL.createObjectURL(file));
        }
        else if (FileReader)
        {
          reader = new FileReader();
          reader.onload = function (e)
          {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }
    });

    $modal.on('shown.bs.modal', function ()
    {
      cropper = new Cropper(image,
      {
        aspectRatio: 1,
        viewMode: 3,
	  		cropBoxResizable: false,
      });
    }).on('hidden.bs.modal', function ()
    {
      cropper.destroy();
      cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function ()
    {
      var initialAvatarURL;
      var canvas;

      $modal.modal('hide');

      if (cropper)
      {
        canvas = cropper.getCroppedCanvas({
          width: 320,
          height: 320,
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        canvas.toBlob(function (blob)
        {
				  let file = new File([blob], "avatar.png", { type: blob.type });
				  const dT = new DataTransfer();
				  dT.items.add( file );
				  
				  document.getElementById("updateFoto").files = dT.files;

		      var formData = new FormData(document.getElementById("editUserForm"));
          
          $progress.hide();

          $progress.hide();
        });
      }
    });

	  jQuery('#userOrganiacionCiudadana').tagify(
	  {
	    enforceWhitelist: true,
	    whitelist : JSON.parse(jQuery('#userOrganiacionCiudadana').attr('data-tags')),
	    dropdown : 
	    {
	      maxItems: Infinity,
	      enabled: 0,            // show suggestion after 1 typed character
	      fuzzySearch: false,    // match only suggestions that starts with the typed characters
	      position: 'all',      // position suggestions list next to typed text
	      caseSensitive: false,   // allow adding duplicate items if their case is different
	    },
	  }).on('add', function(e, tag)
	  {
	  }).on('removetag', function(e, tag)
	  {
	  });

	  jQuery('#userPoblacionDiferencial').tagify(
	  {
	    enforceWhitelist: true,
	    whitelist : JSON.parse(jQuery('#userPoblacionDiferencial').attr('data-tags')),
	    dropdown : 
	    {
	      maxItems: Infinity,
	      enabled: 0,            // show suggestion after 1 typed character
	      fuzzySearch: false,    // match only suggestions that starts with the typed characters
	      position: 'all',      // position suggestions list next to typed text
	      caseSensitive: false,   // allow adding duplicate items if their case is different
	    },
	  }).on('add', function(e, tag)
	  {
	  }).on('removetag', function(e, tag)
	  {
	  });

	}

});
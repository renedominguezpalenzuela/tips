jQuery(document).ready(function ($)
{
  let options =
  {
    theme: "sk-rect",
    message: 'Cargando, espere un momento',
    textColor: "white"
  };

  $('#registerDate').datepicker({
      language: "es",
      endDate: '+1d',
      datesDisabled: '+1d',
      autoclose: true,
      enableOnReadonly: false,
  });

  $('.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue)
  {
    let elementName = jQuery(this).attr('name');
    let lengthSelect = jQuery('#' + elementName + ' > option').length - 1;

    if(isSelected == true)
    {
      jQuery(this).nextAll('.dropdown-toggle:first').removeClass('is-invalid');
      jQuery('#' + elementName + '-error').hide();
      
      if(elementName == 'registerOrganiacionCiudadana')
      {
        if(clickedIndex == lengthSelect - 1)
        {
          if(!jQuery('#otraOrganizacion').hasClass('visible'))
          {
            jQuery('#otraOrganizacion').addClass('visible');
            jQuery('#otraOrganizacion').show();
          }
          else
          {
            jQuery('#otraOrganizacion').removeClass('visible');
            jQuery('#otraOrganizacion').hide();
          }
        }
      }
    }
    else
    {
      if(previousValue.length == 1)
      {
        jQuery(this).nextAll('.dropdown-toggle:first').addClass('is-invalid');
        jQuery('#' + elementName + '-error').text('El campo es obligatorio').show();
      }

      if(elementName == 'registerOrganiacionCiudadana')
      {
        if(clickedIndex == lengthSelect - 1)
        {
          if(!jQuery('#otraOrganizacion').hasClass('visible'))
          {
            jQuery('#otraOrganizacion').addClass('visible');
            jQuery('#otraOrganizacion').show();
          }
          else
          {
            jQuery('#otraOrganizacion').removeClass('visible');
            jQuery('#otraOrganizacion').hide();
          }
        }
      }
    }
  });

  let recoverPassEl = document.getElementById('modalRecoverPass');

  if(recoverPassEl)
  {
    let modalRecoverPass = new bootstrap.Modal(recoverPassEl,
    {
      backdrop: true,
      keyboard: false
    });
  }

  let registerEl = document.getElementById('modalRegister');

  if(registerEl)
  {
    let modalRegister = new bootstrap.Modal(registerEl,
    {
      backdrop: true,
      keyboard: false
    });
  }

  $( "#loginForm" ).validate(
  {
    rules:
    {
      'email':
      {
        required: true,
        custom_email: true
      },
      'password':
      {
        required: true,
        strong_password: true
      }
    },
    messages:
    {
      'email':
      {
        required: "El campo es obligatorio",
        email: "El campo debe tener formato de email correcto"
      },
      'password':
      {
        required: "El campo es obligatorio",
      }
    },
    submitHandler: function(form)
    {
      HoldOn.open(options);

      jQuery.ajax(
      {
        type: 'POST',
        url: ajaxURL,
        data:
        {
          action: 'ajax_login',
          email: $("#loginEmail").val(),
          pass: $("#loginPass").val()
        },
        success: function (response)
        {
          let data = null;

          try
          {
            data = JSON.parse(response);
          } catch (e) {}

          if (data != null)
          {
            if(data.type == 'success')
            {
              jQuery(location).attr('href', data.redirectURL);
            }
            else
            {
              HoldOn.close();
              swal('<div class="textSuccessFormulario">' + data.title + '</div>', data.message, data.type);
            }
          }
          else
          {
            HoldOn.close();
            swal('<div class="textSuccessFormulario">Error</div>', "Ocurrio un error", "error");
          }
        },
        error: function (response)
        {
          HoldOn.close();
        },
        fail: function (response)
        {
          HoldOn.close();
        }
      });
    }
  });

  $( "#recoverPassForm" ).validate(
  {
    rules:
    {
      'email':
      {
        required: true,
        custom_email: true
      },
    },
    messages:
    {
      'email':
      {
        required: "El campo es obligatorio",
        email: "El campo debe tener formato de email correcto"
      },
    },
    submitHandler: function(form)
    {
      HoldOn.open(options);

      jQuery.ajax(
      {
        type: 'POST',
        url: ajaxURL,
        data:
        {
          action: 'ajax_recover_pass',
          email: $("#recoverPassEmail").val(),
        },
        success: function (response)
        {
          HoldOn.close();
          let data = null;

          try
          {
            data = JSON.parse(response);
          } catch (e) {}

          if (data != null)
          {
            swal(data.title, data.message, data.type);
          }
          else
          {
            swal("Error", "Ocurrio un error", "error");
          }
        },
        error: function (response)
        {
          HoldOn.close();
        },
        fail: function (response)
        {
          HoldOn.close();
        }
      });
    }
  });

  if(document.getElementById('editNewUserPhoto'))
  {
    var avatar = document.getElementById('editNewUserPhoto');
    var image = document.getElementById('imagePhoto');
    var input = document.getElementById('registerFoto');
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modalPhoto');
    var cropper;

    $( "#registerForm" ).validate(
    {
      rules:
      {
        'registerName':
        {
          required: true,
        },
        'registerTipoDocumento':
        {
          required: true,
          valueNotEquals: "default"
        },
        'registerDocumento':
        {
          required: true,
        },
        'registerTelefono':
        {
          required: true,
          maxlength: 10,
          minlength: 10,
          digits: true
        },
        'registerDate':
        {
          required: true,
        },
        'registerEmail':
        {
          required: true,
          custom_email: true
        },
        'registerIdentidadGenero':
        {
          required: true,
          valueNotEquals: "default"
        },
        'registerLocalidad':
        {
          required: true,
          valueNotEquals: "default"
        },
        'registerOrganiacionCiudadana':
        {
          required: true,
          valueNotEquals: "default"
        },
        'registerPoblacionDiferencial':
        {
          required: true,
          valueNotEquals: "default"
        },
        'registerOtraOrganizacion':
        {
          required: true,
        },
        'registerAceptarRegistro':
        {
          required: true,
        },
      },
      messages:
      {
        'registerName':
        {
          required: "El campo es obligatorio",
        },
        'registerTipoDocumento':
        {
          required: "El campo es obligatorio",
          valueNotEquals: "El campo es obligatorio"
        },
        'registerDocumento':
        {
          required: "El campo es obligatorio",
        },
        'registerTelefono':
        {
          required: "El campo es obligatorio",
          maxlength: "El teléfono debe contener 10 digitos",
          minlength: "El teléfono debe contener 10 digitos",
          digits: "El campo solo acepta números"
        },
        'registerDate':
        {
          required: "El campo es obligatorio",
        },
        'registerEmail':
        {
          required: "El campo es obligatorio",
          email: "El campo debe tener formato de email correcto"
        },
        'registerIdentidadGenero':
        {
          required: "El campo es obligatorio",
          valueNotEquals: "El campo es obligatorio"
        },
        'registerLocalidad':
        {
          required: "El campo es obligatorio",
          valueNotEquals: "El campo es obligatorio"
        },
        'registerOrganiacionCiudadana':
        {
          required: "El campo es obligatorio",
          valueNotEquals: "El campo es obligatorio"
        },
        'registerPoblacionDiferencial':
        {
          required: "El campo es obligatorio",
          valueNotEquals: "El campo es obligatorio"
        },
        'registerOtraOrganizacion':
        {
          required: "El campo es obligatorio",
        },
        'registerAceptarRegistro':
        {
          required: "El campo es obligatorio",
        },
      },
      submitHandler: function(form)
      {
        HoldOn.open(options);

        var formData = new FormData(document.getElementById("registerForm"));

        for (var pair of formData.entries())
        {
          if(pair[0] == 'registerPoblacionDiferencial')
          {
            formData.append('registerPoblacionDiferencial[]', pair[1]);
          }

          if(pair[0] == 'registerOrganiacionCiudadana')
          {
            formData.append('registerOrganiacionCiudadana[]', pair[1]);
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
            console.log("Error");
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
          
          document.getElementById("registerFoto").files = dT.files;

          var formData = new FormData(document.getElementById("registerForm"));
          
          $progress.hide();

          $progress.hide();
        });
      }
    });

    $.uploadPreview(
    {
      input_field: "#registerFoto",   // Default: .image-upload
      preview_box: "#image-preview",  // Default: .image-preview
      label_field: "#image-label",    // Default: .image-label
      label_default: "Subir foto",   // Default: Choose File
      label_selected: "Cambiar foto",  // Default: Change File
      no_label: false                 // Default: false
    });
  }

});

jQuery.validator.setDefaults(
{
  highlight: function(element)
  {
    jQuery(element).closest('.wpcf7-form-control').addClass('is-invalid');
    jQuery(element).closest('.wpcf7-form-control').addClass('wpcf7-not-valid');
    
    if(jQuery(element).hasClass('wpcf7-drag-n-drop-file'))
    {
      jQuery(element).nextAll('.codedropz-upload-handler:first').addClass('is-invalid');
    }

    if(jQuery(element).hasClass('selectpicker'))
    {
      jQuery(element).nextAll('.dropdown-toggle:first').addClass('is-invalid');
    }
  },
  unhighlight: function(element)
  {
    jQuery(element).closest('.wpcf7-form-control').removeClass('is-invalid');
    jQuery(element).closest('.wpcf7-form-control').removeClass('wpcf7-not-valid');

    if(jQuery(element).hasClass('wpcf7-drag-n-drop-file'))
    {
      jQuery(element).nextAll('.codedropz-upload-handler:first').removeClass('is-invalid');
    }

    if(jQuery(element).hasClass('selectpicker'))
    {
      jQuery(element).nextAll('.dropdown-toggle:first').removeClass('is-invalid');
    }
  },
  errorElement: 'span',
  errorClass: 'text-danger label-danger',
  errorPlacement: function(error, element)
  {
      if(element.parent('.input-group').length)
      {
          error.insertAfter(element.parent());
      }
      else
      {
          error.insertAfter(element);
      }
  }
});

jQuery.validator.addMethod("custom_email", function(value, element)
{
  return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
}, "El campo debe tener formato de email correcto");

jQuery.validator.addMethod("strong_password", function (value, element)
{
    let password = value;

    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(.{8,20}$)/.test(password)))
    {
        return false;
    }
    return true;
}, function (value, element)
{
    let password = jQuery(element).val();

    if (!(/^(.{8,20}$)/.test(password))) {
        return 'La contraseña debe tener entre 8 y 20 caracteres.';
    }
    else if (!(/^(?=.*[A-Z])/.test(password))) {
        return 'La contraseña debe contener al menos una mayúscula.';
    }
    else if (!(/^(?=.*[a-z])/.test(password))) {
        return 'La contraseña debe contener al menos una minúscula.';
    }
    else if (!(/^(?=.*[0-9])/.test(password))) {
        return 'La contraseña debe contener al menos un dígito.';
    }
   
/*
    else if (!(/^(?=.*[@#$%&])/.test(password))) {
        return "Password must contain special characters from @#$%&.";
    }
*/
    return false;
});

jQuery.validator.addMethod("strong_password_optional", function (value, element)
{
    let password = value;
    
    if(password == '')
      return true;

    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(.{8,20}$)/.test(password)))
    {
        return false;
    }
    return true;
}, function (value, element)
{
    let password = jQuery(element).val();

    if (!(/^(.{8,20}$)/.test(password))) {
        return 'La contraseña debe tener entre 8 y 20 caracteres.';
    }
    else if (!(/^(?=.*[A-Z])/.test(password))) {
        return 'La contraseña debe contener al menos una mayúscula.';
    }
    else if (!(/^(?=.*[a-z])/.test(password))) {
        return 'La contraseña debe contener al menos una minúscula.';
    }
    else if (!(/^(?=.*[0-9])/.test(password))) {
        return 'La contraseña debe contener al menos un dígito.';
    }
   
/*
    else if (!(/^(?=.*[@#$%&])/.test(password))) {
        return "Password must contain special characters from @#$%&.";
    }
*/
    return false;
});

jQuery.validator.addMethod("valueNotEquals", function(value, element, arg)
{
  return arg !== value;
});

function showPassword()
{
  var x = document.getElementById("loginPass");
  
  if (x.type === "password")
  {
    x.type = "text";
  }
  else
  {
    x.type = "password";
  }
}
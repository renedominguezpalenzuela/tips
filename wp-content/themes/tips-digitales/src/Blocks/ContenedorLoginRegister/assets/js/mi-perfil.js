jQuery(document).ready(function ($)
{
  if(document.getElementById('tabsMiPerfilAb'))
  {
    var url_params = new URLSearchParams(window.location.search);

    if(url_params.has('tipo'))
    {
      let type = url_params.get('tipo');

      if(type == 'documentos')
      {
        jQuery('.btn.btn-tabs-buttons.bloque2').removeClass('checked');
        jQuery('.tabsMiPerfilAb').hide();
        jQuery('#tabsMiPerfilAb2').show();
        jQuery('.inputMiPerfilAb').prop('checked', false);
        jQuery('#content-ab-2').parent().addClass('checked');
        jQuery('#content-ab-2').prop('checked', true);

        $("html").animate
        (
          {
            scrollTop: $("#tabsMiPerfilAb2").offset().top
          },
          800 //speed
        );
      }
      else if (type == 'propuestas')
      {
        jQuery('.btn.btn-tabs-buttons.bloque2').removeClass('checked');
        jQuery('.tabsMiPerfilAb').hide();
        jQuery('#tabsMiPerfilAb3').show();
        jQuery('.inputMiPerfilAb').prop('checked', false);
        jQuery('#content-ab-3').parent().addClass('checked');
        jQuery('#content-ab-3').prop('checked', true);

        $("html").animate
        (
          {
            scrollTop: $("#tabsMiPerfilAb3").offset().top
          },
          800 //speed
        );
      }

    }
    else
    {
      $('.tabsMiPerfilAb').hide();
      $('#tabsMiPerfilAb1').show();
    }
  }

  if(document.getElementById('tabsMiPerfilArr'))
  {
    $('.tabsMiPerfilArr').hide();
    $('#tabsMiPerfilArr1').show();
  }

  $('input[type=radio][name=tabsMiPerfilArr]').click(function()
  {
    $('.btn.btn-tabs-buttons.bloque1').removeClass('checked');
    $(this).parent().addClass('checked');

    $('.tabsMiPerfilArr').hide();

    $('#' + $(this).val()).show();

    if($(this).val() == "tabsMiPerfilArr1")
    {
    }
    else if($(this).val() == "tabsMiPerfilArr2")
    {
      /*let userID = $('#calendar-user-events').attr('data-user');
      console.log("User ID");
      console.log(userID);*/
      show_calendar_user('calendar-user', 'ajax_calendar_events');
    }
    else if($(this).val() == "tabsMiPerfilArr3")
    {
      let userID = $('#calendar-user-events').attr('data-user');
      jQuery('#calendar-user-events').attr('data-loaded', "false");

      show_calendar_user('calendar-user-events', 'ajax_calendar_events_user', userID);
    }
    else if($(this).val() == "tabsMiPerfilArr4")
    {
    }
  });

  $('input[type=radio][name=tabsMiPerfilAb]').click(function()
  {
    $('.btn.btn-tabs-buttons.bloque2').removeClass('checked');
    $(this).parent().addClass('checked');

    $('.tabsMiPerfilAb').hide();

    $('#' + $(this).val()).show();

    if($(this).val() == "tabsMiPerfilAb1")
    {
      reloadSliderUltimasNoticias();
    }
    else if($(this).val() == "tabsMiPerfilAb2")
    {
    }
    else if($(this).val() == "tabsMiPerfilAb3")
    {
    }
  });

//Eventos
  jQuery('body').on('click', '.button-guardar-evento', function(e)
  {
    e.preventDefault();

    let options = {
         theme:"sk-rect",
         message:'Guardando, Espere un momento',
         textColor:"white"
    };
    HoldOn.open(options);

    jQuery.ajax(
    {
      url: ajaxURL,
      type: 'POST',
      dataType: 'json',
      data: 
      {
        action: 'ajax_calendar_asistir',
        eventID: jQuery(this).attr('data-event'),
        userID: jQuery(this).attr('data-user')
      },
      success: function(data) 
      {
        if (data != null)
        {
          HoldOn.close();
          swal('<div class="textSuccessFormulario">' + data.title + '</div>', '', data.type);
        }
      },
      error: function (response)
      {
        console.log(response);
        HoldOn.close();
      },
      fail: function (response)
      {
        console.log(response);
        HoldOn.close();
      }
    });
  });

  jQuery('body').on('click', '.button-borrar-evento', function(e)
  {
    e.preventDefault();
    let options = {
         theme:"sk-rect",
         message:'Borrando, Espere un momento',
         textColor:"white"
    };
    HoldOn.open(options);

    jQuery.ajax(
    {
      url: ajaxURL,
      type: 'POST',
      dataType: 'json',
      data: 
      {
        action: 'ajax_calendar_borrar',
        eventID: jQuery(this).attr('data-event'),
        userID: jQuery(this).attr('data-user')
      },
      success: function(data) 
      {
        if (data != null)
        {
          jQuery('#calendar-user-events').attr('data-loaded', "false");

          show_calendar_user('calendar-user-events', 'ajax_calendar_events_user', data.userID);

          jQuery('.eventosUser-calendar-user-events').show();
          jQuery('.eventUser-' + data.eventID).hide();

          HoldOn.close();
          swal('<div class="textSuccessFormulario">' + data.title + '</div>', '', data.type);
        }
      },
      error: function (response)
      {
        console.log(response);
        HoldOn.close();
      },
      fail: function (response)
      {
        console.log(response);
        HoldOn.close();
      }
    });
  });

  jQuery('body').on('click', '.button-descargar-evento', function(e)
  {
    e.preventDefault();

    let eventID = jQuery(this).attr('data-event');
    let eventName = jQuery(this).attr('data-name');

    var element = document.getElementById("eventToPrint-" + eventID);

    let options =
    {
      theme: "sk-rect",
      message: 'Creando archivo, espere un momento',
      textColor: "white"
    };

    HoldOn.open(options);

    var opt =
    {
      margin:       1,
      filename:     eventName + '.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save().then(function ()
    {
      HoldOn.close();
    });
  });

//Propuestas
  jQuery('body').on('click', '.button-borrar-propuesta', function(e)
  {
    e.preventDefault();

    swal(
    {
      title: '<div class="textSuccessFormulario">Esta propuesta será eliminada ¿Desea continuar?</div>',
      type: "info",
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No',
    }).then((willDelete) =>
    {
      if (willDelete)
      {
        let options =
        {
             theme:"sk-rect",
             message:'Borrando, Espere un momento',
             textColor:"white"
        };
        HoldOn.open(options);

        jQuery.ajax(
        {
          url: ajaxURL,
          type: 'POST',
          dataType: 'json',
          data: 
          {
            action: 'ajax_borrar_propuesta',
            propuestaID: jQuery(this).attr('data-propuesta'),
            userID: jQuery(this).attr('data-user')
          },
          success: function(data) 
          {
            if (data != null)
            {
              jQuery('.propuestaUser-' + data.propuestaID).hide();
              HoldOn.close();
              swal('<div class="textSuccessFormulario">' + data.title + '</div>', '', data.type);
            }
          },
          error: function (response)
          {
            console.log(response);
            HoldOn.close();
          },
          fail: function (response)
          {
            console.log(response);
            HoldOn.close();
          }
        });
      }
      else
      {
      }
    });
  });

  jQuery('body').on('click', '.button-descargar-archivo-actual-propuesta', function(e)
  {
    let filesArray = jQuery.parseJSON(jQuery(this).attr('data-archivos'));

    let actual = jQuery('.slider-propuestas-paginas').attr('data-actual');
    
    jQuery(this).attr('href', filesArray[actual]);
  });

  jQuery('body').on('click', '.button-descargar-adjuntos-propuesta', function(e)
  {
    e.preventDefault();
    let nombre = jQuery(this).attr('data-titulo');
    let filesArray = jQuery.parseJSON(jQuery(this).attr('data-archivos'));

    generateZip(convertToSlug(nombre), filesArray);
  });

  jQuery('body').on('click', '.button-descargar-datos-propuesta', function(e)
  {
    e.preventDefault();

    let tituloPropuesta = jQuery(this).attr('data-titulo');
    let propuestaID = jQuery(this).attr('data-propuesta');

    let options =
    {
      theme: "sk-rect",
      message: 'Creando archivo, espere un momento',
      textColor: "white"
    };

    HoldOn.open(options);

    var element = document.getElementById("download-propuesta-" + propuestaID);

    var clonedElement = element.cloneNode(true);

    jQuery(clonedElement).find('.propuestaClon').css("display", "block");
    jQuery(clonedElement).find('.iniciativaClon').css("display", "block");

    jQuery(clonedElement).css("display", "block");
    jQuery(clonedElement).find('.descripcionPropuesta-modal').css("max-height", "none");

    let opt =
    {
      margin:       1,
      filename:     tituloPropuesta + '.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, useCORS: true, scrollY:0 },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(clonedElement).save().then(function ()
    {
      HoldOn.close();
      clonedElement.remove();
    });
  });

//Documentos
  jQuery('body').on('click', '.button-borrar-documento', function(e)
  {
    e.preventDefault();
    swal(
    {
      title: '<div class="textSuccessFormulario">Este documento será eliminado ¿Desea continuar?</div>',
      type: "info",
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No',
    }).then((willDelete) =>
    {
      if (willDelete)
      {
        let options =
        {
             theme:"sk-rect",
             message:'Borrando, Espere un momento',
             textColor:"white"
        };
        HoldOn.open(options);

        jQuery.ajax(
        {
          url: ajaxURL,
          type: 'POST',
          dataType: 'json',
          data: 
          {
            action: 'ajax_borrar_documento',
            documentoID: jQuery(this).attr('data-documento'),
            userID: jQuery(this).attr('data-user')
          },
          success: function(data) 
          {
            if (data != null)
            {
              jQuery('.documentoUser-' + data.documentoID).hide();
              HoldOn.close();
              swal('<div class="textSuccessFormulario">' + data.title + '</div>', '', data.type);
            }
          },
          error: function (response)
          {
            console.log(response);
            HoldOn.close();
          },
          fail: function (response)
          {
            console.log(response);
            HoldOn.close();
          }
        });
      }
      else
      {
      }
    });
  });

  if(document.getElementById('propuestasScroll'))
  {
    jQuery('#propuestasScroll').infiniteScroll(
    {
      path: '#morePagination',
      history: false,
      hideNav: '.paginationScroll',
      status: '.page-load-status',
    });

    jQuery('#propuestasScroll').on( 'load.infiniteScroll', function( event, response, path )
    {
      var $items = jQuery( response ).find('.propuestasItems');

      jQuery('#propuestasScroll').append( $items );
    });

    jQuery('body').on('shown.bs.modal', '.modal-propuestas', function(e)
    {
      jQuery(this).find('.slider-propuestas').css('opacity', 0);

      jQuery(this).find('.slider-propuestas').slick(
      {
        rows: 1,
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1
      });

      jQuery(this).find('.slider-propuestas').slick('setPosition');
      jQuery(this).find('.slider-propuestas').slick('slickGoTo', 0);
      jQuery(this).find('.slider-propuestas').css('opacity', 1);

      jQuery(this).find('.slider-propuestas').on('afterChange', function(event, slick, currentSlide)
      {
        let total = jQuery(this).find('.slickItem').length;
        jQuery('.slider-propuestas-paginas').html((currentSlide+1) + '/' + total + ' archivos');
        jQuery('.slider-propuestas-paginas').attr('data-actual', currentSlide);
        jQuery('.slider-propuestas-paginas').css('opacity', 1);
      });
    });

    jQuery('body').on('hidden.bs.modal', '.modal-propuestas', function(e)
    {
      jQuery(this).find('.slider-propuestas').css('opacity', 0);
      jQuery(this).find('.slider-propuestas').slick("unslick");
      jQuery('.slider-propuestas-paginas').css('opacity', 0);
    });
  }

  if(document.getElementById('documentosScroll'))
  {
    jQuery('#documentosScroll').infiniteScroll(
    {
      path: '#morePaginationDocumentos',
      history: false,
      hideNav: '.paginationScrollDocumentos',
      status: '.page-load-status-documentos',
    });

    jQuery('#documentosScroll').on( 'load.infiniteScroll', function( event, response, path )
    {
      var $items = jQuery( response ).find('.documentosItems');

      jQuery('#documentosScroll').append( $items );
    });
  }

//Ultimas noticias
  if(document.getElementById('contenedor-ultimas-noticias-by-localidad'))
  {
    jQuery('.ultimas-noticias-localidad-slider').slick(
    {
      rows: 1,
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive:
      [
        {
          breakpoint: 1441,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

    jQuery('#ultimasNoticiasLocalidad').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue)
    {
      let elementName = e.target.value;

      if(isSelected == true)
      {
        change_ultimas_noticias(elementName);
      }
    });
  }
});

function change_ultimas_noticias(localidadName)
{
    jQuery('.page-load-status-container-ultimas-noticias').css('display', 'block');
    jQuery('.container-loading-ultimas-noticias').css('display', 'block');
    jQuery('.container-loading-ultimas-noticias').css('opacity', '0.5');

    jQuery.ajax(
    {
      url: ajaxURL,
      type: 'POST',
      dataType: 'json',
      data: 
      {
        action: 'ajax_noticias_by_localidad_name',
        localidadName: localidadName,
      },
      success: function(data) 
      {
        if (data != null)
        {
          console.log(data);
          if(data.type == 'success')
          {
              addSliderUltimasNoticias(data.result);
          }
        }
        jQuery('.page-load-status-container-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('opacity', '0');
      },
      error: function (response)
      {
        console.log(response);
        jQuery('.page-load-status-container-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('opacity', '0');
      },
      fail: function (response)
      {
        console.log(response);
        jQuery('.page-load-status-container-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('display', 'none');
        jQuery('.container-loading-ultimas-noticias').css('opacity', '0');
      }
    });
}

function addSliderUltimasNoticias(data)
{
  jQuery('.ultimas-noticias-localidad-slider').slick("unslick");

  jQuery('.ultimas-noticias-localidad-slider').html('');
  jQuery('.ultimas-noticias-localidad-slider').html(data);

  jQuery('.ultimas-noticias-localidad-slider').slick(
  {
    rows: 1,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive:
    [
      {
        breakpoint: 1441,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
}

function reloadSliderUltimasNoticias()
{
  jQuery('.ultimas-noticias-localidad-slider').slick("unslick");

  jQuery('.ultimas-noticias-localidad-slider').slick(
  {
    rows: 1,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive:
    [
      {
        breakpoint: 1441,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
}
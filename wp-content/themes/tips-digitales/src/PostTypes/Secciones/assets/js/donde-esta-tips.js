jQuery(document).ready(function($)
{
  let filterID = 0;

  $('.proyectos-inversion-local-carousel').slick(
  {
      rows: 0,
      autoplay: false,
      dots: false,
      arrows: true,
      infinite: false,
      lazyLoad: 'ondemand',
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive:
      [
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

  $('.sliders-laboratorio-tips-thumbnails').slick(
  {
    slidesToShow: 6,
    slidesToScroll: 1,
    dots: false,
    lazyLoad: 'ondemand',
    infinite: false,
    centerMode: false,
    focusOnSelect: false,
    arrows: true,
    responsive:
    [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          infinite: true,
          centerMode: true,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  document.addEventListener("click", function(e)
  {
    //Limpiar SLICK
    let target = e.target.closest(".ElementFiltrosMapa_1");

    if(target)
    {
      if ($('.proyectos-inversion-local-carousel').slick)
      {
        $(".proyectos-inversion-local-carousel").slick('slickUnfilter');
        $('.proyectos-inversion-local-carousel').slick('refresh');
      }

      if ($('.timeline').slick)
      {
        $(".timeline").slick('slickUnfilter');
        $('.timeline').slick('refresh');
      }

      if ($('.sliders-laboratorio-tips-thumbnails').slick)
      {
        $(".sliders-laboratorio-tips-thumbnails").slick('slickUnfilter');
        $('.sliders-laboratorio-tips-thumbnails').slick('refresh');
      }

      $('.localidadesSUBRED').css('display', 'none');


      if(filterID != '0')
        $('.localidadesSUBRED.localidadSubred-' + filterID).css('display', 'block');
    }

    //Filtro localidades PRINCIPAL
    target = e.target.closest(".ElementFiltrosMapa_2");

    if(target)
    {
      filterID = e.target.getAttribute('data-term');

      if(filterID != '0')
        $('#accordion_filtros_localidades_modal').html(e.target.getAttribute('data-name'));

      $('#accordion_filtros_localidades_PDI_T').html(e.target.getAttribute('data-name'));
      $('#accordion_filtros_localidades_PDI_B').html(e.target.getAttribute('data-name'));

      $('#accordion_filtros_localidades_LT_T').html(e.target.getAttribute('data-name'));
      $('#accordion_filtros_localidades_LT_B').html(e.target.getAttribute('data-name'));

      if ($('.proyectos-inversion-local-carousel').slick)
      {
        $(".proyectos-inversion-local-carousel").slick('slickUnfilter');
        
        if(filterID != '0')
          $(".proyectos-inversion-local-carousel").slick('slickFilter',$('.localidadPDI-' + filterID));
      }

      if ($('.sliders-laboratorio-tips-thumbnails').slick)
      {
        $(".sliders-laboratorio-tips-thumbnails").slick('slickUnfilter');

        if(filterID != '0')
          $(".sliders-laboratorio-tips-thumbnails").slick('slickFilter',$('.localidadLT-B-' + filterID));
      }

      $('.localidadesSUBRED').css('display', 'none');
      
      if(filterID != '0')
        $('.localidadesSUBRED.localidadSubred-' + filterID).css('display', 'block');
    }
    
    target = e.target.closest(".ElementFiltrosLocalidadModal");

    if(target)
    {
      filterID = e.target.getAttribute('data-term');

      $('#accordion_filtros_localidades_modal').html(e.target.getAttribute('data-name'));

      $('#agendaFile').attr('href', $('.infoLocalidad-' + filterID).attr('data-agenda'));
      
      let video = document.getElementById('videoPlayer');
      let source = document.getElementById('videoSource');

      let dataVideoURL = $('.infoLocalidad-' + filterID).attr('data-video');
      let posterURL = $('.infoLocalidad-' + filterID).attr('data-poster');

      if(typeof dataVideoURL === "undefined")
      {
        $('#videoPlayer').addClass("disabled");
        $('#agendaFile').addClass("disabled");
        source.src = '';
        video.load();
      }
      else
      {
        $('#videoPlayer').removeClass("disabled");
        $('#agendaFile').removeClass("disabled");

        video.poster = posterURL;

        video.pause();
        source.src = $('.infoLocalidad-' + filterID).attr('data-video');
        video.load();
      }
    }

    target = e.target.closest(".ElementFiltrosLocalidadPDI");

    if(target)
    {
      $('#accordion_filtros_localidades_PDI_T').html(e.target.getAttribute('data-name'));
      $('#accordion_filtros_localidades_PDI_B').html(e.target.getAttribute('data-name'));

      filterID = e.target.getAttribute('data-term');

      if ($('.proyectos-inversion-local-carousel').slick)
      {
        $(".proyectos-inversion-local-carousel").slick('slickUnfilter');
        
        if(filterID != '0')
          $(".proyectos-inversion-local-carousel").slick('slickFilter',$('.localidadPDI-' + filterID));
      }
    }

    target = e.target.closest(".ElementFiltrosLocalidadLT");

    if(target)
    {
      $('#accordion_filtros_localidades_LT_T').html(e.target.getAttribute('data-name'));
      $('#accordion_filtros_localidades_LT_B').html(e.target.getAttribute('data-name'));

      filterID = e.target.getAttribute('data-term');

      if ($('.sliders-laboratorio-tips-thumbnails').slick)
      {
        console.log(filterID);
        
        $(".sliders-laboratorio-tips-thumbnails").slick('slickUnfilter');

        if(filterID != '0')
          $(".sliders-laboratorio-tips-thumbnails").slick('slickFilter',$('.localidadLT-B-' + filterID));
      }
    }

    target = e.target.closest(".showLabTipsImageModal");

    if(target)
    {
      let imageURL = $(target).attr('data-image');
      console.log(imageURL);
      $('#image-laboratorio-tips').attr('src', imageURL);
    }

  });

  if(document.getElementById('modal-dialogos-agendas'))
  {
    $('#modal-dialogos-agendas').modal(
    {
        backdrop: true,
        keyboard: false
    });

    $('#modal-dialogos-agendas').on('shown.bs.modal', function (e)
    {
      let localidadID = $('#LocalidadSelected').attr('data-tipoid');

      if(typeof localidadID === "undefined")
      {
        $('#accordion_filtros_localidades_modal').html($('#accordion_filtros_localidades_modal').attr('data-temp'));
      }
      else
      {
        if(localidadID != '0')
          $('#accordion_filtros_localidades_modal').html($('#LocalidadSelected').attr('data-name'));
        else
          $('#accordion_filtros_localidades_modal').html($('#accordion_filtros_localidades_modal').attr('data-temp'));
      }

      $('#agendaFile').attr('href', $('.infoLocalidad-' + localidadID).attr('data-agenda'));
      $('#videoFile').attr('src', $('.infoLocalidad-' + localidadID).attr('data-video'));

      let video = document.getElementById('videoPlayer');
      let source = document.getElementById('videoSource');

      if(localidadID != '')
      {
        let dataVideoURL = $('.infoLocalidad-' + localidadID).attr('data-video');
        let posterURL = $('.infoLocalidad-' + localidadID).attr('data-poster');

        if(typeof dataVideoURL === "undefined")
        {
          $('#videoPlayer').addClass("disabled");
          $('#agendaFile').addClass("disabled");
          source.src = '';
          video.load();
        }
        else
        {
          $('#videoPlayer').removeClass("disabled");
          $('#agendaFile').removeClass("disabled");

          video.poster = posterURL;
          source.src = dataVideoURL;
          video.load();
        }
      }
      else
      {
        $('#videoPlayer').addClass("disabled");
        $('#agendaFile').addClass("disabled");
        source.src = '';
        video.load();
      }
    });

    $('#modal-dialogos-agendas').on('hidden.bs.modal', function (e)
    {
      $('#' + e.target.id).find('.container-vista-inmersiva-multimedia-donde-esta-tips').each(function(i, obj)
      {
        var memory = $(this).html();
        $(this).html(memory);
      });
    });
  }

  if(document.getElementById('modal-proyectos-inversion-local'))
  {
    $('#modal-proyectos-inversion-local').modal(
    {
        backdrop: true,
        keyboard: false
    });

    $('#modal-proyectos-inversion-local').on('shown.bs.modal', function (e)
    {
      let videoURL = $(e.relatedTarget).attr('data-video');
      let posterURL = $(e.relatedTarget).attr('data-poster');

      let video = document.getElementById('videoPlayer-proyectos-inversion-local');
      let source = document.getElementById('videoSource-proyectos-inversion-local');

      video.poster = posterURL;
      source.src = videoURL;

      video.load();
    });

    $('#modal-proyectos-inversion-local').on('hidden.bs.modal', function (e)
    {
      $('#' + e.target.id).find('.container-vista-inmersiva-multimedia-donde-esta-tips').each(function(i, obj)
      {
        var memory = $(this).html();
        $(this).html(memory);
      });
    });
  }

  if(document.getElementById('modal-laboratorio-tips'))
  {
    $('#modal-laboratorio-tips').modal(
    {
        backdrop: true,
        keyboard: false
    });
  }

});

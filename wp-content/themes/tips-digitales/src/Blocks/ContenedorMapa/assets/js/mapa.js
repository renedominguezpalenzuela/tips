jQuery(document).ready(function($)
{
    let map;

    //Mapa general
    let termSelected_1;//ID Tipo
    let termSelected_2 = '0';//ID Localidades

    let nameSelected_1 = "";//Name Tipo
    let nameSelected_2 = "";//Name Localidades

    //Mapa Banco Iniciativas
    let termSelected_iniciativas_1;//ID Localidades
    let termSelected_iniciativas_2 = '0';//ID Tematica
    let termSelected_iniciativas_3 = '0';//ID Grupo Poblacional

    let nameSelected_iniciativas_1 = "";//Name Localidades
    let nameSelected_iniciativas_2 = "";//Name Tematica
    let nameSelected_iniciativas_3 = "";//Name Grupo Poblacional

    //Mapa Otros
    let termSelected_otros_1;//ID Filter Otro
    let termSelected_otros_2 = '0';//ID Localidades

    let nameSelected_otros_1 = "";//Name Filter Otro
    let nameSelected_otros_2 = "";//Name Localidades

    if(document.getElementById('mapaModal'))
    {
        myModalEl = new bootstrap.Modal(document.getElementById('mapaModal'),
        {
          backdrop: true,
          keyboard: false
        });
    }

    if(document.getElementById('mapaModalOtros'))
    {
        myModalEl = new bootstrap.Modal(document.getElementById('mapaModalOtros'),
        {
          backdrop: true,
          keyboard: false
        });

        jQuery("#mapaModalOtros").on('shown.bs.modal', function()
        {
            jQuery('.personasSlider-auto').slick(
            {
                fade: true,
                rows: 0,
                autoplay: false,
                dots: false,
                arrows: false,
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                swipe: false,
                asNavFor: '.personasSlider-auto-desc',
                responsive:
                [
                  {
                    breakpoint: 989,
                    settings: {
                      dots: false,
                      arrows: true,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      swipe: true
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      dots: false,
                      arrows: true,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      swipe: true
                    }
                  },
                  {
                    breakpoint: 330,
                    settings: {
                      dots: false,
                      arrows: true,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      swipe: true
                    }
                  }
                ]
            });

            jQuery('.personasSlider').slick(
            {
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.personasSlider-other',
                dots: false,
                infinite: false,
                centerMode: false,
                focusOnSelect: true,
                arrows: true,
                lazyLoad: 'ondemand',
                responsive:
                [
                  {
                    breakpoint: 1025,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1,
                    }
                  },
                  {
                    breakpoint: 989,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 330,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                ]
            });

            jQuery('.personasSlider-auto-desc').slick(
            {
                fade: true,
                rows: 0,
                autoplay: false,
                dots: false,
                arrows: false,
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                swipe: false,
                asNavFor: '.personasSlider-auto',
                responsive:
                [
                  {
                    breakpoint: 989,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 330,
                    settings: {
                      dots: false,
                      arrows: false,
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                ]
            });

            jQuery('.changeSliderPersonasBig').click(function(e)
            {
                e.preventDefault();
                var slideno = $(this).data('slide');
                $('.personasSlider').slick('slickGoTo', slideno);
            });
        });
    }

    if(document.getElementById('modal-informes-asociacion'))
    {
        myModalInformes = new bootstrap.Modal(document.getElementById('modal-informes-asociacion'),
        {
          backdrop: true,
          keyboard: false
        });
    }

    jQuery('.btn-close-modalMapas').click(function(e)
    {
        e.preventDefault();
        myModalEl.hide();
    });

    document.addEventListener("click", function(e)
    {
//Mapa General
      let target = e.target.closest(".ElementFiltrosMapa_1");

      if(target)
      {
        if(nameSelected_1 == '')
            $('#accordion_filtros_mapa_general_2').css('display', 'block');

        termSelected_1 = e.target.getAttribute('data-term');
        termSelected_1 = JSON.parse(termSelected_1);
        nameSelected_1 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_2, nameSelected_1, '', false);

        $('#TipoSelected').attr('data-name', nameSelected_1);
        $('#TipoSelected').attr('data-tipoid', termSelected_1);

        $('#principalFiltrosMapa_1').html(nameSelected_1);

        if(document.getElementById('bloque-info-filtros'))
        {
            if($(".titulo-filtros-mapa-1")[0])
            {
                $(".bloque-hide").hide();
                $('#bloque-info-filtros').show();
                $('.titulo-filtros-mapa-1').html(nameSelected_1);
                $('.titulo-modal-filtros-mapa-1').html('Diálogos Ciudadanos y Agenda Social<br>en ' + e.target.getAttribute('data-name'));

                if(nameSelected_1 == 'Proyectos de inversion Local en Salud')
                {
                    $('#bloque-info-proyectos-de-inversion').show();
                }
                else if(nameSelected_1 == 'Oficinas de Participación')
                {
                    if(termSelected_2 != '' && termSelected_2 != '0')
                        $('#bloque-info-oficinas-participacion').show();
                    else
                        $('#bloque-info-oficinas-participacion').hide();

                }
                else if(nameSelected_1 == 'Laboratorio TIPS')
                {
                    $('#bloque-info-laboratorio-tips').show();
                }
                else
                {
                    $(".bloque-hide").hide();
                }
            }
        }
      }

      target = e.target.closest(".ElementFiltrosMapa_2");

      if(target)
      {
        termSelected_2 = e.target.getAttribute('data-term');
        termSelected_2 = JSON.parse(termSelected_2);
        nameSelected_2 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_2, nameSelected_1, '', false);

        $('#LocalidadSelected').attr('data-name', nameSelected_2);
        $('#LocalidadSelected').attr('data-tipoid', termSelected_2);

        change_participacion_al_dia(termSelected_2, nameSelected_2);

        $('#principalFiltrosMapa_2').html(nameSelected_2);

        if(nameSelected_1 == 'Oficinas de Participación')
        {
            if(termSelected_2 != '' && termSelected_2 != '0')
                $('#bloque-info-oficinas-participacion').show();
            else
                $('#bloque-info-oficinas-participacion').hide();
        }
      }

//Mapa Iniciativas
      //Localidades
      target = e.target.closest(".ElementFiltrosMapaIniciativas_2");

      if(target)
      {
        termSelected_iniciativas_1 = e.target.getAttribute('data-term');
        termSelected_iniciativas_1 = JSON.parse(termSelected_iniciativas_1);
        nameSelected_iniciativas_1 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_iniciativas_1, nameSelected_iniciativas_2, nameSelected_iniciativas_3, false);

        $('#LocalidadSelected').attr('data-name', nameSelected_iniciativas_1);
        $('#LocalidadSelected').attr('data-tipoid', termSelected_iniciativas_1);

        change_participacion_al_dia(termSelected_iniciativas_1, nameSelected_iniciativas_1);

        $('#principalFiltrosMapaIniciativas_2').html(nameSelected_iniciativas_1);
      }

      //Tematicas
      target = e.target.closest(".ElementFiltrosMapaIniciativas_1");

      if(target)
      {
        termSelected_iniciativas_2 = e.target.getAttribute('data-term');
        termSelected_iniciativas_2 = JSON.parse(termSelected_iniciativas_2);
        nameSelected_iniciativas_2 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_iniciativas_1, nameSelected_iniciativas_2, nameSelected_iniciativas_3, false);

        $('#TematicaSelected').attr('data-name', nameSelected_iniciativas_2);
        $('#TematicaSelected').attr('data-tipoid', termSelected_iniciativas_2);

        $('#principalFiltrosMapaIniciativas_1').html(nameSelected_iniciativas_2);
      }

      //Grupo poblacional
      target = e.target.closest(".ElementFiltrosMapaIniciativas_3");

      if(target)
      {
        termSelected_iniciativas_3 = e.target.getAttribute('data-term');
        termSelected_iniciativas_3 = JSON.parse(termSelected_iniciativas_3);
        nameSelected_iniciativas_3 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_iniciativas_1, nameSelected_iniciativas_2, nameSelected_iniciativas_3, false);

        $('#GrupoPoblacionalSelected').attr('data-name', nameSelected_iniciativas_3);
        $('#GrupoPoblacionalSelected').attr('data-tipoid', termSelected_iniciativas_3);

        $('#principalFiltrosMapaIniciativas_3').html(nameSelected_iniciativas_3);
      }

//Mapa Otros
      //Localidades
      target = e.target.closest(".ElementFiltrosMapaOtros_1");

      if(target)
      {
        filterMarkers('', '', '', true);

        if(nameSelected_otros_1 == '')
            $('#accordion_filtros_mapa_otros_2').css('display', 'block');

        termSelected_otros_1 = e.target.getAttribute('data-term');
        termSelected_otros_1 = JSON.parse(termSelected_otros_1);
        nameSelected_otros_1 = e.target.getAttribute('data-name');

        termSelected_otros_2 = '';
        nameSelected_otros_2 = '';

        var fields = document.getElementsByClassName('ElementFiltrosMapaOtros_2');
        var cont = 0;

        for (var i = 0; i < fields.length; i ++)
        {
            var val = fields[i].getAttribute('data-term');
            
            if(val == termSelected_otros_1 || nameSelected_otros_1 == 'Todas las localidades')
            {
                fields[i].style.display = 'block';
                cont++;
            }
            else
                fields[i].style.display = 'none';
        }

        if(cont > 0)
        {
            $('#accordion_filtros_mapa_otros_2').removeClass("disabled");
            $('#principalFiltrosMapaOtros_2').html($('#filterOtroSelected').attr('data-name'));
        }
        else
        {
            $('#accordion_filtros_mapa_otros_2').addClass("disabled");
            $('#principalFiltrosMapaOtros_2').html($('#filterOtroSelected').attr('data-name'));
        }

        filterMarkers(nameSelected_otros_1, nameSelected_otros_2, '', false);

        $('#LocalidadSelected').attr('data-name', nameSelected_otros_1);
        $('#LocalidadSelected').attr('data-tipoid', termSelected_otros_1);

        change_participacion_al_dia(termSelected_otros_1, nameSelected_otros_1);

        $('#principalFiltrosMapaOtros_1').html(nameSelected_otros_1);
      }

//Filtros Otros
      target = e.target.closest(".ElementFiltrosMapaOtros_2");

      if(target)
      {
        termSelected_otros_2 = e.target.getAttribute('data-term');
        termSelected_otros_2 = JSON.parse(termSelected_otros_2);
        nameSelected_otros_2 = e.target.getAttribute('data-name');

        filterMarkers(nameSelected_otros_1, nameSelected_otros_2, '', false);

        $('#LocalidadSelected').attr('data-name', nameSelected_otros_2);
        $('#LocalidadSelected').attr('data-tipoid', termSelected_otros_2);

        $('#principalFiltrosMapaOtros_2').html(nameSelected_otros_2);
      }
    });

    if(document.getElementById('removeAllMapaTags'))
    {
        // bind the "click" event on the "remove all tags" button
        $('#removeAllMapaTags').on('click', function (e)
        {
            e.preventDefault();

            termSelected_1 = '';
            termSelected_2 = '0';
            nameSelected_1 = '';
            nameSelected_2 = '';
            
            termSelected_iniciativas_1 = '';
            termSelected_iniciativas_2 = '0';
            termSelected_iniciativas_3 = '';

            nameSelected_iniciativas_1 = '';
            nameSelected_iniciativas_2 = '';
            nameSelected_iniciativas_3 = '';

            termSelected_otros_1 = '';
            termSelected_otros_2 = '0';

            nameSelected_otros_1 = '';
            nameSelected_otros_2 = '';

            filterMarkers('', '', '', true);

            $('#principalFiltrosMapa_1').html($('#principalFiltrosMapa_1').attr('data-temp'));
            $('#principalFiltrosMapa_2').html($('#principalFiltrosMapa_2').attr('data-temp'));            

            $('#principalFiltrosMapaIniciativas_1').html($('#principalFiltrosMapaIniciativas_1').attr('data-temp'));
            $('#principalFiltrosMapaIniciativas_2').html($('#principalFiltrosMapaIniciativas_2').attr('data-temp'));            
            $('#principalFiltrosMapaIniciativas_3').html($('#principalFiltrosMapaIniciativas_3').attr('data-temp'));

            $('#principalFiltrosMapaOtros_1').html($('#principalFiltrosMapaOtros_1').attr('data-temp'));
            $('#principalFiltrosMapaOtros_2').html($('#principalFiltrosMapaOtros_2').attr('data-temp'));            

            $('#LocalidadSelected').attr('data-name', '');
            $('#LocalidadSelected').attr('data-tipoid', '');

            $('#accordion_filtros_mapa_general_2').css('display', 'none');
            $('#accordion_filtros_mapa_otros_2').css('display', 'none');

            if(document.getElementById('bloque-info-filtros'))
            {
                $('#accordion_filtros_localidades_modal').html($('#accordion_filtros_localidades_modal').attr('data-temp'));
                $('#accordion_filtros_localidades_PDI_T').html($('#accordion_filtros_localidades_PDI_T').attr('data-temp'));
                $('#accordion_filtros_localidades_PDI_B').html($('#accordion_filtros_localidades_PDI_T').attr('data-temp'));

                $('#bloque-info-filtros').hide();
                $(".bloque-hide").hide();

                $('#videoPlayer').addClass("disabled");
                document.getElementById('videoSource').src = '';
                $('#agendaFile').addClass("disabled");

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
            }
        });
    }

    var url_params = new URLSearchParams(window.location.search);

    if(url_params.has('mapaID'))
    {
        let ACOVE = jQuery("#ACOVE").attr('data-scroll');

        if(ACOVE == 'true')
        {
            jQuery("html").animate
            (
              {
                scrollTop: jQuery("#ACOVE").offset().top
              },
              800 //speed
            );
        }
    }

    loadGoogleMapsScript();
});

let myModalEl = '';
let myModalInformes = '';

function loadGoogleMapsScript()
{
    var script = document.createElement('script');
    var srcGM = jQuery('#googleMapsURI').data("src");

    script.type = 'text/javascript';
    script.src = srcGM;
    document.body.appendChild(script);
}

function initMap()
{
    var myStyle = [
      {
        "featureType": "administrative.land_parcel",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "administrative.neighborhood",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "poi.business",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "transit",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "labels.text",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      }
    ];

    if(document.getElementById('map'))
    { 
        map = new google.maps.Map(document.getElementById('map'),
        {
            mapTypeControlOptions:
            {
                mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP]
            },
            center: {lat: 4.510018829425146, lng: -74.1133230295733},
            zoom: 10,
            minZoom: 10,
            streetViewControl: false,
            mapTypeId: 'mystyle'
        });

        map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Mapa' }));

        jQuery('.page-load-status-container-mapa').css('display', 'block');
        jQuery('.container-loading-mapa').css('display', 'block');
        jQuery('.container-loading-mapa').css('opacity', '0.5');

        jQuery.ajax(
        {
          url: ajaxURL,
          type: 'POST',
          dataType: 'json',
          data: 
          {
            action: 'ajax_mapa_general',
            pageID: jQuery('#map').data("pageid"),
            type: jQuery('#map').data("type"),
          },
          success: function(data) 
          {
            if (data != null)
            {
                if(data.type == 'success')
                {
                    oms = new OverlappingMarkerSpiderfier(map,
                    { 
                        markersWontMove: true,   // we promise not to move any markers, allowing optimizations
                        markersWontHide: true,   // we promise not to change visibility of any markers, allowing optimizations
                        basicFormatEvents: true  // allow the library to skip calculating advanced formatting information
                    });

                    for( var n in data.result )
                    {
                        if(data.result[n].Position != '')
                            codeAddress.call( this, data.result[n], data.markers, data.Logo, data.BibliotecaURL );
                    }

                    jQuery('#principalFiltrosMapa_1').removeClass('disabled');
                    jQuery('#principalFiltrosMapaIniciativas_1').removeClass('disabled');
                    jQuery('#principalFiltrosMapaIniciativas_2').removeClass('disabled');
                    jQuery('#principalFiltrosMapaIniciativas_3').removeClass('disabled');

                    jQuery('#principalFiltrosMapaOtros_1').removeClass('disabled');
                    jQuery('#principalFiltrosMapaOtros_2').removeClass('disabled');

                    jQuery('#removeAllMapaTags').prop("disabled", false);

                    jQuery('.page-load-status-container-mapa').css('display', 'none');
                    jQuery('.container-loading-mapa').css('display', 'none');
                    jQuery('.container-loading-mapa').css('opacity', '0');

                    var url_params = new URLSearchParams(window.location.search);

                    if(url_params.has('mapaID'))
                    {
                        nameSelected_otros_2 = url_params.get('mapaID');

                        filterMarkers('Todas las localidades', nameSelected_otros_2, '', false);

                        jQuery('#LocalidadSelected').attr('data-name', nameSelected_otros_2);
                        jQuery('#principalFiltrosMapaOtros_2').html(nameSelected_otros_2);
                    }

                    if(document.getElementById('map'))
                    {
                        let mapaType = document.getElementById('map');

                        console.log(mapaType.getAttribute('data-type'));

                        if(mapaType.getAttribute('data-type') == 'iniciativas')
                        {
                            termSelected_iniciativas_1 = '0';
                            termSelected_iniciativas_1 = JSON.parse(termSelected_iniciativas_1);
                            nameSelected_iniciativas_1 = 'Todas las localidades';

                            filterMarkers(nameSelected_iniciativas_1, 0, 0, false);

                            jQuery('#LocalidadSelected').attr('data-name', nameSelected_iniciativas_1);
                            jQuery('#LocalidadSelected').attr('data-tipoid', termSelected_iniciativas_1);

                            jQuery('#principalFiltrosMapaIniciativas_2').html(nameSelected_iniciativas_1);
                        }

                        if(mapaType.getAttribute('data-type') == 'otro')
                        {
                            filterMarkers('', '', '', true);

                            termSelected_otros_1 = '0';
                            termSelected_otros_1 = JSON.parse(termSelected_otros_1);
                            nameSelected_otros_1 = 'Todas las localidades';

                            termSelected_otros_2 = '';
                            nameSelected_otros_2 = '';

                            var fields = document.getElementsByClassName('ElementFiltrosMapaOtros_2');
                            var cont = 0;

                            for (var i = 0; i < fields.length; i ++)
                            {
                                var val = fields[i].getAttribute('data-term');

                                if(val == termSelected_otros_1 || nameSelected_otros_1 == 'Todas las localidades')
                                {
                                    console.log(nameSelected_otros_1);
                                    fields[i].style.display = 'block';
                                    cont++;
                                }
                                else
                                    fields[i].style.display = 'none';
                            }

                            if(cont > 0)
                            {
                                jQuery('#accordion_filtros_mapa_otros_2').css('display', 'block');
                                jQuery('#accordion_filtros_mapa_otros_2').removeClass("disabled");
                                jQuery('#principalFiltrosMapaOtros_2').html(jQuery('#filterOtroSelected').attr('data-name'));
                            }
                            else
                            {
                                jQuery('#accordion_filtros_mapa_otros_2').addClass("disabled");
                                jQuery('#principalFiltrosMapaOtros_2').html(jQuery('#filterOtroSelected').attr('data-name'));
                            }

                            filterMarkers(nameSelected_otros_1, nameSelected_otros_2, '', false);

                            jQuery('#LocalidadSelected').attr('data-name', nameSelected_otros_1);
                            jQuery('#LocalidadSelected').attr('data-tipoid', termSelected_otros_1);

                            jQuery('#principalFiltrosMapaOtros_1').html(nameSelected_otros_1);
                        }
                    }
                }
            }
          },
          error: function (response)
          {
            console.log(response);
            jQuery('.page-load-status-container-mapa').css('display', 'none');
            jQuery('.container-loading-mapa').css('display', 'none');
            jQuery('.container-loading-mapa').css('opacity', '0');
          },
          fail: function (response)
          {
            console.log(response);
            jQuery('.page-load-status-container-mapa').css('display', 'none');
            jQuery('.container-loading-mapa').css('display', 'none');
            jQuery('.container-loading-mapa').css('opacity', '0');
          }
        });
    }
}

var gmarkers1 = [];
var oms = '';

function codeAddress(data, markers, logo, BibliotecaURL)
{
    let position = data.Position.split(', ');
    let marcador = '';
    var tipoMap = jQuery('#map').data("type");

    if(Array.isArray(markers) == true)
    {
        jQuery.each(markers, function(index)
        {
            if(this.nombre == data.Localidad)
            {
                marcador = this.marcador;
                return false;
            }
        });
    }
    else
    {
        marcador = markers;
    }

    var filtrosArray = [];

    if (tipoMap == "general")
    {
        filtrosArray = [data.Localidad, data.Tipo, data.SUBRED, data.Nombre];
    }
    else if (tipoMap == "iniciativas")
    {
        filtrosArray = [data.Localidad, data.Tematica, data.GrupoPoblacional_1, data.GrupoPoblacional_2, data.GrupoPoblacional_3];
    }
    else
    {
        filtrosArray = [data.Localidad, data.Nombre];
    }

    var newLat = parseFloat(position[0]) + (Math.random() -.5) / 1500;// * (Math.random() * (max - min) + min);
    var newLng = parseFloat(position[1]) + (Math.random() -.5) / 1500;// * (Math.random() * (max - min) + min);
    
    var marker = new google.maps.Marker(
    {
        position: new google.maps.LatLng(newLat,newLng),
        map: map,
        icon: marcador,
        draggarble: false,
        category: filtrosArray,
    });

    gmarkers1.push(marker);

    google.maps.event.addListener(marker, 'spider_click', function(e)
    {
        var link = '';
        var email = '';
        var direccion = '';
        var redes = '';
        var personasInfoSliderBig = '';
        var personasInfoSliderSmall = '';
        var personasInfoSliderInfo = '';
        var informesList = '';
        var filesArray = [];

        if(tipoMap == 'general')
        {
            if(data.Link != '')
                link = '<a href="' + window.location.origin + data.Link + '" class="d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-md-4 col-6 float-end">Ver más</a>';

            if(data.Email != '')
                email = '<h6 class="accent modal-subtitle-mapa mb-0">Email</h6><p class="accent modal-data-mapa point-email-mapa my-1">' + data.Email + '</p>';

            if(data.Direccion != '')
                direccion = '<h6 class="accent modal-subtitle-mapa mb-0">Dirección</h6><p class="accent modal-data-mapa point-direccion-mapa my-1 mb-3">' + data.Direccion + '</p>';

            document.getElementById('bodyModalMapa').innerHTML = '<div class="points-container"><h3 class="modal-title-mapa point-title-mapa title pt-0 pb-4">' + data.Nombre + '</h3><h6 class="accent modal-subtitle-mapa mb-0">Descripción</h6><p class="accent modal-data-mapa point-descripcion-mapa my-1 mb-3">' + data.Descripcion + '</p><h6 class="accent modal-subtitle-mapa mb-0">Localidad</h6><p class="accent modal-data-mapa point-localidad-mapa my-1 mb-3">' + data.Localidad + '</p>' + email + direccion + link + '</div>';
        }
        else if(tipoMap == 'iniciativas')
        {
            if(data.Email != '')
                email = '<h6 class="accent modal-subtitle-mapa mb-0">Email</h6><p class="accent modal-data-mapa point-email-mapa my-1">' + data.Email + '</p>';

            if(data.Direccion != '')
                direccion = '<h6 class="accent modal-subtitle-mapa mb-0">Dirección</h6><p class="accent modal-data-mapa point-direccion-mapa my-1 mb-3">' + data.Direccion + '</p>';

            if(data.Redes != '')
            {
                var redesArray = data.Redes.split(", ");

                redes = '<h6 class="accent modal-subtitle-mapa mb-0">Redes</h6>';

                for (var i = 0; i < redesArray.length; i++)
                {
                    redes = redes + '<p class="accent modal-data-mapa point-email-mapa my-1">' + redesArray[i] + '</p>';
                }
            }
            document.getElementById('bodyModalMapa').innerHTML = '<div class="container-fluid"><div class="row section-block"><div class="col-12 col-lg-2 mt-3 mb-3"><div class="logo-organizacion"><img class="img-fluid mx-auto d-block" src="' + logo + '"></div></div><div class="col-12 col-lg-7 mt-3 mb-3"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">Información General</h3></div><small class="accent modal-subtitle-mapa me-3 mx-4">Descripción</small><div class="descripcion-secciones pt-2 px-4">' + data.Descripcion + '</div></div><div class="col-12 col-lg-3 mt-3 mb-3"><div class="bloqueInfoModalIniciativas mb-3 px-4"><h6 class="accent modal-subtitle-mapa mb-0">Nombre</h6><p class="accent modal-data-mapa point-descripcion-mapa my-1 mb-3">' + data.Nombre + '</p><h6 class="accent modal-subtitle-mapa mb-0">Dirección</h6><p class="accent modal-data-mapa point-descripcion-mapa my-1 mb-3">' + data.Direccion + '</p><h6 class="accent modal-subtitle-mapa mb-0">Email</h6><p class="accent modal-data-mapa point-descripcion-mapa my-1 mb-3">' + data.Email + '</p>' + redes + '</div><a class="btn btn-primary p-1 m-1 boton_pagination_cursos" data-bs-toggle="modal" data-bs-target="#modal-contactar-iniciativa" href="#">Contactar iniciativa<i class="fa fa-chevron-right icono-btn-cursos-der"></i><span class="separator-btn-cursos-der"></span></a></div></div></div>';
        }
        else
        {
            var sufix = ''
            var TipoPag = '';

            if(data.Tipo == "asociaciones")
            {
                sufix1 = 'la';
                sufix2 = 'de la';

                TipoPag = 'Asociación';
            }
            else if(data.Tipo == "coopacos")
            {
                sufix1 = 'el';
                sufix2 = 'del';

                TipoPag = 'COOPACO';
            }
            else
            {
                sufix1 = 'la';
                sufix2 = 'de la';

                TipoPag = 'Veeduria';
            }

            if(data.Personas != '')
            {
//Formulario contactar asociacion
                var urlContactar = data.UrlContactar;

                for (var i = 0; i < data.Personas.length; i++)
                {
                    var dataPersonas = data.Personas[i];
                    var fotoBig = '';
                    var fotoSmall = '';

                    fotoBig = dataPersonas['Foto']['sizes']['medium_carrusel'];
                    fotoSmall = dataPersonas['Foto']['sizes']['thumbnail'];

                    personasInfoSliderBig += '<img src="' + fotoBig + '" data-no-lazy="1" class="img-fluid rounded d-block mx-auto">';

                    personasInfoSliderSmall += '<div class="col-md-2 col-12"><a href="#" class="changeSliderPersonasBig" data-slide="' + i + '"><img data-lazy="' + fotoSmall + '" data-no-lazy="1" class="img-fluid rounded d-block mx-auto"></a></div>';

                    var botonContacto = '';

                    if(urlContactar != '')
                        botonContacto = '<a class="btn btn-primary boton_pagination_cursos" href="' + urlContactar + '">Contactar ' + TipoPag + '<i class="fa fa-chevron-right icono-btn-cursos-der"></i><span class="separator-btn-cursos-der"></span></a>';
                    else
                        botonContacto = '<a class="disabled btn btn-primary boton_pagination_cursos" href="' + urlContactar + '">Contactar ' + TipoPag + '<i class="fa fa-chevron-right icono-btn-cursos-der"></i><span class="separator-btn-cursos-der"></span></a>';

//Formulario contactar asociacion
//                    personasInfoSliderInfo += '<div class="col-lg-6 col-12 my-4"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">' + dataPersonas['Nombre'] + '</h3></div><div class="descripcion-secciones pt-2 px-4"><p>Teléfono: ' + dataPersonas['Telefono'] + '</p><p>Email: ' + dataPersonas['Email'] + '</p></div><div class="col-md-12"><div class="pt-2 col-xl-4 col-12 float-lg-end"><a class="btn btn-primary boton_pagination_cursos" data-bs-toggle="modal" data-bs-target="#modal-contactar-asociacion" href="#">Contactar ' + TipoPag + '<i class="fa fa-chevron-right icono-btn-cursos-der"></i><span class="separator-btn-cursos-der"></span></a></div></div></div>';
                    personasInfoSliderInfo += '<div class="col-lg-6 col-12 my-4"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">' + dataPersonas['Nombre'] + '</h3></div><div class="descripcion-secciones pt-2 px-4"><p>Teléfono: ' + dataPersonas['Telefono'] + '</p><p>Email: ' + dataPersonas['Email'] + '</p></div><div class="col-md-12"><div class="pt-2 col-xl-5 col-12 float-lg-end">' + botonContacto + '</div></div></div>';

                }
            }

            var hasFiles = false;

            if(data.Informes != false)
            {
                if(data.Informes.length > 0)
                {
                    hasFiles = true;

                    for (var i = 0; i < data.Informes.length; i++)
                    {
                        var dataInformes = data.Informes[i];
                        
                        filesArray[i] = dataInformes['Archivo'];

                        informesList += '<div class="row pb-2"><div class="col-6 d-flex align-items-center"><span class="form-label">' + dataInformes['Nombre'] + '</span></div><div class="col-6"><a href="' + dataInformes['Archivo'] + '" download><span class="icon-documentos-asocioaciones float-end d-block"></span></a></div></div>';
                    }
                }
            }

            var disabledButton = '';

            if(hasFiles == false)
                disabledButton = ' disabled';

            document.getElementById('bodyModalMapa').innerHTML = '<div class="row px-3 m-2"><div class="col-lg-6 col-12 mb-4"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">¿Qué hace ' + sufix1 + ' ' + data.Nombre + '?</h3></div><div class="descripcion-secciones pt-2 px-4">' + data.Descripcion + '</div></div><div class="col-lg-6 col-12 mb-4"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">¿Donde tiene representación?</h3></div><div class="descripcion-secciones pt-2 px-4">' + data.Localidad + '</div></div><div class="col-lg-6 col-12 mb-4"><div class="d-flex mb-2"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">Informes</h3></div><div class="row px-3 px-lg-4 mx-lg-4 px-xl-5 mx-xl-5"><div class="col-6"><a class="' + disabledButton + '" data-bs-toggle="modal" data-bs-target="#modal-informes-asociacion" href="#"><div class="icon-documentos mx-auto d-block"></div></a></div><div class="col-6"><a href="' + BibliotecaURL + '"><div class="icon-bibliotecapdf mx-auto d-block"></div></a></div></div></div><div class="col-lg-6 col-12 mb-4"><div class="d-flex"><span class="iconInfo me-2 mx-1"></span><h3 class="title-bloque-info-filtros">¿Cómo hacer parte ' + sufix2 + ' ' + data.Nombre + '?</h3></div><div class="descripcion-secciones pt-2 px-4">' + data.Ingresar + '</div></div></div>' + '<div class="row px-3 m-2"><div class="col-12 contenedor-asociaciones-recuadro p-4"><div class="row"><div class="col-lg-4 col-12 px-4"><div class="pb-4"><div class="personasSlider-auto personasSlider-other">' + personasInfoSliderBig + '</div></div></div><div class="col-lg-7 col-12 mx-lg-4 px-4"><div class="row"><div class="col-md-12 pt-md-0 pb-4 personasSlider">' + personasInfoSliderSmall + '</div><div class="col-md-12"><div class="personasSlider-auto-desc personasSlider-other">' + personasInfoSliderInfo + '</div></div></div></div></div></div></div>';

            document.getElementById('bodyModalInformes').innerHTML = '<div class="row p-3 m-2"><div class="col-12 informesContainer">' + informesList + '</div><a href="#" class="col-lg-4 col-md-6 col-10 d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1" id="downloadInformesZIP">Descargar documentos</a></div>';
        
            if(document.getElementById('downloadInformesZIP'))
            {
                jQuery('#downloadInformesZIP').click(function(e)
                {
                    e.preventDefault();

                    generateZip(convertToSlug(data.Nombre), filesArray);
                });
            }
        }

        myModalEl.show();
    });

    oms.addMarker(marker);
    marker.setVisible(false);
}

function convertToSlug(Text)
{
  return Text.toLowerCase()
             .replace(/ /g, '-')
             .replace(/[^\w-]+/g, '');
}

function generateZip(filename, urls)
{
    if(!urls) return;

    const zip = new JSZip();
    const folder = zip.folder("files"); // folder name where all files will be placed in 

    let options =
    {
        theme: "sk-rect",
        message: 'Generando archivo ZIP, espere un momento',
        textColor: "white"
    };

    HoldOn.open(options);

    urls.forEach((url) =>
    {
        const blobPromise = fetch(url).then((r) =>
        {
            if (r.status === 200) return r.blob();
            return Promise.reject(new Error(r.statusText));
        });

        const name = url.substring(url.lastIndexOf("/") + 1);
        
        folder.file(name, blobPromise);
    });


    zip.generateAsync({ type: "blob" }).then((blob) =>
    {
        HoldOn.close();

        saveAs(blob, filename);
    });
}

/**
 * Function to filter markers by category
 */
function filterMarkers(localidad, filtro1, filtro2, clear)
{
    oms.unspiderfy();

    if(filtro1 == '0')
        filtro1 = '';

    if(filtro2 == '0')
        filtro2 = '';

    //Para mostrar 1 solo punto por cada oficina de participacion
    var subredesArray = [];

    if(clear == true)
    {
        for (var i = 0; i < gmarkers1.length; i++)
        {
            var marker = gmarkers1[i];
            marker.setVisible(false);
        }
    }
    else
    {
        for (var i = 0; i < gmarkers1.length; i++)
        {
            var marker = gmarkers1[i];

            // If is same category or category not picked
            if((typeof marker.category == 'object'))
            {
                if(localidad == '' && filtro1 == '' && filtro2 == '' )
                {
                    marker.setVisible(true);
                }
                else
                {
                    if(localidad == 'Todas las localidades' || localidad == '')
                    {
                        if(filtro1 != '' && filtro2 != '')
                        {
                            if(marker.category.indexOf(filtro1) >= 0 && marker.category.indexOf(filtro2) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                        else if(filtro1 != '' && filtro2 == '')
                        {
                            if(marker.category.indexOf(filtro1) >= 0)
                            {
                                if(marker.category[2] == 'true')
                                {
                                    if(typeof subredesArray[marker.category[3]] === "undefined")
                                    {
                                        subredesArray[marker.category[3]] = true;
                                        marker.setVisible(true);
                                    }
                                }
                                else
                                {
                                    marker.setVisible(true);
                                }
                            }
                            else
                                marker.setVisible(false);
                        }
                        else if(filtro1 == '' && filtro2 != '')
                        {
                            if(marker.category.indexOf(filtro2) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                        else
                        {
                            marker.setVisible(true);
                        }
                    }
                    else
                    {
                        if(filtro1 != '' && filtro2 != '')
                        {
                            if( (marker.category.indexOf(filtro1) >= 0 && marker.category.indexOf(filtro2) >= 0) && marker.category.indexOf(localidad) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                        else if(filtro1 != '' && filtro2 == '')
                        {
                            if(marker.category.indexOf(filtro1) >= 0 && marker.category.indexOf(localidad) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                        else if(filtro1 == '' && filtro2 != '')
                        {
                            if(marker.category.indexOf(filtro2) >= 0 && marker.category.indexOf(localidad) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                        else
                        {
                            if(marker.category.indexOf(localidad) >= 0)
                                marker.setVisible(true);
                            else
                                marker.setVisible(false);
                        }
                    }
                }
            }
            else
            {          
              marker.setVisible(false);
            }
        }
    }
}


function change_participacion_al_dia(localidadID, localidadName)
{
    jQuery('.page-load-status-container-participacion').css('display', 'block');
    jQuery('.container-loading-participacion').css('display', 'block');
    jQuery('.container-loading-participacion').css('opacity', '0.5');

    jQuery.ajax(
    {
      url: ajaxURL,
      type: 'POST',
      dataType: 'json',
      data: 
      {
        action: 'ajax_noticias_by_localidad',
        localidad: localidadID,
      },
      success: function(data) 
      {
        if (data != null)
        {
            if(data.type == 'success')
            {
                if(localidadID != 0)
                    jQuery('.title-localidad-secondary').html(' en ' + localidadName);
                else
                    jQuery('.title-localidad-secondary').html('');

                addSliderParticipcion(data.result);
            }
        }
        jQuery('.page-load-status-container-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('opacity', '0');
      },
      error: function (response)
      {
        console.log(response);
        jQuery('.page-load-status-container-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('opacity', '0');
      },
      fail: function (response)
      {
        console.log(response);
        jQuery('.page-load-status-container-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('display', 'none');
        jQuery('.container-loading-participacion').css('opacity', '0');
      }
    });
}

function addSliderParticipcion(data)
{
    jQuery('.participacion-al-dia-noticias-slider').slick("unslick");

    jQuery('.participacion-al-dia-noticias-slider').html('');
    jQuery('.participacion-al-dia-noticias-slider').html(data);

    jQuery('.participacion-al-dia-noticias-slider').slick(
    {
        rows: 1,
        dots: false,
        arrows: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
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
}
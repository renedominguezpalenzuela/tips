jQuery(document).ready(function($)
{
  if(document.getElementById('tabsParticipacion'))
  {
    let tagifyPeriodico;

    var url_params = new URLSearchParams(window.location.search);

      let total = $('.containerComiteEditorial').length;
      rand = Math.floor( Math.random() * total );

      $('.containerComiteEditorial').slick(
      {
        rows: 1,
        dots: false,
        arrows: true,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        initialSlide: rand
      });

    if(url_params.has('comite'))
    {
      $('.tabsParticipacion').hide();
      $('#tabsParticipacion4').show();
      $('.btn.btn-tabs-buttons').removeClass('checked');
      $('#content-4').parent().addClass('checked');

      $("html").animate
      (
        {
          scrollTop: $("#tabsParticipacion4").offset().top
        },
        800 //speed
      );
    }
    else if(url_params.has('noticias'))
    {
      $('.tabsParticipacion').hide();
      $('#tabsParticipacion2').show();
      $('.btn.btn-tabs-buttons').removeClass('checked');
      $('#content-2').parent().addClass('checked');
      iniciarTabsParticipacion('isotopeGridParticipacionNoticias', 'inputFiltroLocalidadNoticias');

      $("html").animate
      (
        {
          scrollTop: $("#tabsParticipacion2").offset().top
        },
        800 //speed
      );
    }
    else if(url_params.has('periodico'))
    {
      $('.tabsParticipacion').hide();
      $('#tabsParticipacion3').show();
      $('.btn.btn-tabs-buttons').removeClass('checked');
      $('#content-3').parent().addClass('checked');

      tagifyPeriodico = jQuery('#inputFiltroPeriodico').tagify(
      {
        enforceWhitelist: true,
        mode : "select",
        whitelist : JSON.parse(jQuery('#inputFiltroPeriodico').attr('data-tags')),
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
        let newURL = jQuery('#inputFiltroPeriodico').attr('data-url') + '?periodico=true&publicacion=' + tag.data.value;
        jQuery(location).attr('href', newURL);
      }).on('removetag', function(e, tag)
      {
        let newURL = jQuery('#inputFiltroPeriodico').attr('data-url') + '?periodico=last';
        jQuery(location).attr('href', newURL);
      });

      $("html").animate
      (
        {
          scrollTop: $("#tabsParticipacion3").offset().top
        },
        800 //speed
      );
    }
    else 
    {
      $('.tabsParticipacion').hide();
      $('#tabsParticipacion1').show();
      $('.btn.btn-tabs-buttons').removeClass('checked');
      $('#content-1').parent().addClass('checked');

      iniciarTabsParticipacion('isotopeGridParticipacionDialogos', 'inputFiltroLocalidadDialogos');
    }

    $('input[type=radio][name=tabsParticipacionAlDia]').click(function()
    {
      $('.btn.btn-tabs-buttons').removeClass('checked');
      $(this).parent().addClass('checked');

      $('.tabsParticipacion').hide();

      $('#' + $(this).val()).show();

      if($(this).val() == "tabsParticipacion1")
      {
        iniciarTabsParticipacion('isotopeGridParticipacionDialogos', 'inputFiltroLocalidadDialogos');
      }
      else if($(this).val() == "tabsParticipacion2")
      {
        iniciarTabsParticipacion('isotopeGridParticipacionNoticias', 'inputFiltroLocalidadNoticias');
      }
      else if($(this).val() == "tabsParticipacion3")
      {
        tagifyPeriodico = jQuery('#inputFiltroPeriodico').tagify(
        {
          enforceWhitelist: true,
          mode : "select",
          whitelist : JSON.parse(jQuery('#inputFiltroPeriodico').attr('data-tags')),
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
          let newURL = jQuery('#inputFiltroPeriodico').attr('data-url') + '?periodico=true&publicacion=' + tag.data.value;
          jQuery(location).attr('href', newURL);
        }).on('removetag', function(e, tag)
        {
          let newURL = jQuery('#inputFiltroPeriodico').attr('data-url') + '?periodico=last';
          jQuery(location).attr('href', newURL);
        });
      }
      else
      {
        let total = $('.containerComiteEditorial').length;
        rand = Math.floor( Math.random() * total );

        reloadSlider(rand);
      }
    });
  }
});

let filtrosGrid = [];
let grid = '';

function iniciarTabsParticipacion(isotopeID, inputFiltroID)
{
  jQuery('#' + inputFiltroID).tagify(
  {
    enforceWhitelist: true,
    whitelist : JSON.parse(jQuery('#' + inputFiltroID).attr('data-tags')),
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
    filtrosGrid.push('.' + tag.data.id);
    grid.isotope({ filter: filtrosGrid.join(", ") });
  }).on('removetag', function(e, tag)
  {
    removeElement(filtrosGrid, '.' + tag.data.id);
    grid.isotope({ filter: filtrosGrid.join(", ") });
  });

  jQuery('#' + inputFiltroID).data('tagify').removeAllTags();

  grid = jQuery('#' + isotopeID).isotope(
  {
    itemSelector: '.noticiasItem',
    percentPosition: true,
    gutter: 50,
    masonry:
    {
      columnWidth: '.grid-sizer',
    }
  });

  filtrosGrid = [];
  grid.isotope({ filter: '*' });
  grid.isotope( 'reloadItems' ).isotope();
}

function reloadSlider(randValue)
{
  jQuery('.containerComiteEditorial').slick("unslick");

  jQuery('.containerComiteEditorial').slick(
  {
    rows: 1,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    initialSlide: randValue
  });
}
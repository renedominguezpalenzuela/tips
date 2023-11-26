let actualPage = [];

jQuery(document).ready(function($)
{
  let filtrosGrid = [];

  if(document.getElementById('isotopeGrid'))
  {
    var grid = $('#isotopeGrid').isotope(
    {
      itemSelector: '.herramientaItem',
      percentPosition: true,
      masonry:
      {
        columnWidth: '.grid-sizer',
      }
    });

    grid.isotope( 'reloadItems' ).isotope();

    grid.infiniteScroll(
    {
      path: '#morePagination',
      history: false,
      hideNav: '.paginationScroll',
      status: '.page-load-status',
    });

    grid.on( 'load.infiniteScroll', function( event, response, path )
    {
      var $items = $( response ).find('.herramientaItem');
      grid.append( $items );
      grid.isotope( 'insert', $items );
      grid.isotope( 'reloadItems' ).isotope();
    });
  }

  if(document.getElementById('inputFiltroLocalidad'))
  {
    $('#inputFiltroLocalidad').tagify(
    {
      enforceWhitelist: true,
      whitelist : JSON.parse($('#inputFiltroLocalidad').attr('data-tags')),
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
  }

  if(document.getElementById('inputFiltroGrupo'))
  {
    $('#inputFiltroGrupo').tagify(
    {
      enforceWhitelist: true,
      whitelist : JSON.parse($('#inputFiltroGrupo').attr('data-tags')),
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
  }

  if(document.getElementById('inputFiltroGrupo'))
  {
    $('#inputFiltroTematica').tagify(
    {
      enforceWhitelist: true,
      whitelist : JSON.parse($('#inputFiltroTematica').attr('data-tags')),
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

  }

  if(document.getElementById('removeAllTags'))
  {
    // bind the "click" event on the "remove all tags" button
    $('#removeAllTags').on('click', function (e)
    {
      e.preventDefault();

      if(document.getElementById('inputFiltroLocalidad'))
      {
        $('#inputFiltroLocalidad').data('tagify').removeAllTags();
        $('#inputFiltroGrupo').data('tagify').removeAllTags();
        $('#inputFiltroTematica').data('tagify').removeAllTags();
      }

      filtrosGrid = [];
console.log(grid);
      if(grid)
        grid.isotope({ filter: '*' });

      $(location).attr('href', $(this).attr('data-url'));
    });
  }
});

function removeElement(arr)
{
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length)
    {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1)
        {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

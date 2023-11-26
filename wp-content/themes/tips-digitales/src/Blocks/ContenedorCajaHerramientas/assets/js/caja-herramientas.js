jQuery(document).ready(function($)
{
  let isSearch = $("#herramientasContainer").attr('data-scroll');

  if(isSearch == 'true')
  {
    $("html").animate
    (
      {
        scrollTop: $("#herramientasContainer").offset().top
      },
      800 //speed
    );
  }

  $('.modal-herramientas').modal(
  {
      backdrop: true,
      keyboard: false
  });

  $('.modal-herramientas').on('hidden.bs.modal', function (e)
  {
    $('#' + e.target.id).find('.container-vista-inmersiva-multimedia').each(function(i, obj)
    {
      var memory = $(this).html();
      $(this).html(memory);      
    });
  });
});
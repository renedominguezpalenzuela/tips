jQuery(document).ready(function($)
{
	$('.modalDependencias').modal(
	{
	    backdrop: true,
	    keyboard: false
	});

  $('.multi-item-carousel').slick(
  {
    rows: 2,
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

  $('.dependencia-tipo-a').slick(
  {
    rows: 1,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1
  });

	$('.modalDependencias').on('shown.bs.modal', function()
	{
 		$(this).find('.multi-item-carousel').css('opacity', 1);
 		$(this).find('.multi-item-carousel').slick('setPosition');
    $(this).find('.multi-item-carousel').slick('slickGoTo', 1);

    $(this).find('.dependencia-tipo-a').css('opacity', 1);
    $(this).find('.dependencia-tipo-a').slick('setPosition');
    $(this).find('.dependencia-tipo-a').slick('slickGoTo', 1);
  });

	$('.modalDependencias').on('hiden.bs.modal', function()
	{
		$(this).find('.multi-item-carousel').css('opacity', 0);
    $(this).find('.dependencia-tipo-a').css('opacity', 0);
  });

  $(document).click(function(e)
  {
    if (!$(e.target).is('.panel-body'))
    {
        $('.collapseSelect').collapse('hide');      
    }
  });

  $('.button-descargar-dependencia').click(function()
  {
    let options =
    {
      theme: "sk-rect",
      message: 'Creando archivo, espere un momento',
      textColor: "white"
    };

    HoldOn.open(options);

    let dependenciaID = jQuery(this).attr('data-dependencia');
    let dependenciaName = jQuery(this).attr('data-name');

    var element = document.getElementById("exportData-" + dependenciaID);

    var clonedElement = element.cloneNode(true);

    $(clonedElement).css("display", "block");

    let opt =
    {
      margin:       1,
      filename:     dependenciaName + '.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2,useCORS: true },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(clonedElement).save().then(function ()
    {
      HoldOn.close();
    });

    clonedElement.remove();
  });

});
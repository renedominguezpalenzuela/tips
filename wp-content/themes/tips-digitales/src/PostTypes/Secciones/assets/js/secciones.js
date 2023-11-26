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
    infinite: true,
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

	$('.modalDependencias').on('shown.bs.modal', function()
	{
 		$(this).find('.multi-item-carousel').css('opacity', 1);
 		$(this).find('.multi-item-carousel').slick('setPosition');
    $(this).find('.multi-item-carousel').slick('slickGoTo', 1);
  });

	$('.modalDependencias').on('hiden.bs.modal', function()
	{
		$(this).find('.multi-item-carousel').css('opacity', 0);
  });

  $(document).click(function(e)
  {
    if (!$(e.target).is('.panel-body'))
    {
        $('.collapseSelect').collapse('hide');      
    }
  });

  $(".timeline").slick(
  {
    centerMode: true,
    centerPadding: '30px',
    dots: false,
    infinite: false,
    arrows: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    focusOnSelect: true,
    responsive:
    [
      {
        breakpoint: 1440,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
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

});
jQuery(document).ready(function($)
{
	$('ul.menu-header-cursos li.dropdown').hover(function()
	{
	  	$('ul.menu-header-cursos li.dropdown').find('.dropdown-menu').removeClass('show');
	  	$(this).find('.dropdown-menu').addClass('show');
	}, 
	function ()
	{
	  	$(this).find('.dropdown-menu').removeClass('show');
	});

	$('ul.dropdown-menu.new-submenu-class').hover(function()
	{
	  	$(this).find('.dropdown-menu').addClass('show');
	}, 
	function ()
	{
	  	$(this).find('.dropdown-menu').removeClass('show');
	});

	$('#dropdownMenuPerfil').hover(function()
	{
	  	$('.dropdown-menu-perfil').addClass('show');
	}, 
	function ()
	{
	    //stuff to do on f mouse leave
	});

	$('.menuItemParentIMG').hover(function()
	{
		$('.imgMenuCursos').hide();

		let hover = $(this).find('.dropdown-item').attr("data-hover");

		$('.' + hover).show();
	}, 
	function ()
	{
		$('.imgMenuCursos').hide();
	});

	document.addEventListener('click', function handleClick(e)
	{
	  if (!e.target.classList.contains('itemSpanElement') && !e.target.classList.contains('dropdown-menu') && !e.target.classList.contains('dropdown-toggle'))
	  {
	  	$('ul.menu-header-cursos li.dropdown').find('.dropdown-menu').removeClass('show');
	  }

	  if (!e.target.classList.contains('dropdown-button-perfil') && !e.target.classList.contains('modbtn') && !e.target.classList.contains('nombreButtonUser'))
	  {
	  	$('.dropdown-menu-perfil').removeClass('show');
	  }

	});

	$(".a-minus").parent('.btn-item').addClass('disabled');

	$(".a-plusFunction").click(function()
	{
		if($(".a-plus").attr("data-disabled") == "false")
		{
			$(".a-plus").attr("data-disabled", "true");
			$(".a-minus").attr("data-disabled", "false");

			changeFontSize('plus');

			$(".a-plus").parent('.btn-item').addClass('disabled');
			$(".a-minus").parent('.btn-item').removeClass('disabled');
		}
	});

	$(".a-minusFunction").click(function()
	{
		if($(".a-minus").attr("data-disabled") == "false")
		{
			$(".a-plus").attr("data-disabled", "false");
			$(".a-minus").attr("data-disabled", "true");

			changeFontSize('minus');

			$(".a-minus").parent('.btn-item').addClass('disabled');
			$(".a-plus").parent('.btn-item').removeClass('disabled');
		}
	});

    if ($.cookie('highcontrast') == "yes")
    {
		$(".contrastButton").attr("data-disabled", "true");
		changeContrast();
    }

    // When the element is clicked
    $(".contrastFunction").click(function ()
    {
		if($(".contrastButton").attr("data-disabled") == "false")
		{
	        if (typeof $.cookie('highcontrast') === "undefined" || $.cookie('highcontrast') == "no" || $.cookie('highcontrast') == "null")
	        {
				$(".contrastButton").attr("data-disabled", "true");

	            $.cookie('highcontrast', 'yes',
	            {
	                expires: 7,
	                path: '/'
	            });
  	            changeContrast();
	        }
        }
        else
        {
			if ($.cookie('highcontrast') == "yes")
			{
				$(".contrastButton").attr("data-disabled", "false");

				$.cookie("highcontrast", 'no',
				{
				    path: '/'
				});
			}
  	        changeContrast();
        }
    });

	if(document.querySelector('.search-form'))
	{
		var elements = document.getElementsByClassName("search-form");

		for (var i = 0; i < elements.length; i++)
		{
	    elements[i].addEventListener( 'submit', function( e )
	    {
	    	let formID = '#' + e.target.id;

	    	let msg = $(formID).find('.inputTextElement').val();

		    if(msg.length < 3)
		    {
		    	e.preventDefault();

		        if($(formID).find('.alert-search').data("visible") != true)
		        {
		          $(formID).find('.alert-search').show();
		          $(formID).find('.alert-search').data("visible", true);

		          setTimeout(hide_alert_search, 3000);
		        }
		    }
	    }, false );
		}
	}

	$('.search-form').on('input',function(e)
	{
		let msg = $(this).val();

		if(msg.length >= 3)
		{
		  $(this).find('.alert-search').data("visible", false);
		  $(this).find('.alert-search').fadeOut( "slow" );
		}
	});

	if(document.body.classList.contains( 'logged-in' ))
		$('.hideWhenLogged').hide();
});

function hide_alert_search()
{
  jQuery('.alert-search').fadeOut( "slow" );
  jQuery('.alert-search').data("visible", false);
}

function changeFontSize(type)
{
    var elements = ["p", "span", "li", "a", "button", "h1", "h2", "h3", "h4", "h5"];

	elements.forEach(function(element)
	{
	    var content_html = jQuery(element + ':not(.fontsize-dont-change)');

    	content_html.each(function()
    	{
	        var cur_size = parseFloat(jQuery(this).css('font-size'));

	        if(type == 'plus')
	        {
	        	jQuery(this).animate({ 'zoom': 1.08 }, 400);
	        }
	        else
	        {
	        	jQuery(this).animate({ 'zoom': 1 }, 400);
	        }
	    });
	});
}

function changeContrast()
{
	if(!jQuery('body').hasClass('highcontrastBlack'))
	{
		jQuery('body').addClass('highcontrastBlack');
	}
	else
	{
		jQuery('body').removeClass('highcontrastBlack');
	}
}
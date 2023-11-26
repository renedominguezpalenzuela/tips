jQuery(document).ready(function ($)
{
	jQuery('body').on('click', '.shareBuzon', function(e)
	{
		e.preventDefault();

		let options = {
		     theme:"sk-rect",
		     message:'Enviando mensaje, Espere un momento',
		     textColor:"white"
		};

		HoldOn.open(options);
		let contactoURL = jQuery(this).attr('data-url');

		jQuery.ajax(
		{
		  url: ajaxURL,
		  type: 'POST',
		  dataType: 'json',
		  data: 
		  {
		    action: 'ajax_share_message_buzon',
		    currentUser: jQuery(this).attr('data-user'),
		    threadID: jQuery(this).attr('data-thread'),
		    postID: jQuery(this).attr('data-post'),
		    postURL: jQuery(this).attr('data-posturl'),
		  },
		  success: function(data) 
		  {
		    HoldOn.close();

		    if (data != null)
		    {
		    	if(data.type == 'success')
		    	{
		        	window.open(contactoURL, '_blank');
		    	}
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

	$("#searchFriends").on("keyup", function()
	{
		let value = this.value.toLowerCase().trim();

		console.log(value);

		$(".containerFriends").find('.name-buzonShare').each(function(i, obj)
		{
			let friendID = $(this).attr('data-friend');

			let name = $(this).html().toLowerCase().trim();

			if(name.includes(value) == false)
			{
				$(".friend-" + friendID).css('display', 'none');
			}
			else
			{
				$(".friend-" + friendID).css('display', 'block');
			}
		});
		
	});

	jQuery('body').on('click', '.showPopupCompartirEventos', function(e)
	{
		e.preventDefault();

		if($('#modalPopupCompartirEventos').length)
        {
			let urlEvento = $(this).attr('data-url');
			let titleEvento = $(this).attr('data-title');
			let IDEvent = $(this).attr('data-event');

			$("#shareProfileEvento").jsSocials(
			{
				url : urlEvento,
			    text: titleEvento,
				showLabel: false,
				showCount: false,
				shareIn: "share_profile",
				shares: ["facebook", "twitter", "whatsapp", "rss"]
			});

			$('#modalBuzonCompartir').find('.shareBuzon').each(function(i, obj)
			{
				let URLShare = 	$(this).attr('data-url');

				URLShare = replaceQueryParam('messageShare', urlEvento, URLShare);

				$(this).attr('data-post', IDEvent);
				$(this).attr('data-url', URLShare);
			});

			$('#modalPopupCompartirEventos').modal('show');
        }
	});

	jQuery('body').on('click', '.showPopupCompartirDocumentos', function(e)
	{
		e.preventDefault();

		if($('#modalPopupCompartirDocumentos').length)
        {
			let urlDocumento = $(this).attr('data-url');
			let titleDocumento = $(this).attr('data-title');
			let IDDocumento = $(this).attr('data-propuesta');

			$("#shareProfileDocumento").jsSocials(
			{
				url : urlDocumento,
			    text: titleDocumento,
				showLabel: false,
				showCount: false,
				shareIn: "share_profile",
				shares: ["facebook", "twitter", "whatsapp", "rss"]
			});

			$('#modalBuzonCompartir').find('.shareBuzon').each(function(i, obj)
			{
				let URLShare = 	$(this).attr('data-url');

				URLShare = replaceQueryParam('messageShare', urlDocumento, URLShare);

				$(this).attr('data-post', IDDocumento);
				$(this).attr('data-posturl', urlDocumento);
				$(this).attr('data-url', URLShare);

				console.log($(this).attr('data-post'));
				console.log($(this).attr('data-url'));
				console.log($(this).attr('data-posturl'));
			});

			$('#modalPopupCompartirDocumentos').modal('show');
        }
	});

});

function replaceQueryParam(param, newval, search)
{
    var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
    var query = search.replace(regex, "$1").replace(/&$/, '');

    return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
}

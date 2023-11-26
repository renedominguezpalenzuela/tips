jQuery(document).ready(function($)
{
	var modalMultimedia = null;

	if (typeof showModalMultimedia !== 'undefined')
	{
		modalMultimedia = new bootstrap.Modal(document.getElementById('modalMultimedia'),
		{
			backdrop: true,
			keyboard: false
		});

		$(".iconShowVideoRuta").click(function()
		{
				modalMultimedia.show();
		});

	    $('#modalMultimedia').on('show.bs.modal', function ()
	    {
			let player = document.getElementById("modalMultimediaVideo"),
			play = document.getElementById("btn-multimedia-si");

			play.addEventListener("click",function()
			{
				player.play();
			});
	    });

	    $('#modalMultimedia').on('hidden.bs.modal', function ()
	    {
			var memory = $(this).html();
		    $(this).html(memory);
	    });

		if (showModalMultimedia == 'si' && isHome == '1')
		{
			modalMultimedia.show();
		}
	}
});
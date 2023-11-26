jQuery(document).ready(function($)
{
	window.addEventListener('load', function ()
	{
		$('.bpbm-empty-message').html('Elige una conversación para mostrar los mensajes');
		$('.bpbm-empty-or').html('O');
		$('.bpbm-empty-link').html('<a href="#/new-conversation">Comenzar una nueva conversación</a>');
		$('.bpbm-empty-message').html('Elige una conversación para mostrar los mensajes');

		$('.bm-new-thread-title').html('Comenzar una nueva conversación');
		$('.bm-to-label').html('Para');
		$('#react-select-2-placeholder').html('Comienza a escribir para añadir miembros');
		$('.empty-thread').html('Escribe un mensaje para iniciar la conversación');

		$('#bm-new-thread-title').html('Comenzar una nueva conversación');
		$('.notifications_sound_notifications').html('Deshabilitar la notificación de sonido de mensaje nuevo');
		$('.bpbm-user-option-description').html('Cuando está habilitado, no escuchará ningún sonido cuando se reciba un nuevo mensaje.');
		$('.bpbm-user-option-description').html('Esta es una lista de usuarios que has bloqueado. Puedes desbloquearlos desde la lista de bloqueo abajo.');
		$('.bpbm-user-blacklist-empty').html('No has bloqueado a nadie aún');

	})
});
jQuery(document).ready(function($)
{
  jsSocials.shares.rss = {
      label: "Mi Buzón",
      logo: "fa-regular fa-comment-dots",
      shareUrl: "shareBuzon://send?text={url}",
      countUrl: "",
      getCount: function(data)
      {
          return data.count;
      }
  };

  jsSocials.shareStrategies["new_popup"] = function(args)
  {
    if(args.shareUrl.includes("shareBuzon") == false)
    {
      return $("<a>").attr("href", "#").on("click", function()
      {
        window.open(args.shareUrl, null, "width=600, height=400, location=0, menubar=0, resizeable=0, scrollbars=0, status=0, titlebar=0, toolbar=0");
        return false;
      });
    }
    else
    {
      var ret = decodeURIComponent(args.shareUrl.replace('shareBuzon://send?text=',''));

      return $("<a>").attr("href", "#").on("click", function()
      {
        if($('#modalBuzonCompartir').length)
        {
          $('#modalBuzonCompartir').modal('show');
        }
        else
        {
          swal(
          {
            title: '<div class="textSuccessFormulario">Para compartir en el buzón debes estar logueado</div>',
            type: "info",
            text: '¿Deseas iniciar sesión?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
          }).then((willDelete) =>
          {
            if (willDelete)
            {
              window.location.href = loginURL;
            }
            else
            {
            }
          });
        }

        return false;
      });

    }
  };

  jsSocials.shareStrategies["share_profile"] = function(args)
  {
    if(args.shareUrl.includes("shareBuzon") == false)
    {
      return $("<a>").attr("href", "#").on("click", function()
      {
        window.open(args.shareUrl, null, "width=600, height=400, location=0, menubar=0, resizeable=0, scrollbars=0, status=0, titlebar=0, toolbar=0");
        return false;
      });
    }
    else
    {
      var ret = decodeURIComponent(args.shareUrl.replace('shareBuzon://send?text=',''));

      return $("<a>").attr("href", "#").on("click", function()
      {
        if($('#modalBuzonCompartir').length)
        {
          $('#modalBuzonCompartir').modal('show');
        }
        else
        {
          swal(
          {
            title: '<div class="textSuccessFormulario">Para compartir en el buzón debes estar logueado</div>',
            type: "info",
            text: '¿Deseas iniciar sesión?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
          }).then((willDelete) =>
          {
            if (willDelete)
            {
              window.location.href = loginURL;
            }
            else
            {
            }
          });
        }

        return false;
      });

    }
  };

  $("#share").jsSocials(
  {
    showLabel: false,
    showCount: false,
    shareIn: "new_popup",
    shares: ["facebook", "twitter", "whatsapp", "rss"]
  });

  $('#comment').on("input", function()
  {
    var currentLength = $(this).val().length;

    if( currentLength > 3 )
    {
      $("#submit_comment").prop('disabled', false);
    }
    else
    {
      $("#submit_comment").prop('disabled', true);
    }
  });

});
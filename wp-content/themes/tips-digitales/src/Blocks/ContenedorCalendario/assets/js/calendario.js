jQuery(document).ready(function($)
{
  var calendarEl = document.getElementById('calendar');
  var all_events = [];
  var charged_events_month = [];
  var termSelected = 'all';

  if(calendarEl)
  {  
    let containerClone = $('.events-container').clone().addClass('eventClone');

    var calendar = new FullCalendar.Calendar(calendarEl,
    {
        initialView: 'dayGridMonth',
        locales: 'es',
        fixedWeekCount: false,
        headerToolbar:
        {
            left: 'prev',
            center: 'title',
            right: 'next',
        },
        titleFormat:
        {
            year: 'numeric',
            month: 'short',
        },
        datesSet: function(view,element)
        {
            var now = new Date();
            var endNext = new Date();
            var endPrev = new Date();

            endNext.setMonth(now.getMonth() + 3);
            endPrev.setMonth(now.getMonth() - 3);

            if ( endNext < view.end)
            {
                $("#calendar .fc-next-button").css('opacity', '0.25');
                $("#calendar .fc-next-button").prop("disabled", true);

                return false;
            }
            else
            {
                $("#calendar .fc-next-button").css('opacity', '1');
                $("#calendar .fc-next-button").prop("disabled", false);

            }

            if ( view.start < endPrev)
            {
                $("#calendar .fc-prev-button").css('opacity', '0.25');
                $("#calendar .fc-prev-button").prop("disabled", true);

                return false;
            }
            else
            {
                $("#calendar .fc-prev-button").css('opacity', '1');
                $("#calendar .fc-prev-button").prop("disabled", false);

            }
        },
        events: function(date, timezone, callback)
        {
          if(typeof charged_events_month[date.startStr] === "undefined")
          {
            $('.page-load-status-container-calendario').css('display', 'block');
            $('.container-loading-calendario').css('display', 'block');
            $('.container-loading-calendario').css('opacity', '0.5');

            jQuery.ajax(
            {
              url: ajaxURL,
              type: 'POST',
              dataType: 'json',
              data: 
              {
                action: 'ajax_calendar_events',
                start: date.startStr,
                end: date.endStr,
                taxonomies: JSON.stringify($('#calendar').data("filters"))
              },
              success: function(data) 
              {
                var events = [];
                if (data != null)
                {
                  if(data.type == 'success')
                  {
                    data.result.forEach(function(evento, index)
                    {
                      all_events[evento.ID] = evento;
                      charged_events_month[date.startStr] = true;

                      calendar.addEvent(
                      {
                        id: evento.ID,
                        start: evento.fechaCalendario,
                        end: evento.fechaCalendario,
                        display: 'background',
                        className: "selected-event",
                        categoryId: evento.categoria[0],
                      });
                    });
                  }
                  else
                    charged_events_month[date.startStr] = false;
                }
                else
                  charged_events_month[date.startStr] = false;

                $('.modal-body-calendario').find(".eventClone").remove();
                callback(events);

                $('.page-load-status-container-calendario').css('display', 'none');
                $('.container-loading-calendario').css('display', 'none');
                $('.container-loading-calendario').css('opacity', '0');
              },
              error: function (response)
              {
                $('.page-load-status-container-calendario').css('display', 'none');
                $('.container-loading-calendario').css('display', 'none');
                $('.container-loading-calendario').css('opacity', '0');
              },
              fail: function (response)
              {
                $('.page-load-status-container-calendario').css('display', 'none');
                $('.container-loading-calendario').css('display', 'none');
                $('.container-loading-calendario').css('opacity', '0');
              }
            });
          }
        },
        eventClassNames: function(arg)
        {
          let val = termSelected;

          if (!(val == arg.event.extendedProps.categoryId || val == "all"))
          {
            return 'fullcalendar_hidden_events';
          }
        },
        loading: function( isLoading )
        {
          if (isLoading == true)
          {
          }
          else
          {
          }
        },
        dateClick: function (info)
        {
          let hasEvent = false;
          let contEventsSameDay = 0;
          let clone;
          
          $('.modal-body-calendario').find(".eventClone").remove();

          all_events.forEach(function(evento, i)
          {
            var days = document.querySelectorAll(".day-highlight");
              
            days.forEach(function(day)
            {
              day.classList.remove("day-highlight");
            });

            if(info.dateStr == all_events[i].fechaCalendario)
            {
              info.dayEl.classList.add("day-highlight");

              if(contEventsSameDay >= 1)
              {
                let containerEvents = containerClone;

                containerEvents.find('.modal-title-calendario').last().html(all_events[i].titulo);
                containerEvents.find('.modal-descripcion-calendario').last().html(all_events[i].descripcion);
                containerEvents.find('.modal-direccion-calendario').last().html(all_events[i].direccion);
                containerEvents.find('.modal-fecha-calendario').last().html(all_events[i].fechaMostrar);
                containerEvents.find('.modal-button-asistir').last().attr("data-event", all_events[i].ID);

                $('.modal-body-calendario').append(containerEvents);
              }
              else
              {
                $('.modal-title-calendario').html(all_events[i].titulo);
                $('.modal-descripcion-calendario').html(all_events[i].descripcion);
                $('.modal-direccion-calendario').html(all_events[i].direccion);
                $('.modal-fecha-calendario').html(all_events[i].fechaMostrar);
                $('.modal-button-asistir').attr("data-event", all_events[i].ID);
              }

              hasEvent = true;
              contEventsSameDay++;
            }

          });

          if(hasEvent)
            $('#modalEvents').modal('show');
        }
    });

    calendar.render();

    document.addEventListener("click", function(e)
    {
      const target = e.target.closest(".modal-button-asistir");

      if(target)
      {
        var options = {
             theme:"sk-rect",
             message:'Enviando, Espere un momento',
             textColor:"white"
        };

        HoldOn.open(options);

        jQuery.ajax(
        {
          url: ajaxURL,
          type: 'POST',
          dataType: 'json',
          data: 
          {
            action: 'ajax_calendar_asistir',
            eventID: e.target.getAttribute("data-event"),
            userID: e.target.getAttribute("data-user")
          },
          success: function(data) 
          {
            if (data != null)
            {
              HoldOn.close();
              swal('<div class="textSuccessFormulario">' + data.title + '</div>', '', data.type);
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
      }
    });

    document.addEventListener("click", function(e)
    {
      const target = e.target.closest(".eventosElement");

      if(target)
      {
        termSelected = e.target.getAttribute('data-term');
        termSelected = JSON.parse(termSelected);

        let tempValue = $('#principalFiltros').attr('data-name');
        
        $('#principalFiltros').html(tempValue + ' (' + e.target.getAttribute('data-name') + ')');

        if(Array.isArray(termSelected))
          termSelected = 'all';

        calendar.render();
      }
    });
  }

});
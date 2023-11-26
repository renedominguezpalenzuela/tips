function show_calendar_user(calendarID, actionEvent, userID = 0)
{
  let calendarEl = document.getElementById(calendarID);
  let all_events = [];
  let charged_events_month = [];
  let termSelected = 'all';

  let loaded = jQuery('#' + calendarID).attr('data-loaded');

  if(calendarEl && loaded == "false")
  {
    let calendar = new FullCalendar.Calendar(calendarEl,
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
            let now = new Date();
            let endNext = new Date();
            let endPrev = new Date();

            endPrev.setMonth(now.getMonth());
            endNext.setMonth(now.getMonth() + 6);

            if ( endNext < view.end)
            {
                jQuery("#" + calendarID + " .fc-next-button").css('opacity', '0.25');
                jQuery("#" + calendarID + " .fc-next-button").prop("disabled", true);

                return false;
            }
            else
            {
                jQuery("#" + calendarID + " .fc-next-button").css('opacity', '1');
                jQuery("#" + calendarID + " .fc-next-button").prop("disabled", false);

            }

            if ( view.start < endPrev)
            {
                jQuery("#" + calendarID + " .fc-prev-button").css('opacity', '0.25');
                jQuery("#" + calendarID + " .fc-prev-button").prop("disabled", true);

                return false;
            }
            else
            {
                jQuery("#" + calendarID + " .fc-prev-button").css('opacity', '1');
                jQuery("#" + calendarID + " .fc-prev-button").prop("disabled", false);

            }
        },
        events: function(date, timezone, callback)
        {
          if(typeof charged_events_month[date.startStr] === "undefined")
          {
            jQuery('.btn-tabs-buttons').addClass( "disabled" );

            jQuery('.page-load-status-container-calendario-usuario').css('display', 'block');
            jQuery('.container-loading-calendario-usuario').css('display', 'block');
            jQuery('.container-loading-calendario-usuario').css('opacity', '0.5');

            jQuery.ajax(
            {
              url: ajaxURL,
              type: 'POST',
              dataType: 'json',
              data: 
              {
                action: actionEvent,
                start: date.startStr,
                end: date.endStr,
                user: userID,
                taxonomies: JSON.stringify(jQuery("#" + calendarID).data("filters"))
              },
              success: function(data) 
              {
                let events = [];
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
                        className: "selected-event_usuario",
                        categoryId: evento.categoria[0],
                      });
                    });

                    if(data.content != '')
                    {
                      jQuery('#list-' + calendarID).html(data.content);
                    }
                  }
                  else
                    charged_events_month[date.startStr] = false;
                }
                else
                  charged_events_month[date.startStr] = false;

                callback(events);

                jQuery('#' + calendarID).attr('data-loaded', "true");

                jQuery('.btn-tabs-buttons').removeClass( "disabled" );

                jQuery('.page-load-status-container-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('opacity', '0');
              },
              error: function (response)
              {
                jQuery('#' + calendarID).attr('data-loaded', "false");

                jQuery('.page-load-status-container-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('opacity', '0');
              },
              fail: function (response)
              {
                jQuery('#' + calendarID).attr('data-loaded', "false");

                jQuery('.page-load-status-container-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('display', 'none');
                jQuery('.container-loading-calendario-usuario').css('opacity', '0');
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
          jQuery('.eventosUser-' + calendarID).hide();
          jQuery('.no-event-' + calendarID).hide();

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

              let eventosUser = jQuery('.eventosUser-' + calendarID);

              eventosUser.each(function()
              {
                let filterEvento = jQuery(this).attr('data-filter');

                if(filterEvento == all_events[i].fechaFilter)
                {
                  hasEvent = true;
                  jQuery(this).show();
                }
              });
            }
          });

          if(hasEvent == false)
            jQuery('.no-event-' + calendarID).show();
        }
    });

    calendar.render();
  }
}
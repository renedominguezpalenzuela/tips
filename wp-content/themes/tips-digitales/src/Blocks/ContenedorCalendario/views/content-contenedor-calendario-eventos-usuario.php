<?php
    $filtros = false;
    $userID = $args['userID'];
?>
    <div class="col-md-12">
        <div class="col">
            <div class="container-calendario-usuario">
                <div class="page-load-status-container-calendario-usuario container-fluid">
                    <div class="loader-ellips infinite-scroll-request">
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                    </div>
                </div>

                <div class="container-loading-calendario-usuario">
                </div>

                <div class="px-3" id='calendar-user-events' data-filters="<?php echo $filtros; ?>" data-loaded="false" data-user="<?php echo $userID; ?>"></div>
            </div>
        </div>
    </div>
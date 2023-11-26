<?php
    if(!isset($args['postID']))
        $postID = get_the_ID();
    else
        $postID = $args['postID'];

    $currentUser = get_current_user_id();
    $myFriends = [];
    $myFriendsThreads = [];

    $friends = false;

    if($currentUser != 0):
        $myThreads = Better_Messages()->functions->get_threads($currentUser);
        $cont = 0;

        if($myThreads)
        {
            foreach($myThreads as $thread)
            {
                foreach($thread['participants'] as $participanteID)
                {
                    if($participanteID != $currentUser)
                    {
                        if (!in_array($participanteID, $myFriends))
                        {
                            $myFriendsThreads[$cont] = $thread['thread_id'];
                            $myFriends[$cont] = $participanteID;
                            $cont++;
                        }
                    }
                }
            }

            $friends = new stdClass();
            $friends->data = array();

            $cont = 0;

            foreach($myFriends as $friend)
            {
                $friends->data[$cont]['friendID'] = $friend;
                $friends->data[$cont]['threadID'] = $myFriendsThreads[$cont];

                $urlContacto = Better_Messages()->functions->get_user_messages_url( $friend, $myFriendsThreads[$cont] ) . '&messageShare=' . get_permalink();

                $friends->data[$cont]['contactoURL'] = $urlContacto;

                $cont++;
            }
        }
?>
        <div class="modal fade" id="modalBuzonCompartir" tabindex="-1" aria-labelledby="modalBuzonCompartirLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-buzon">
                    <div class="modal-header py-2">
                        <div class="container-fluid">
                            <div class="col-md-12 pb-0">
                                <button type="button" class="btn-close buttonClose-modal-herramientas" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 pt-4">
                                <div class="row">
                                    <div class="col-lg-9 col-12">
                                        <div class="d-flex">
                                            <span class="iconInfo me-2"></span>
                                            <h3 class="title-container-yoparticipoensalud px-2">
                                                Compartir
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="px-2 pb-3">
                                    <input type="text" id="searchFriends" class="form-control inputFriendElement" placeholder="Buscar">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="containerFriends">
                                <?php
                                    if($friends != false):
                                        $cont = 0;
                                        foreach($friends->data as $friend):
                                            $userName = get_user_meta( $friend['friendID'], 'first_name', true );

                                            $userFoto = get_user_meta($friend['friendID'], 'user_foto', true);

                                            if($userFoto == '')
                                                $userFoto = get_template_directory_uri() . '/public/images/avatar-default.png';
                                ?>
                                        <div class="col-12 py-2 friend-<?php echo $cont; ?>">
                                            <div class="px-0 py-2">
                                                <a class="shareBuzon" href='#' data-user='<?php echo $currentUser; ?>' data-thread='<?php echo $friend['threadID']; ?>' data-title='Me gustaría compartirte' data-post='<?php echo $postID; ?>' data-url='<?php echo $friend['contactoURL']; ?>'>
                                                    <div class="row mx-auto text-center text-lg-start">
                                                        <div class="col-2 avatarFriendBlock">
                                                            <div class="avatar-buzonShare" style="background-image: url(<?php echo $userFoto; ?>)">
                                                            </div>
                                                        </div>
                                                        <div class="col-10 my-auto">
                                                            <div class="col d-flex justify-content-between pb-3 borderBottomMenu">
                                                                <h3 class="name-buzonShare my-auto" data-friend=<?php echo $cont; ?>><?php echo $userName; ?></h3>
                                                                <i class="fa-solid fa-circle-chevron-right userFriendRight"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                <?php
                                        $cont++;
                                        endforeach;
                                    else:
                                ?>
                                    <div class="singleNoticias">
                                        No tienes contactos recurrentes, primero debes iniciar una conversación con un usuario para poder compartirle una noticia.
                                    </div>
                                <?php
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    else:

    endif;
?>
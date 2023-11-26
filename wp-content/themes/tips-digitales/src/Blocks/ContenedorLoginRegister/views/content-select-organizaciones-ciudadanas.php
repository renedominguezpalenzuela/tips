<?php
    $termNinguna = get_term_by('slug', 'ninguna', 'organizaciones-ciudadanas');
    $termOtra    = get_term_by('slug', 'otra', 'organizaciones-ciudadanas');

    $arguments = array
    (
        'taxonomy' => 'organizaciones-ciudadanas',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'exclude' => array($termNinguna->term_id, $termOtra->term_id)
    );

    $taxTerms = get_terms($arguments);

//Ninguna
    //array_push($taxTerms, $termOtra, $termNinguna);

    if ( $args['userID'] != 0 )
        $userOrgCiudadana = get_user_meta( $args['userID'], 'user_orgCiudadana', true );
    else
        $userOrgCiudadana = '';

    if(isset($args['size']))
        $size = $args['size'];
    else
        $size = 5;

    if(isset($args['body']))
        $body = $args['body'];
    else
        $body = 'body';

    if(isset($args['ID']))
        $ID = $args['ID'];
    else
        $ID = 'userOrganiacionCiudadana';

    if(isset($args['type']))
        $type = $args['type'];
    else
        $type = 'input';

    if(isset($args['titulo']))
        $titulo = $args['titulo'];
    else
        $titulo = 'Selecciona uno o varios elementos';

    $selected = '';
?>
<?php
    if($type == 'input'):
        $organizaciones = new stdClass();

        $organizaciones->terms = array();
        $cont = 0;

        foreach($taxTerms as $term)
        {
            $organizaciones->terms[$cont] = $term->name;

            $cont++;
        }

        if ( $args['userID'] != 0 )
        {
            $userOrgCiudadana = get_user_meta( $args['userID'], 'user_orgCiudadana', true );

            $tempOrgs = explode(',', $userOrgCiudadana);

            if (in_array('Otra', $tempOrgs))
            {
                $userOrgExtra = get_user_meta( $args['userID'], 'user_orgExtra', true );
            }
        }
        else
        {
            $userOrgCiudadana = '';
            $userOrgExtra = '';
        }
?>
        <input class="form-control wpcf7-form-control updateUserTags border-end-0 border searchElement" id="<?php echo $ID; ?>" name='<?php echo $ID; ?>' aria-required="true" aria-invalid="false" required="required" required value='<?php echo $userOrgCiudadana; ?>' data-tags='<?php echo json_encode($organizaciones->terms); ?>'>
<?php
    else:
?>
        <select class="selectpicker form-select wpcf7-form-control wpcf7-text form-control" aria-required="true" id="<?php echo $ID; ?>" title="<?php echo $titulo; ?>" aria-invalid="false" name="<?php echo $ID; ?>" data-size="<?php echo $size; ?>" data-container="<?php echo $body; ?>" required="required" required multiple>
            <?php
                foreach($taxTerms as $term):
            ?>
                    <option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
            <?php
                endforeach;
            ?>
        </select>
<?php
    endif;
?>
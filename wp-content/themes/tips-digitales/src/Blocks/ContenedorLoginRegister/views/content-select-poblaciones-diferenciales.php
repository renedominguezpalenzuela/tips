<?php
    $termNinguna = get_term_by('slug', 'ninguna', 'poblacion-diferencial');

    $arguments = array
    (
        'taxonomy' => 'poblacion-diferencial',
        'orderby' => 'ID',
        'order' => 'ASC',
        'hide_empty' => false,
        'exclude' => array($termNinguna->term_id)
    );

    $taxTerms = get_terms($arguments);

//Ninguna
    //array_push($taxTerms, $termNinguna);

    if ( $args['userID'] != 0 )
        $userPoblacion = get_user_meta( $args['userID'], 'user_poblacion', true );
    else
        $userPoblacion = '';

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
        $ID = 'userPoblacionDiferencial';

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
        $poblaciones = new stdClass();

        $poblaciones->terms = array();
        $cont = 0;

        foreach($taxTerms as $term)
        {
            $poblaciones->terms[$cont] = $term->name;

            $cont++;
        }

?>
        <input class="form-control wpcf7-form-control updateUserTags border-end-0 border searchElement" id="<?php echo $ID; ?>" name='<?php echo $ID; ?>' aria-required="true" aria-invalid="false" required="required" required value='<?php echo $userPoblacion; ?>' data-tags='<?php echo json_encode($poblaciones->terms); ?>'>
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
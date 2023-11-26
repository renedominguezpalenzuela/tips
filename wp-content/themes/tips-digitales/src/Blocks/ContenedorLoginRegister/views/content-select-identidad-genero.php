<?php
    $arguments = array
    (
        'taxonomy' => 'identidad-genero',
        'orderby' => 'ID',
        'order' => 'ASC',
        'hide_empty' => false
    );

    $taxTerms = get_terms($arguments);

    if ( $args['userID'] != 0 )
        $userIdentidad = get_user_meta( $args['userID'], 'user_identidadGenero', true );
    else
        $userIdentidad = '';

?>
    <select class="selectpicker form-select wpcf7-form-control wpcf7-text form-control" aria-required="true" id="userIdentidadGenero" aria-invalid="false" name="userIdentidadGenero" data-size="5" data-container="body" required="required" required>
        <?php
            foreach($taxTerms as $term):
                if($term->name == $userIdentidad):
                    $selected = 'selected';
                else:
                    $selected = '';
                endif;
        ?>
            <option value="<?php echo $term->name; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>
        <?php
            endforeach;
        ?>
    </select>
<?php

?>
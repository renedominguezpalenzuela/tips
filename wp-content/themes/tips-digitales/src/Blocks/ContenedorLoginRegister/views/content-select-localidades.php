<?php
    $arguments = array
    (
        'taxonomy' => 'localidades',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
    );

    $taxTerms = get_terms($arguments);

    $selected = '';

    if ( $args['userID'] != 0 )
    {
        $userLocalidad = get_user_meta( $args['userID'], 'user_localidad', true );
    }
    else
        $userLocalidad = '';

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
        $ID = 'userLocalidad';
?>
    <select class="selectpicker form-select wpcf7-form-control wpcf7-text form-control" aria-required="true" id="<?php echo $ID; ?>" aria-invalid="false" name="<?php echo $ID; ?>" data-size="<?php echo $size; ?>" data-container="<?php echo $body; ?>" required="required" required>
        <?php
            foreach($taxTerms as $term):
                if($term->name == $userLocalidad):
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
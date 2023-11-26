<?php
if (!defined('ABSPATH')) { exit; }

class MyContenedorFormulario
{
    private $name       = 'ModalFormulario';
    private $slug       = 'modal-formulario';

    public function __construct()
    {
    }

    public function init()
    {
        $this->init_actions();
        $this->init_filters();

        $this->acf_fields_theme();
    }

    public function init_actions()
    {
    }

    public function init_filters()
    {
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_slug()
    {
        return $this->slug;
    }

    public function acf_fields_theme()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_638fb145da490',
            'title' => 'Contenedor ¡Quiero Participar!',
            'fields' => array(
                array(
                    'key' => 'field_638fb223b0cee',
                    'label' => 'Seleccionar formulario',
                    'name' => 'seleccionar_formulario',
                    'type' => 'acf_cf7',
                    'instructions' => 'Selecciona el formulario que va a aparecer en la sección ¡Quiero Participar!',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));

        endif;
    }
}
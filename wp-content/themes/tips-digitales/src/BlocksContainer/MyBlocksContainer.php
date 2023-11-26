<?php
if (!defined('ABSPATH')) { exit; }

class MyBlocksContainer
{
    public function __construct()
    {
    }

    public function init()
    {
        $this->init_actions();
    }

    public function init_actions()
    {
    }

    public static function views_blocks_container($layout, $args = null)
    {
        switch ($layout)
        {
            case 'ContenedorMiBuzon':
                get_template_part('src/Blocks/ContenedorBuzon/views/content', 'contenedor-buzon', $args);
                break;

            case 'ContenedorMiBuzonCompartir':
                get_template_part('src/Blocks/ContenedorBuzon/views/content', 'contenedor-buzon-compartir');
                break;

            case 'ContenedorMultimedia':
                get_template_part('src/Blocks/ContenedorMultimedia/views/content', 'contenedor-multimedia');
                break;

            case 'ContenedorFormulario':
                get_template_part('src/Blocks/ContenedorFormulario/views/content', 'contenedor-formulario');
                break;

            case 'ContenedorTimeline':
                get_template_part('src/Blocks/ContenedorTimeline/views/content', 'contenedor-timeline');
                break;

            case 'ContenedorCalendario':
                get_template_part('src/Blocks/ContenedorCalendario/views/content', 'contenedor-calendario');
                break;

            case 'ContenedorMapaGeneral':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-mapa-general');
                break;

            case 'ContenedorMapaIniciativas':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-mapa-banco-iniciativas');
                break;

            case 'ContenedorMapaOtros':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-mapa-otros');
                break;

            case 'ContenedorFiltrosMapaGeneral':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-filtros-general');
                break;

            case 'ContenedorFiltrosMapaIniciativas':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-filtros-banco-iniciativas');
                break;

            case 'ContenedorFiltrosMapaOtros':
                get_template_part('src/Blocks/ContenedorMapa/views/content', 'contenedor-filtros-otros');
                break;

            case 'EquipoParticipacion':
                get_template_part('src/PostTypes/Secciones/views/content', 'equipo-participacion');
                break;

            case 'ContenedorDependencias':
                get_template_part('src/Blocks/ContenedorDependencias/views/content', 'contenedor-dependencias', $args);
                break;

            case 'ContenedorParticipacionAlDia':
                get_template_part('src/Blocks/ContenedorParticipacionAlDia/views/content', 'contenedor-participacion-al-dia');
                break;

            case 'ContenedorFormularioSecciones':
                get_template_part('src/Blocks/ContenedorFormularioSecciones/views/content', 'contenedor-formulario-secciones');
                break;

            case 'ContenedorYoParticipoEnSalud':
                get_template_part('src/Blocks/ContenedorYoParticipoEnSalud/views/content', 'contenedor-yoparticipoensalud');
                break;

            case 'ContenedorCajaHerramientas':
                get_template_part('src/Blocks/ContenedorCajaHerramientas/views/content', 'contenedor-caja-herramientas');
                break;

            case 'ContenedorBiblioteca':
                get_template_part('src/Blocks/ContenedorBiblioteca/views/content', 'contenedor-biblioteca');
                break;

            case 'ContenedorFiltrosBiblioteca':
                get_template_part('src/Blocks/ContenedorBiblioteca/views/content', 'contenedor-filtros-biblioteca');
                break;

            case 'ContenedorEncuesta':
                get_template_part('src/Blocks/ContenedorEncuesta/views/content', 'contenedor-encuesta');
                break;

            case 'Login':
                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'contenedor-login');
                break;

            case 'Register':
                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'contenedor-register');
                break;

            case 'RecoverPass':
                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'contenedor-recover-pass');
                break;

            case 'Noticias':
                get_template_part('src/PostTypes/Noticias/views/content', 'noticias');
                break;

            case 'Secciones':
                get_template_part('src/PostTypes/Secciones/views/content', 'secciones');
                break;

            case 'Cursos':
                get_template_part('src/PostTypes/Cursos/views/content', 'cursos');
                break;

            case 'Eventos':
                get_template_part('src/PostTypes/Eventos/views/content', 'eventos');
                break;
        }
    }
}

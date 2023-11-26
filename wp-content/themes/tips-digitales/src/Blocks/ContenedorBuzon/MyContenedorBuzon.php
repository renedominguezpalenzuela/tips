<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorBuzon
{
    private $name       = 'Buzon';
    private $slug       = 'buzon';
    private $post_type  = 'buzon';

    public function __construct()
    {
    }

    public function init()
    {
        $this->init_actions();
        $this->init_filters();
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_slug()
    {
        return $this->slug;
    }

    public function get_post_type()
    {
        return $this->post_type;
    }

    public function init_actions()
    {
        add_action('wp_ajax_ajax_share_message_buzon', array($this, 'ajax_share_message_buzon'));
        add_action('wp_ajax_nopriv_ajax_share_message_buzon', array($this, 'ajax_share_message_buzon'));
    }

    public function init_filters()
    {
    }

    public function load_styles()
    {
    }

    public function load_scripts()
    {
    }

    public function ajax_share_message_buzon()
    {
        $currentUser = esc_attr($_POST["currentUser"]);
        $threadID = esc_attr($_POST["threadID"]);
        $postID = esc_attr($_POST["postID"]);
        $postURL = esc_attr($_POST["postURL"]);

        if($postURL != '')
        {
            $url = $postURL;
        }
        else
        {
            $url = get_permalink($postID);
        }

        $descripcion = get_the_title($postID);

        $title = get_field('share_title', 'option');

        $args = array
        (
            'sender_id'  => $currentUser,
            'thread_id'  => $threadID,
            'content'    => '<strong>' . $title . ': </strong> <a href="' . $url . '">' . $descripcion . '</a>',
            'date_sent'  => bp_core_current_time()
        );

        $resultBP = BP_Better_Messages()->functions->new_message( $args );

        if ($resultBP)
        {
            $result['type'] = 'success';
            $result['data'] = $resultBP;
        }
        else
        {
            $result['type'] = 'error';
            $result['data'] = $resultBP;
        }

        $result = json_encode($result);
        echo $result;
        wp_die();
    }
}
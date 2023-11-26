<?php

function moppm_reset_pass_form($user)
{
    $session_id = session_create_id();
    $user_id  =$user->ID;
    global $wpdb;
    global $moppm_db_queries;
    set_transient($session_id, $user_id, 90);
    $miniorange_logo = plugins_url('password-policy-manager'.DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR .'images'.DIRECTORY_SEPARATOR .'shield.png');
    ?>
    <html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>  
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
        <?php
        wp_print_scripts('jquery-core');
        wp_register_style('custom-login', plugins_url('includes/css/moppm_style_settings.css', dirname(__FILE__)));
        wp_print_styles('custom-login');
        ?>
    </head>
    <body class="moppm_body">   
        <div class="container">
            <div class="row w-100 d-flex justify-content-center align-items-center main_div">
                <div class="col-12 col-md-8 col-xxl-5 ">
                    <div class="moppm_reset_body py-3 px-2">
                        <center><?php echo '<img style="width:150px; height:90px;display: inline;"src="'.esc_url_raw($miniorange_logo).'">';?></center>
                        <h2 class="text-center my-3 text-capitalize" style="color:black; margin-left:15px; font-size:35px;"> <span><?php echo __('Reset Password','password-policy-manager')?></span> </h2>
                        <div class="row mx-auto" >
                         <div class=" col-6 mx-auto"> 
                             <form class="moppm_my_form">
                                <div class="mb-3">
                                    <label for="Current Password" class="moppm_form_label"><?php echo __('Current Password','password-policy-manager')?></label>
                                    <input type="Password" class="moppm_input_password_field" id="moppm_old_pass" name="OldPass" placeholder="<?php echo __('Current Password','password-policy-manager')?>">
                                </div>
                                <div class="mb-3">
                                    <label for="New Password" class="moppm_form_label moppm_form_value"><?php echo __('New Password','password-policy-manager')?></label>
                                    <input type="Password" class="moppm_input_password_field" id="moppm_new_pass1" name="Newpass" placeholder="<?php echo __('New Password','password-policy-manager')?>">
                                </div>
                                <div class="mb-3">
                                    <label for="Confirm Password" class="moppm_form_label moppm_form_value"><?php echo __('Confirm Password','password-policy-manager')?></label>
                                    <input type="Password" class="moppm_input_password_field" id="moppm_new_pass2" name="Newpass2" placeholder="<?php echo __('Show Password','password-policy-manager')?>">
                                    <input type="checkbox" onclick="moppm_myFunction()"><label style="margin-left:5%;"><?php echo __('Show Password','password-policy-manager')?></label>
                                </div>
                               
                                <div class="my-3">

                                <button class="btn btn-block moppmbtn-primary btn-md moppm_form_value" type="button" id="moppm_save_pass" >
                                <small> <i class="far fa-user pr-2"></i> <?php echo __('CHANGE PASSWORD','password-policy-manager') ?></small>
                                    
                                </button>
                            </div>
                                <input type="hidden" name="NONCE" value="<?php echo esc_html (wp_create_nonce("moppmresetformnonce"));?>">
                                <input type="hidden" name="session_id" value="<?php echo esc_html($session_id)?>">
                            </form>           
                        </div>
                         <div class=" col-6 mx-auto">
                            <span class="moppm_pass_require"> <?php echo __('NEW PASSWORD REQIREMENTS','password-policy-manager')?> </span><br>
                            <div id="moppm_digit_entered" class="moppm_invalid fa fa-times">
                                <?php  $moppm_digit = get_site_option('moppm_digit')?__('Minimum ','password-policy-manager'). get_site_option('moppm_digit').__(' characters','password-policy-manager'): "";
                                    echo esc_html($moppm_digit);?>
                            </div>
                            <?php if (get_site_option('moppm_Numeric_digit')) { ?>
                            <div id="moppm_number" class="moppm_invalid fa fa-times ">
                            <?php
                                $moppm_Numeric_digit = get_site_option('moppm_Numeric_digit')?__(' Minimum one numeric digit (0,9)','password-policy-manager'): "";
                            echo esc_html($moppm_Numeric_digit);?>
                            </div><?php } ?>
                     <?php if (get_site_option('moppm_letter')) { ?>       
                    <div id="moppm_lower_letter" class="moppm_invalid fa fa-times">
                    <?php  $moppm_letter = get_site_option('moppm_letter')?__(' Minimum one lower case letter','password-policy-manager'): "";
                        echo esc_html($moppm_letter);?>
                    </div> <?php } ?>

                    <?php if (get_site_option('moppm_letter')) { ?> 
                    <div id="moppm_upper_letter" class="moppm_invalid fa fa-times">
                    <?php  $moppm_letter = get_site_option('moppm_letter')?__(' Minimum one upper case letter','password-policy-manager'): "";
                     echo esc_html($moppm_letter);?>
                   </div> <?php } ?>

                   <?php if (get_site_option('moppm_special_char')) { ?> 
                  <div id="moppm_special_symbol" class="moppm_invalid fa fa-times">
                   <?php  $moppm_special_char = get_site_option('moppm_special_char')?__('Minimum one special character (@ # $ %)','password-policy-manager'): "";
                   echo esc_html($moppm_special_char);?>
                  </div> <?php }?>

                </div>   
              </div>
                </div>
                </div>       
            </div>
        </div>        
<div id = "moppm_message"></div>
    <?php
    global $moppm_dirname;
        wp_register_script('moppm_ajax-login-script', plugins_url('includes/js/moppm_reset_pass.js', dirname(__FILE__)));
        wp_localize_script(
            'moppm_ajax-login-script',
            'ajax_object',
            array('ajaxurl' => admin_url('admin-ajax.php'),
            'redirecturl' => admin_url(),
            'loginUrl'=> wp_login_url(),
            'min_length' =>get_site_option('moppm_digit'),
            'loadingmessage' => __('Sending user info, please wait...'))
        );
        wp_print_scripts('moppm_ajax-login-script');
    ?> 
    </body>
    </html>
<?php } ?>
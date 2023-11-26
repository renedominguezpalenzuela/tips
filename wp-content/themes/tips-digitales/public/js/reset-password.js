jQuery(document).ready(function ($)
{
  let pwCheck = jQuery('#pw-weak');

  if(pwCheck.length > 0)
    pwCheck.disabled = true;

  let loginDiv = jQuery('#login_error');

  if(loginDiv.length > 0)
  {
    loginDiv.css('display','none');

    loginText = loginDiv.text();
    
    if (loginText.indexOf("lower case") >= 0)
      loginText = 'La contraseña debe contener al menos una minúscula';

    if (loginText.indexOf("upper case") >= 0)
      loginText = 'La contraseña debe contener al menos una mayúscula';

    if (loginText.indexOf("numeric value") >= 0)
      loginText = 'La contraseña debe contener al menos un dígito';

    loginDiv.css('display','block');
    loginDiv.text(loginText);
  }
});
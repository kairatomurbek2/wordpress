function processForm(url) {
    jQuery.ajax({
        url: url + 'sh_product_form.php',
        type: 'POST',
        data: jQuery('#add_product_form').serialize(),
        dataType: 'json'
    }).done(function (data) {
        if (data.error) {
            alert('error');
            jQuery('#incorrect_CAPTCHA').show();
        }
    });

    return false;
}

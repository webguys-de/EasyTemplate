function switch_link_input(code, id, element) {
    $('template_field_' + code + '_' + id + 'button').show();
    if ($(element).value == 'custom' || $(element).value == '') {
        $('template_field_' + code + '_' + id + 'button').hide();
        $('template_field_' + code + '_' + id + 'label').hide();
        $('template_input_' + code + '_' + id + 'label').show();
    } else {
        $('template_field_' + code + '_' + id + 'label').show();
        $('template_input_' + code + '_' + id + 'label').hide();
    }
}

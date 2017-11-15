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

var easytemplateTinyMceEnableList = [];
function easytemplateDisableTinymce() {
    for (var i = tinymce.editors.length - 1; i > -1; i--) {
        var editor_id = tinymce.editors[i].editorId;
        tinymce.EditorManager.execCommand('mceRemoveControl', true, editor_id);
        easytemplateTinyMceEnableList.push(editor_id);
    }
}
function easytemplateEnableTinyMce() {
    for (var i = easytemplateTinyMceEnableList.length - 1; i > -1; i--) {
        var editor_id = easytemplateTinyMceEnableList[i];
        tinymce.EditorManager.execCommand('mceAddControl', true, editor_id);
    }
    easytemplateTinyMceEnableList = [];
}
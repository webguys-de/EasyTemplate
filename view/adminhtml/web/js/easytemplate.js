define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'Magento_Ui/js/modal/modal',
    'Webguys_Easytemplate/js/gridster'
], function ($, $t) {
    "use strict";

    $.widget('easytemplate.easytemplate', {

        _create: function () {
            this._initEventHandler();
            this._gridster();
        },

        _initEventHandler: function () {

            this._on({

                // Click on template name
                'click .js-et-edit': function (event) {
                    console.log(event.target);
                    this.editTemplate($(event.target).attr('data-et-edit-url'));
                }

            });
        },

        editTemplate: function (url) {

            new Ajax.Request(url, {
                dataType: "json",
                onSuccess: function (data) {

                    $('<div />')
                        .html(data.responseJSON.html)
                        .modal({
                            type: 'slide',
                            title: 'Edit Template',
                            autoOpen: true,
                            buttons: [{
                                text: 'Confirm',
                                'class': 'action-primary',
                                click: function () {
                                    this.closeModal();
                                }
                            }]
                        });

                }
            });


        },

        _gridster: function () {
            var width = (jQuery(this.element).closest('form').width() / 12) - 20; // TODO: Calculate "20" on-the-fly!
            this.gridster = jQuery(this.element).gridster({
                widget_margins: [5, 5],
                widget_base_dimensions: [width, 70],
                min_cols: 12,
                resize: {
                    enabled: true
                }
            }).data('gridster');
        }

    });

});


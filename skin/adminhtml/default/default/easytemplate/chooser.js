var EasytemplateChooser = Class.create();

EasytemplateChooser.prototype = {

    initialize: function( chooser, config ) {

        this.chooser = chooser;
        this.title = config.title;
        this.button_close = config.button_close;

        this.product_chooser_url = config.product_chooser_url;
        this.category_chooser_url = config.category_chooser_url;
        this.cms_chooser_url = config.cms_chooser_url;

    },


    open : function( entity )
    {
        if( entity == 'product' )
        {
            url = this.product_chooser_url;
        } else if( entity == 'category' )
        {
            url = this.category_chooser_url;
        } else if( entity == 'cms' )
        {
            url = this.cms_chooser_url;
        }

        this.chooser.chooserUrl = url;
        this.chooser.config.buttons = {"open": this.title ,"close": this.button_close };


        this.chooser.dialogContent = null;
        this.chooser.choose();

    }


}
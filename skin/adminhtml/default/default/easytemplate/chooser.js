var EasytemplateChooser = Class.create();

EasytemplateChooser.prototype = {

    initialize: function( chooser, config ) {

        this.chooser = chooser;
        this.product_chooser_url = config.product_chooser_url;
        this.title = config.title;
        this.button_close = config.button_close;

    },


    open : function( entity )
    {
        if( entity == 'product' )
        {
            url = this.product_chooser_url;
        }


        this.chooser.chooserUrl = url;
        this.chooser.config.buttons = {"open": this.title ,"close": this.button_close };


        this.chooser.choose();

    }


}
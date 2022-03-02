(function( $ ) {

    wp.customize.bind( 'ready', function() {

        var customize = this;

        this.control( 'color_primary_control', function( control ) {
            console.log(control);
        } );

        // wp.customize.control.each( function ( control ) { 
            
        //     control.bind( 'change', (val) => {
        //         console.log(val);
        //     })

        //  } );

        //  wp.customize( 'color_primary_control', function (setting) {
        //     var value = setting.get();
        //     console.log(value);
        //  })

        // customize('color_primary', function(value){

        //     const oldValue = wp.customize.control( 'color_primary_control' );

        //     value.bind( function(to){
        //         console.log(to);
        //     })
        // })
        
    } );


    // wp.customize.bind( 'change', function( setting ) {
    //     var customize = this;

    //     if ( 0 === setting.id.indexOf( 'color_primary' ) ) {
    //         const newValue = setting._value;
            
    //         customize( 'color_header', function( setting ) {
    //             console.log(setting.default);
    //             debugger;
    //             setting.set(newValue);
    //         } );
    //     }
    // });

    // wp.customize( 'color_primary', 'color_header', function( color_primary, color_header ) {
        
    //     color_primary.bind( function( value ) {
    //         console.log(value);
    //         console.log(color_header.default);

    //   } );
    // });

})( jQuery );

'use strict';




+function ($) {
    

    function recalculate_price ($price_field, $qty_field, $price_for_item) {
        var $cart_form = $('.commerce-add-to-cart');
        var $price = parseFloat( $price_field.text() ),
        $qty = parseInt( $qty_field.val() );  

        var currencie = Drupal.settings.counterField.currencie;
        var currencie = $.isArray( currencie ) ? currencie[0] : currencie;
        var $calculated_price = $price_for_item * $qty;

        $calculated_price = $calculated_price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        $price_field.text( $calculated_price  + " " + currencie );
    }


    function update_style () {
        var select_val = $('.form-item-product-id select option:selected').text();

        $('.form-item-product-id .select_wrapper').each(function  () {
            var $this = $(this);
            var toReturn = '', classes = this.className.split(' ');

            for(var i = 0; i < classes.length; i++ ) {
                if( /nums\d{1,3}/.test( classes[i] ) ) $this.removeClass( classes[i] );                
            }

        })

        $('.form-item-product-id .select_wrapper').addClass('nums' + select_val.length );
    }

    Drupal.behaviors.counterFields = {
        attach: function (context, settings) {

            var $cart_form = $('.commerce-add-to-cart');

            if( $cart_form.hasClass('processed') ) return;
            $cart_form.addClass('processed');


            var $price_field = $(".field-name-commerce-price");
            var $qty_field = $('.form-item-quantity input');
            var def_price = parseFloat( $price_field.text().replace(' ', '').replace(',', '.') );

            // recalculate_price($price_field, $qty_field, def_price);
            update_style ();


            // console.log(select_val.length);

            $(".counter_item").each(function  () {


                var $this = $(this);
                var $up = $('<a href="#" class="counter up"><i class="fa fa-fw fa-plus"></i></a>');
                var $down = $('<a href="#" class="counter up"><i class="fa fa-fw fa-minus"></i></a>');


                // console.log( $this );

                // if( $this.parents('.form-group').find('.counter.up').length ) return;



                $up.click(function  () {


                    if( $this[0].tagName === 'SELECT' ) {
                        var current = $this.find('option:selected').index();
                        var next_val = $this.find('option:selected+option').val();

                        if( current + 1 === $this.find('option').length ) {
                            next_val = $this.find('option').eq(0).val();
                        } 

                        $this.val(next_val).trigger('change');

                        update_style ();
                    }

                    else {

                        var amount = parseInt($this.val()) || 1;

                        amount = amount + 1; 
                        if(amount < 1) amount = 1; 
                        $this.val( amount );
                        recalculate_price($price_field, $qty_field, def_price);
                    }

                    return false;
                });

                $down.click(function  () {

                    if( $this[0].tagName === 'SELECT' ) {
                        var current = $this.find('option:selected').index();
                        var prev_val = $this.find('option:selected').prev().val();

                        if( current  === 0 ) {
                            prev_val = $this.find('option').eq($this.find('option').length - 1).val();
                        }   
                        
                        $this.val(prev_val).trigger('change');

                        update_style ();
                    }

                    else {
                        
                        var amount = parseInt($this.val()) || 1;
                        amount = amount - 1; 
                        if(amount <= 1) amount = 1; 
                        $this.val( amount );
                        recalculate_price($price_field, $qty_field, def_price);
                    }

                    return false;
                });


                if( !$this.prev().hasClass('counter') ) {
                     
                    if( $this[0].tagName === 'SELECT' ) $this.parent().after($up).before($down);
                    else $this.after($up).before($down);

                }



            });


        }
    };


}(jQuery);



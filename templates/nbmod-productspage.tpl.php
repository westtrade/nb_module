<div id="product_page">

    <?php foreach($solvents as $solvent) : ?>
    <div class="row">
       
        <div class="col-xs-3">
            <div class="h1">
                <?php echo t('Protective Coating'); ?>
            </div>
            <?php 
                $view = taxonomy_term_view($solvent, 'product_category') ;
                echo render( $view );
            ?>
        </div>
        
        
        <div class="col-xs-9 contextual-links-region products_views">
            <?php echo views_embed_view('products_by_solvent', 'default', $solvent->tid ); ?>
        </div>


    </div>
    <?php endforeach; ?>

</div>
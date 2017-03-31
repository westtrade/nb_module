<div class="case <?php echo $style; echo user_access('access contextual links') ? ' contextual-links-region' : '' ?>">
    <?php 

        $links = _clinks_get_renderable_array(
            array( 
                
                'taxonomy' => array('taxonomy_term', array($tid) )  ,
                // 'node' => array('node', array(2) )

            ) 
        );

        $contextual_menu = render($links);

        echo l(
            $contextual_menu.
            "<span class='box'></span>
            <span class='title'>". mb_strtoupper($title) ."</span>
            <span class='description'>$description</span>
            ",

            'taxonomy/term/'.$tid,
            
            array(
                'html' => TRUE, 
                'absolute' => true          
            )    
        );

        
    ?>
</div>
jQuery(document).ready(function() {    
    setTimeout(function(){        
        jQuery('.enigma_blog_thumb_wrapper').equalHeights(); 
    }, 200); 
    jQuery('#mycarou').carouFredSel({        
            responsive: true, 
            auto: true, 
            items: {            
                visible: 1        
            }, 
            scroll: {            
                duration: 1000, 
                timeoutDuration: 7000, 
                fx: 'none'        
            }, 
    }); 
});
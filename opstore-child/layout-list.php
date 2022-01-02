<?php

$sidebar_position = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
$archive_page_sidebars = get_theme_mod('archive_page_sidebars','right-sidebar');

$column_class = 'primary-content col-xs-12 col-md-8 col-sm-8';
if( ! is_active_sidebar($archive_page_sidebars)){
    $column_class = '';
}

if( $sidebar_position === 'leftsidebar' ) {
    $column_class .= ' pull-right';
}
?>
<div class="row classic-wrap">
    <div  class="<?php echo esc_attr( $column_class ); ?>">
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-list blog-list-wrap'); ?>>
                
                <figure style="align-items:center" class="mb-20">
                    <?php 
                    if( has_post_thumbnail() ):
                    ?>
                    
                    <a class="image-effect" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('opstore-blog-list'); ?>
                    </a>
                    <?php
                    endif;
                    ?>

                    <?php 
                    if(!has_post_thumbnail() ):
                    ?>
                        <?php $image = get_field('imagen_de_portada'); ?>
                        <a style="display:block; margin:auto" class="image-effect" href="<?php the_permalink(); ?>">
                            <img src="<?php echo $image['url'];?>" alt="<?php echo $image['tittle']; ?>" />
                        </a>
                    <?php
                    endif;
                    ?>

                </figure>
                <!--figure-->
                <div style="text-align:center" class="title-wrap">
                    <div class="post-info">
                        <?php opstore_entry_meta(); ?>
                    </div>
                    <!--post info-->
                    <p style=" width=50%;" class="entry-title mb-15">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                             echo('<div>');
                             the_title();
                             echo('</div>');
                          ?> 
                            
                        </a>
                        <?php
                        mycp_show_views();
                        ?> 
                    </p>
                    <!--title-->
                </div>
              
                <div class="entry-content blog">
                    <div class="entry-post-content  mb-20 promo">
                        <?php 
                        $excerpt = get_theme_mod('opstore_archive_page_excerpts',50);
                        // $read_more = get_theme_mod('opstore_archive_read_more',esc_html__('Read More','opstore'));
                        // echo wp_kses_post(get_the_excerpt());
                   
                        ?> 
                    </div>
                    <!--entry post content-->
                    <!-- <?php if($read_more!=''){?>
                    <a href="<?php the_permalink(); ?>" class="opstore-btn bdr">
                        <?php echo esc_html($read_more); ?>
                    </a>
                    <?php }?> -->
                </div>
            </article>
      

        <div class="pagination">
            <?php 
            opstore_pagination();
            ?>
        </div>   
    </div>
</div>
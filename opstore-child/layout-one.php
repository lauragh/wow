<?php 
global $post;

$sidebarPositionOld = get_post_meta($post->ID, 'ultra_seven_page_sidebar', true);

$sidebarPosition = get_post_meta($post->ID, 'ultra_sidebar_layout', true);
$sidebarPosition = !empty( $sidebarPosition ) ? $sidebarPosition : $sidebarPositionOld;


if($sidebarPosition == 'default' || $sidebarPosition == ''){
    $sidebarPosition = get_theme_mod('post_page_sidebars_layout','rightsidebar');
}

$main_class = 'col-md-12 col-sm-12 col-xs-12';
if( $sidebarPosition != 'nosidebar' ){
    $main_class = 'primary-content col-md-8 col-sm-8 col-xs-12';
}

if ($sidebarPosition === 'leftsidebar' ): 
    $main_class .= ' pull-right';
endif;


?>
<div class="row classic-single">
    <div class="<?php echo esc_attr( $main_class ); ?>">
        <?php 
        while( have_posts() ): the_post(); 
            if(has_post_thumbnail()){
                $class = 'has-post-thumbnail';
            }else{
                $class = '';
            } ?>
            <div id="post-<?php the_id(); ?>" <?php post_class(array('blog-detail',$class)); ?>>

                <?php 
                    the_title('<h1><strong>', '</strong></h1>');
                ?>
                <?php 
                echo('<div style="margin-top:10px">');
                mycp_show_views();
                echo('</div>');
                ?>
                <?php 
                if(!has_post_thumbnail() ):
                ?>
                    <?php $image = get_field('imagen_de_portada'); ?>
                    <figure class="opstore-single-content mb-20">
                        <img src="<?php echo $image['url'];?>" alt="<?php echo $image['tittle']; ?>" />
                    </figure>
                <?php
                endif;
                ?>
                <figure class="opstore-single-content mb-20">
                    <?php opstore_post_formats(); ?>
                </figure>
                <?php
                    echo('<h2>Descripción </h2>');
                ?>
                <div class="title-wrap-content mb-20">
                    <div class="post-info mb-10">
                        <?php opstore_entry_meta(); ?>
                    </div>
                   
                </div>
                <div class="classic-content-wrap entry-content mb-0">
                    <div class="entry-post-content  mb-20">
                        <?php the_content(); ?>
                    </div>
                    <div class="clearfix"></div>
                   

                    <?php 
                        echo('<div>');
                        echo('<h5 style="text-decoration:line-through; color: grey">'); echo('<strong>'); the_field('precio');  echo('€'); echo('</strong>'); echo('</h5>');
                        echo('<h3>'); echo('<strong>'); echo('-');  the_field('descuento');  echo('%'); echo('</strong>');echo('</h3>');
                        $precio = get_field('precio');
                        $precio = $precio - ($precio*(get_field('descuento')/100));
                        $precio = number_format($precio, 2, ',', '');
                        echo('<h3 style=" color: red">'); echo('<strong>'); echo($precio);   echo('€'); echo('</strong>');echo('</h3>');
                        echo('<h4>'); echo('<strong>Fecha fin de oferta:  </strong>'); the_field('fecha_fin_oferta'); echo('</h4>');
                        echo('</div>');
                      
                        echo('
                            <div style="display:flex">
                            <div style="margin-right: 20px" class="quantity">
                                <label class="screen-reader-text" for="quantity_609555a6ec5a4">Cantidad Lip Mask | 60GR</label>
                                <div class="quantity-wrap">
                                    <span class="minus"> - </span>
                                    <input type="number" id="quantity_609555a6ec5a4" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Cantidad" size="4" placeholder="" inputmode="numeric">
                                    <span class="add"> + </span>
                                </div>
                            </div>
                            <button type="submit" name="add-to-cart" value="157" class="single_add_to_cart_button button alt">Añadir al carrito</button>
                            </div>
                            ');
                        ?>
                </div>
    
                <div class="mb-50">
                    <div class="bottom">
                        <div class="tag-links pull-left">
                            <?php 
                            $post_tags = get_the_tags();
                            if( $post_tags ):
                                foreach( $post_tags as $tags ):
                                    $term_id = $tags->term_id;
                                    $name = $tags->name;
                                    ?>
                                    <a href="<?php echo esc_url( get_tag_link( $term_id ) ); ?>"><?php echo esc_html( $name ); ?></a>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <!--tag links-->
                        <?php 
                        if(class_exists('Ultra_Companion')):
                            echo '<div class="pull-right">';
                            ultra_companion_social_share('Share: '); 
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
            </div>

        <?php endwhile; ?>

        <?php
        //Related Posts
        do_action('opstore_related_post');
        ?>
        <?php if( comments_open() || get_comments_number() ): ?>

            <div class="comment-area p-pb">
                <?php 
                    comments_template();
                 ?>
          </div>
        <?php endif; ?>
    </div>
    <?php 
    if( $sidebarPosition!='nosidebar' ):
        ?>
        <aside class="sidebar col-sm-3 col-xs-12 col-md-4">
            <?php get_sidebar(); ?>
        </aside>
        <?php
    endif;
    ?>
</div>


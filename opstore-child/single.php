<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package opstore
 */

get_header(); 

$page_banner_enable = get_post_meta(get_the_ID(),'ultra_page_title_banner',true);
$page_banner_enable = !empty($page_banner_enable) ? $page_banner_enable : 'on';
if( $page_banner_enable == 'on' ){
    opstore_title_banner();
}
?>

<main class="main blog-single-main p-pb single-pg primary-padding">
    <div class="blog-single">
        <div class="container">
            
            <?php
            echo('<h4>');
            echo('Fecha de Publicación: ');
            the_field('fecha_de_publicacion');
            echo('</h4>');

            get_template_part( 'template-parts/single/layout', 'one' ); ?>
        </div>
    </div>
    <!--blog-->
</main>
<!-- /.main-->

<?php
get_footer();
?>

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package opstore
 */

get_header();

/**
 * OPSTORE Title Banner
 */
$banner_enable = get_theme_mod('opstore_page_banner_show','show');
if( $banner_enable == 'show' ){
    opstore_title_banner();
}
?>


<main class="main p-pb">
    <section class="blog-block">
        <h1 style="margin-left:5%; margin-bottom: 5%"> Promociones actuales </h1>
        <div class="container">
        
             <?php 
               mycp_popularity_list();

            ?>

        </div>
    </section>
    <!--blog-->
</main>
<!-- /.main-->

<?php
get_footer();

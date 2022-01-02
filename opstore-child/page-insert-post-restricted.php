<?php
/**
 * Template Name: page-insert-post-restricted
 *
 * Inserts posts of a Custom Post Type.
 **/

acf_form_head();
get_header(); ?>


<section style="margin-bottom:15%">

	<main role="main" style="width:50%; display:block; margin-left: auto; margin-right: auto" >
		<?php
        $user = wp_get_current_user();
        $allowed_roles = array('promotor', 'administrator');

        if(array_intersect($allowed_roles, $user->roles))
        {

            while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php
                the_content();

                $args = [
                    'new_post'        => [
                    'post_type'   => 'promo',
                    'post_status' => 'publish'
                    ],
              
                    'post_id'         => 'new_post',
                    'post_title'      => true,
                    'post_content'      => true,
                   

                    'submit_value'    => 'Subir',
                    'updated_message' => 'Promocion creada',
                ];

                acf_form( $args );
            endwhile;

        }
        else
        {
            echo "<h1> Solo los promotores tienen acceso a esta página </h1>";
            echo "<p> Registrate como promotor o logueate para poder acceder<p>";
            echo <<<heredoc
            heredoc;
        }
		?>

	</main>

</section>
<?php
//get_sidebar();
get_footer();
?>
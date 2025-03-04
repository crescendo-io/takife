<?php
get_header();

?>


<div class="container">
    <div class="row">
        <?php
        if (is_cart()) { ?>
                    <h2 style="text-align: center; margin-top: 120px">Votre Panier</h2>
        <?php }
        ?>
        <div class="col-sm-12">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php
if( have_rows('page') ):
    while ( have_rows('page') ) : the_row();
        get_template_part('template-parts/strates/' . get_row_layout());
    endwhile;
endif;

?>

<?php
    get_footer();
?>

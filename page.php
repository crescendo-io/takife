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
    get_footer();
?>

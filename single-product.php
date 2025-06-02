<?php
    get_header();
?>

<div class="strate-hero full " style="color: #ffffff; background: ">
    <img src="<?= get_site_url(); ?>/wp-content/uploads/2025/04/hero.jpg" class="strate-hero_image" alt="" width="1438" height="1002">
    <div class="strate-hero_inner">
        <h1>FESTIVAL DU KIFF</h1>
        <h2>Journée Btob : 4 juillet 2025 de 10h30 à 19h + Soirée VIP<br/>
        </h2>

    </div>
</div>
<div class="strate">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Reservez votre place</h3>
                <table class="product-variations" width="100%">
                    <tbody>
                    <?php
                    // Vérifiez que WooCommerce est chargé
                    if (class_exists('WooCommerce')) {
                        global $post;

                        // Obtenez l'objet produit
                        $product = wc_get_product($post->ID);

                        // Vérifiez que c'est un produit simple ou autre (non variable)
                        if ($product && !$product->is_type('variable')) {
                            $price = wc_price($product->get_price());
                            $product_id = $product->get_id();
                            $product_name = $product->get_name();

                            echo '<tr>';
                            echo '<td>' . esc_html($product_name) . '</td>';
                            echo '<td>' . $price . '</td>';
                            echo '<td style="text-align: right">';
                            echo '<form method="post" action="' . esc_url('?add-to-cart=' . $product_id) . '">';
                            echo '<input type="number" name="quantity" class="select-quant" value="1" min="1" style="width: 50px; display: none">';
                            echo '<button type="submit" class="button primary">Ajouter au panier</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        } else {
                            echo '<tr><td colspan="3">Ce produit n\'est pas un produit simple.</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">WooCommerce n\'est pas installé ou activé.</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<?php
    get_footer();
?>

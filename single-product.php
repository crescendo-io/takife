<?php
    get_header();
?>

<div class="strate-hero full " style="color: #ffffff; background: ">
    <img src="https://harmony-builder.code/wp-content/uploads/2024/05/hero-2.png" class="strate-hero_image" alt="" width="1438" height="1002">
    <div class="strate-hero_inner">
        <h1>L'event</h1>
        <h2>🗓️ 19 décembre 2024<br/>
            ⏰ 19h – 00h<br/>
            L’Imprimerie Hôtel 15 Rue Victor Méric, 92110 Clichy<br/>
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

                        // Vérifiez que c'est bien un produit variable
                        if ($product && $product->is_type('variable')) {
                            $variations = $product->get_available_variations();

                            foreach ($variations as $variation) {
                                $variation_id = $variation['variation_id'];
                                $attributes = $variation['attributes']; // Attributs des variations
                                $formatted_attributes = implode(', ', array_map(function($key, $value) {
                                    return wc_attribute_label(str_replace('attribute_', '', $key)) . ': ' . $value;
                                }, array_keys($attributes), $attributes));
                                $price = wc_price($variation['display_price']);

                                echo '<tr>';
                                echo '<td>' . esc_html($formatted_attributes) . '</td>';
                                echo '<td>' . $price . '</td>';
                                echo '<td style="text-align: right">';
                                echo '<form method="post" action="' . esc_url('?add-to-cart=' . $variation_id) . '">';
                                echo '<input type="number" name="quantity" class="select-quant" value="1" min="1" style="width: 50px;">';
                                echo '<button type="submit" class="button primary">Ajouter au panier</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">Ce produit n\'a pas de variations disponibles.</td></tr>';
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

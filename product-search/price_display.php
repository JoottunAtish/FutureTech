<?php

if ($p_discount > 0) {
?>
    <strike><?php echo "Rs. " . number_format($p_price, 2, '.', ',') ?></strike><?php echo "Rs. " .  number_format($p_price * ((100 - $p_discount) / 100), 2, ".", ","); ?>
<?php
} else {

    echo "Rs. " . number_format($p_price, 2, '.', ',');
}
?>
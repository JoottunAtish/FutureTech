<?php

if ($p_discount > 0) {
?>
    <div class="d-flex justify-content-center align-items-center gap-3">
        <strike>
            <p class=""><?php echo "Rs. " . number_format($p_price, 2, '.', ',') ?></p>
        </strike>
        <p class="bg-success text-white px-1 py-1 rounded"><?php echo "Rs. " .  number_format($p_price * ((100 - $p_discount) / 100), 2, ".", ","); ?></p>
    </div>
<?php
} else {
?>
    <p class="fs-4 fw-bold">
        <?php
        echo "Rs. " . number_format($p_price, 2, '.', ',');
        ?>
    </p>

<?php
}
?>
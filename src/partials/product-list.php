<div class="product-list">
    <div class="row g-3">
        <?php
            $classCol = $layout == "horizontal" ? "col-6" : "col-4";
            foreach($products as $product){
                echo "<div class=\"" .$classCol . "\">";
                partial("product-" . $layout,[
                    'productInfo' => $product
                ]);

                echo "</div>";

            }
        ?>
    </div>
</div>
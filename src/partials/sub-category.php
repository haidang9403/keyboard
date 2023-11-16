<?php
    $layout = ($layout ?? "vertical");
    $modifyCategory = 'category--' . ($modify ?? 'popular');
    $titleCategory = $title ?? (isset($modify) ? 
                    ($modify == 'popular' ? "Danh mục phổ biến" : 
                    ($modify == 'hot' ? "Danh mục bán chạy" : "Sản phẩm mới")) 
                    : "Danh mục");
?>

<div class="category <?=$modifyCategory?> m-top-100">
    <div class="title">
        <?=htmlspecialchars($titleCategory)?>
    </div>
    <div class="product-list">
        <div class="row g-3">
            <?php
                $classCol = $layout == "vertical" ? "col-3" : "col-6";
                if(isset($introduce)){
                    view('frontend.home.introduction',[
                        'productIntro' => $introduce['productIntro']
                    ]);
                }
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
</div>
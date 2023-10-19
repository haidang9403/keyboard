    <!-- ====== Introduction ====== -->
<div class="introduce">
    <div class="row gx-3">
        <!-- ====== Product ======= -->
        <div class="col-3">
           <?php
            partial('product-vertical',[
                'productInfo' => $productIntro
            ]);
           ?>
        </div>

        <!-- ===== Slider ====== -->
        <div class="col-9">
            <div class="slider-wrapper rounded">
                <img class="slider" src="../images/sliders/slider-1.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<div class="filter rounded overflow-hidden">
    <div class="filter-title">Bộ lọc</div>
    <form action="">
        <div class="accordion filter-content">
            <div class="accordion-item border-0 filter-item filter-item--price">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        Giá
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="price-range">
                            <div class="input-group">
                                <input class="rounded filter-price price-min" type="number" min="0" max="6000000" step="100000" value="0">
                                <span class="text-divided"><i class="bi bi-dash"></i></span>
                                <input class="rounded filter-price price-max" type="number" min="0" max="6000000" step="100000" value="6000000">
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-group">
                                <input type="range" class="range range-min" min="0" max="6000000" step="100000" value="0">
                                <input type="range" class="range range-max" min="0" max="6000000" step="100000" value="6000000">
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 filter-item filter-item--size">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseTwo">
                        Kích thước
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                    <input type="checkbox" class="btn-check size-check" id="btn-check-size-60" autocomplete="off" value="6%">
                    <label class="btn btn-checkbox m-2 size-check-label" for="btn-check-size-60">60 - 68%</label>
                
                    <input type="checkbox" class="btn-check size-check" id="btn-check-size-70" autocomplete="off" value="7%">
                    <label class="btn btn-checkbox m-2 size-check-label" for="btn-check-size-70">75%</label>

                    <input type="checkbox" class="btn-check size-check" id="btn-check-size-80" autocomplete="off" value="8%">
                    <label class="btn btn-checkbox m-2 size-check-label" for="btn-check-size-80">80 - 87%</label>

                    <input type="checkbox" class="btn-check size-check" id="btn-check-size-100" autocomplete="off" value="100%">
                    <label class="btn btn-checkbox m-2 size-check-label" for="btn-check-size-100">100%</label>
                </div>
            </div>
            <div class="accordion-item border-0 filter-item filter-item--size">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseTwo">
                        Trạng thái
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                    <input type="checkbox" class="btn-check state-check" id="btn-check-state-1" autocomplete="off" value="popular">
                    <label class="btn btn-checkbox m-2" for="btn-check-state-1">Phổ biến</label>
        
                    <input type="checkbox" class="btn-check state-check" id="btn-check-state-2" autocomplete="off" value="new">
                    <label class="btn btn-checkbox m-2" for="btn-check-state-2">Mới</label>
        
                    <input type="checkbox" class="btn-check state-check" id="btn-check-state-3" autocomplete="off" value="discount">
                    <label class="btn btn-checkbox m-2" for="btn-check-state-3">Giảm giá</label>
            
                </div>
            </div>
        </div>
    </form>
</div>
<div class="page__sidebar-content" data-da=".page__sidebar-content-mobile,950,1">
    <div class="page__sidebar-search-content">
        <p>Быстрый поиск</p>
        <div class="page__sidebar-search">
            <div class="page__sidebar-search-input">
                <button class="page__sidebar-search-btn page__sidebar-search-btn--search" id="search-btn">
                    <div class="page__sidebar-search-btn-icon">
                        <iconify-icon icon="lucide:search" width="100%" height="100%" noobserver></iconify-icon>
                    </div>
                </button>
                <input type="text" id="search-input" placeholder="Введите запрос..." autocomplete="off">
                <button class="page__sidebar-search-btn page__sidebar-search-btn--clear" id="search-clear" style="display:none;">
                    <div class="page__sidebar-search-btn-icon">
                        <iconify-icon icon="lucide:x" width="100%" height="100%" noobserver></iconify-icon>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <div data-spollers class="spollers _spoller-init">
        <details class="spollers__item" data-open open>
            <summary class="spollers__title _spoller-active">Институты и филиалы</summary>
            <div class="spollers__body">
                <ul>
                    <?php foreach ($arSections as $arSection): ?>
                        <li>
                            <a href="#" class="section-link" data-section="<?php echo $arSection['ID']; ?>">
                                <span><?php echo $arSection['NAME']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </details>

    </div>
</div>
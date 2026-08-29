<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true); ?>

<?php if ($arResult['NavPageCount'] > 1): ?>
    <?php
// ссылка на первую страницу
    $firstPageUrl = $arResult['sUrlPath'];
    if (!empty($arResult['NavQueryString'])) {
        $firstPageUrl = $firstPageUrl . '?' . $arResult['NavQueryString'];
    }
// ссылка на последнюю страницу
    $lastPageUrl = $arResult['sUrlPath'];
    if (!empty($arResult['NavQueryString'])) {
        $lastPageUrl = $lastPageUrl . '?' . $arResult['NavQueryString'] . '&PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
    } else {
        $lastPageUrl = $lastPageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
    }
    ?>
    <nav class="pagination__nav" aria-label="Навигация по страницам">
        <ul class="pagination">
            <?php if ($arResult['NavPageNomer'] > 1): /* ссылка на предыдущую страницу */ ?>
                <li class="pagination__item">
                    <a href="?PAGEN_<?= $arResult['NavNum'] ?>=<?= $arResult['NavPageNomer'] - 1 ?>"
                       class="pagination__arrow _prev" aria-label="Предыдущая">
                        <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
                    </a>
                </li>
            <?php else: ?>
                <li class="pagination__item">
                    <a href=""
                       class="pagination__arrow _prev" aria-label="Предыдущая">
                        <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($arResult['NavPageNomer'] > 3 && $arResult['NavPageCount'] > 5): /* ссылка на первую страницу */ ?>
                <li class="pagination__item">
                    <a href="<?= $firstPageUrl ?>" class="pagination__page">1</a>
                </li>
            <?php endif; ?>
            <?php if ($arResult['NavPageNomer'] > 4 && $arResult['NavPageCount'] > 6): ?>
                <li class="pagination__item" aria-hidden="true">
                    <span class="pagination__dots">...</span>
                </li>
            <?php endif; ?>
            <?php for ($i = $arResult['nStartPage']; $i <= $arResult['nEndPage']; $i++): ?>
                <?php
                // ссылка на очередную страницу
                $pageUrl = $arResult['sUrlPath'];
                if (!empty($arResult['NavQueryString'])) {
                    $pageUrl = $pageUrl . '?' . $arResult['NavQueryString'] . '&PAGEN_' . $arResult['NavNum'] . '=' . $i;
                } else {
                    $pageUrl = $pageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $i;
                }
                ?>
                <?php if ($arResult['NavPageNomer'] == $i): /* если это текущая страница */ ?>
                    <li class="pagination__item">
                        <span class="pagination__page _active" aria-current="page"><?= $i; ?></span>
                    </li>
                <?php else: ?>
                    <li class="pagination__item">
                        <a href="<?= $pageUrl; ?>" class="pagination__page"><?= $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount'] - 3 && $arResult['NavPageCount'] > 6): /* ссылка на последнюю страницу */ ?>
                <li class="pagination__item" aria-hidden="true">
                    <span class="pagination__dots">...</span>
                </li>
            <?php endif; ?>
            <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount'] - 2 && $arResult['NavPageCount'] > 5): /* ссылка на последнюю страницу */ ?>

                <li class="pagination__item">
                    <a href="<?= $lastPageUrl; ?>" class="pagination__page"><?= $arResult['NavPageCount'] ?></a>
                </li>
            <?php endif; ?>
            <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount']): /* ссылка на следующую страницу */ ?>
                <li class="pagination__item">
                    <a href="?PAGEN_<?= $arResult['NavNum'] ?>=<?= $arResult['NavPageNomer'] + 1 ?>"
                       class="pagination__arrow _next" aria-label="Следующая">
                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
                    </a>
                </li>
            <?php else: ?>
                <li class="pagination__item">
                    <a href="" class="pagination__arrow _next" aria-label="Следующая">
                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>


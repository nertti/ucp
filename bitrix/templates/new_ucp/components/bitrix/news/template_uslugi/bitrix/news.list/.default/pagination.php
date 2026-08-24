12121<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
?>
2121212
<nav class="pagination__nav" aria-label="Навигация по страницам">
    <ul class="pagination">
        <?php if ($arResult["NavPageNomer"] > 1): ?>
            <li class="pagination__item">
                <a href="<?php echo $arResult["sUrlPath"] . '?' . $arResult["NavQueryString"] . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1); ?>" class="pagination__arrow _prev" aria-label="Предыдущая">
                    <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
                </a>
            </li>
        <?php else: ?>
            <li class="pagination__item">
                <span class="pagination__arrow _prev disabled" aria-label="Предыдущая">
                    <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
                </span>
            </li>
        <?php endif; ?>

   12121     <?php
        $startPage = max(1, $arResult["NavPageNomer"] - 2);
        $endPage = min($arResult["NavPageCount"], $arResult["NavPageNomer"] + 2);
        
        if ($startPage > 1): ?>
            <li class="pagination__item">
                <a href="<?php echo $arResult["sUrlPath"] . '?' . $arResult["NavQueryString"] . 'PAGEN_' . $arResult["NavNum"] . '=1'; ?>" class="pagination__page">1</a>
            </li>
            <?php if ($startPage > 2): ?>
                <li class="pagination__item" aria-hidden="true">
                    <span class="pagination__dots">...</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <li class="pagination__item">
                <?php if ($i == $arResult["NavPageNomer"]): ?>
                    <span class="pagination__page _active" aria-current="page"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="<?php echo $arResult["sUrlPath"] . '?' . $arResult["NavQueryString"] . 'PAGEN_' . $arResult["NavNum"] . '=' . $i; ?>" class="pagination__page"><?php echo $i; ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if ($endPage < $arResult["NavPageCount"]): ?>
            <?php if ($endPage < $arResult["NavPageCount"] - 1): ?>
                <li class="pagination__item" aria-hidden="true">
                    <span class="pagination__dots">...</span>
                </li>
            <?php endif; ?>
            <li class="pagination__item">
                <a href="<?php echo $arResult["sUrlPath"] . '?' . $arResult["NavQueryString"] . 'PAGEN_' . $arResult["NavNum"] . '=' . $arResult["NavPageCount"]; ?>" class="pagination__page"><?php echo $arResult["NavPageCount"]; ?></a>
            </li>
        <?php endif; ?>

        <?php if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <li class="pagination__item">
                <a href="<?php echo $arResult["sUrlPath"] . '?' . $arResult["NavQueryString"] . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1); ?>" class="pagination__arrow _next" aria-label="Следующая">
                    <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                </a>
            </li>
        <?php else: ?>
            <li class="pagination__item">
                <span class="pagination__arrow _next disabled" aria-label="Следующая">
                    <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                </span>
            </li>
        <?php endif; ?>
    </ul>
</nav>
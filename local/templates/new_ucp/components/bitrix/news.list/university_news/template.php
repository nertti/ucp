<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<?php if (!empty($arResult['ITEMS'])): ?>

    <?php
    $items = $arResult['ITEMS'];
    $mainItem = array_shift($items);
    ?>

    <div class="home__feed-news-content">

        <?php if ($mainItem): ?>
            <?php
            $this->AddEditAction(
                    $mainItem['ID'],
                    $mainItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($mainItem["IBLOCK_ID"], "ELEMENT_EDIT")
            );

            $this->AddDeleteAction(
                    $mainItem['ID'],
                    $mainItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($mainItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
            );
            ?>

            <div
                    id="<?= $this->GetEditAreaId($mainItem['ID']); ?>"
                    class="home__feed-news-main"
                    data-category="<?= $mainItem['IBLOCK_SECTION_ID'] ?>"
            >
                <a href="<?= $mainItem['DETAIL_PAGE_URL']; ?>">
                    <div class="home__feed-news-slider-img">
                        <img
                                src="<?= $mainItem['PREVIEW_PICTURE']['SRC'] ?>"
                                alt="<?= htmlspecialchars($mainItem['NAME']) ?>"
                                title="<?= htmlspecialchars($mainItem['NAME']) ?>"
                        />
                    </div>

                    <div class="home__feed-news-slider-info">
                        <div class="date">
                            <iconify-icon
                                    icon="lsicon:calendar-outline"
                                    width="18"
                                    height="18"
                                    noobserver
                            ></iconify-icon>

                            <span><?= $mainItem['DISPLAY_ACTIVE_FROM'] ?></span>
                        </div>

                        <h4 class="title-four">
                            <?= $mainItem['NAME'] ?>
                        </h4>

                        <?php if (!empty($mainItem['PREVIEW_TEXT'])): ?>
                            <p class="text-caption">
                                <?= $mainItem['PREVIEW_TEXT'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>


        <div class="home__feed-news-latest">
            <ul class="home__feed-news-list">

                <?php foreach ($items as $arItem): ?>

                    <?php
                    $this->AddEditAction(
                            $arItem['ID'],
                            $arItem['EDIT_LINK'],
                            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
                    );

                    $this->AddDeleteAction(
                            $arItem['ID'],
                            $arItem['DELETE_LINK'],
                            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                            ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
                    );
                    ?>

                    <li
                            id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                            class="home__feed-news-item"
                            data-category="<?= $arItem['IBLOCK_SECTION_ID'] ?>"
                    >
                        <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">

                            <div class="home__feed-news-item-img">
                                <img
                                        src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                        alt="<?= htmlspecialchars($arItem['NAME']) ?>"
                                />
                            </div>

                            <div class="home__feed-news-info">
                                <div class="date">
                                    <iconify-icon
                                            icon="lsicon:calendar-outline"
                                            width="18"
                                            height="18"
                                            noobserver
                                    ></iconify-icon>

                                    <span><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
                                </div>

                                <p>
                                    <?= $arItem['NAME'] ?>
                                </p>
                            </div>

                        </a>
                    </li>

                <?php endforeach; ?>

            </ul>
        </div>

    </div>

<?php endif; ?>

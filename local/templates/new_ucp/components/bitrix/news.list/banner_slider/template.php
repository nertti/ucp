<section class="preview">
    <div class="preview-slider swiper">
        <div class="swiper-wrapper">
            <?php
            foreach ($arResult['ITEMS'] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $properties = $arItem['PROPERTIES'];

                $backgroundImage = !empty($properties['BACKGROUND_IMAGE']['VALUE'])
                        ? CFile::GetPath($properties['BACKGROUND_IMAGE']['VALUE'])
                        : '';

                $image = !empty($properties['IMAGE']['VALUE'])
                        ? CFile::GetPath($properties['IMAGE']['VALUE'])
                        : '';

                $video = !empty($properties['VIDEO']['VALUE'])
                        ? CFile::GetPath($properties['VIDEO']['VALUE'])
                        : '';

                $buttons = [];

                if (!empty($properties['BUTTONS']['VALUE'])) {

                    $values = is_array($properties['BUTTONS']['VALUE'])
                            ? $properties['BUTTONS']['VALUE']
                            : [$properties['BUTTONS']['VALUE']];

                    $descriptions = is_array($properties['BUTTONS']['DESCRIPTION'])
                            ? $properties['BUTTONS']['DESCRIPTION']
                            : [$properties['BUTTONS']['DESCRIPTION']];

                    foreach ($values as $key => $value) {
                        if (trim($value) === '') {
                            continue;
                        }

                        $buttons[] = [
                                'TEXT' => $value,
                                'LINK' => $descriptions[$key] ?? '',
                        ];
                    }
                }
                if (empty($buttons) && !empty($properties['LINK']['VALUE'])) {
                    $buttons[] = [
                            'TEXT' => $arItem['NAME'],
                            'LINK' => $properties['LINK']['VALUE'],
                    ];
                }
                ?>
                <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
                    <?php if ($video): ?>
                        <div class="preview-slider-video<?php if ($arItem['PROPERTIES']['VIEW_GRADIENT']['VALUE_XML_ID'] !== 'Y'): ?> without-gradient<?php endif; ?><?php if ($arItem['PROPERTIES']['VIEW_BLUR']['VALUE_XML_ID'] !== 'Y'): ?> without-gradient<?php endif; ?>">
                            <video
                                    src="<?= htmlspecialcharsbx($video) ?>"
                                    autoplay
                                    playsinline
                                    loop
                                    muted
                            ></video>
                        </div>
                        <div class="preview-slider-logo-wrapper">
                            <div class="home__container">
                                <img
                                        src="<?= $image ?>"
                                        alt="<?= $arItem['NAME'] ?>"
                                        title="<?= $arItem['NAME'] ?>"
                                        class="preview-slider-logo"
                                />
                            </div>
                        </div>
                        <div class="preview-slider-video-mute-wrapper">
                            <div class="home__container">
                                <button class="preview-slider-video-mute" type="button">
                                    <iconify-icon icon="octicon:unmute-16" width="24" height="24"
                                                  noobserver></iconify-icon>
                                </button>
                            </div>
                        </div>
                    <?php elseif ($backgroundImage): ?>
                        <div class="preview-slider-img
                        <?php if ($arItem['PROPERTIES']['VIEW_GRADIENT']['VALUE_XML_ID'] !== 'Y'): ?> without-gradient<?php endif; ?>
                        <?php if ($arItem['PROPERTIES']['VIEW_BLUR']['VALUE_XML_ID'] !== 'Y'): ?> without-gradient<?php endif; ?>">
                            <img src="<?= htmlspecialcharsbx($backgroundImage) ?>" alt="<?= $arItem['NAME'] ?>"
                                 title="<?= $arItem['NAME'] ?>">
                        </div>
                        <?php if ($image): ?>
                            <div class="preview-slider-logo-wrapper">
                                <div class="home__container">
                                    <img src="<?= htmlspecialcharsbx($image) ?>" alt="<?= $arItem['NAME'] ?>"
                                         title="<?= $arItem['NAME'] ?>" class="preview-slider-logo">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    // Текст и кнопки выводим только если нет VIDEO и IMAGE
                    if (!$video && !$image):
                        ?>
                        <div class="preview-slider-content">
                            <div class="preview__container">
                                <h1 class="title-one">
                                    <?= htmlspecialcharsbx($arItem['NAME']) ?>
                                </h1>
                                <?php if ($buttons): ?>
                                    <div class="preview-slider-content__action">
                                        <?php foreach ($buttons as $key => $button): ?>
                                            <?php if (!$button['LINK']) continue; ?>
                                            <a href="<?= htmlspecialcharsbx($button['LINK']) ?>"
                                               class="<?= $key === 0 ? 'button-blue' : 'button-white' ?>">
                                    <span>
                                        <?= htmlspecialcharsbx($button['TEXT']) ?>
                                    </span>
                                                <iconify-icon
                                                        icon="lucide:chevron-right"
                                                        width="24"
                                                        height="24"
                                                        noobserver
                                                ></iconify-icon>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="preview-slider-pagination"></div>
    </div>
</section>
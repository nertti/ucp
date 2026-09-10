<?php
/**
 * @var $block array
 * @var $this SprintEditorBlocksComponent
 */

$containerBlocks = $block['my_container']['blocks'] ?? [];

$buttonItems = [];

/**
 * Получаем элементы блока my_button_icons_link
 */
foreach ($containerBlocks as $item) {
    if ($item['name'] === 'my_button_icons_link') {
        $buttonItems[] = $item['items'][0] ?? [];
    }
}
?>

<div class="swiper-slide">
    <div class="universities__slider-wrapper">

        <div class="universities__slider-img">
            <?php if (!empty($block['image']['file']['ORIGIN_SRC'])): ?>
                <img
                        alt="Image"
                        title="Факультеты"
                        src="<?= htmlspecialcharsbx($block['image']['file']['ORIGIN_SRC']) ?>"
                >
            <?php endif; ?>
        </div>


        <div class="universities__slider-action">

            <button class="universities__slider-button-prev swiper-button-prev">
                <iconify-icon
                        icon="lucide:chevron-left"
                        width="24"
                        height="24"
                        noobserver=""
                ></iconify-icon>
            </button>

            <button class="universities__slider-button-next swiper-button-next">
                <iconify-icon
                        icon="lucide:chevron-right"
                        width="24"
                        height="24"
                        noobserver=""
                ></iconify-icon>
            </button>

        </div>


        <div class="universities__slider-slider-pagination"></div>

    </div>
    <div class="universities__slider-content">

        <?php if (!empty($block['htag']['value'])): ?>
            <h2 class="title-two">
                <?= htmlspecialcharsbx($block['htag']['value']) ?>
            </h2>
        <?php endif; ?>


        <?php if (!empty($buttonItems)): ?>
            <ul class="universities__slider-list">

                <?php foreach ($buttonItems as $button): ?>
                    <li class="universities__slider-list-item">
                        <a
                                href="<?= htmlspecialcharsbx($button['url'] ?? '') ?>"
                                <?php if (($button['target'] ?? '') === '_blank'): ?>
                                    target="_blank"
                                    rel="noopener noreferrer"
                                <?php endif; ?>
                        >

                            <?php if (!empty($button['icon'])): ?>
                                <div class="icon">
                                    <?= $button['icon'] ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($button['title'])): ?>
                                <p>
                                    <?= htmlspecialcharsbx($button['title']) ?>
                                </p>
                            <?php endif; ?>

                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        <?php endif; ?>

        <div class="news__slider-info" style="width: 100%">
            <?php foreach ($containerBlocks as $item): ?>
                <?php switch ($item['name']):

                    /**
                     * Текстовый блок
                     */
                    case 'text':
                        ?>

                        <div class="text">
                            <?= $item['value'] ?? '' ?>
                        </div>

                        <?php
                        break;


                    /**
                     * Кнопка-ссылка
                     */
                    case 'button_link':
                        ?>

                        <a
                                class="button-detail"
                                href="<?= htmlspecialcharsbx($item['url'] ?? '') ?>"
                                <?php if (($item['target'] ?? '') === '_blank'): ?>
                                    target="_blank"
                                    rel="noopener noreferrer"
                                <?php endif; ?>
                        >
                        <span>
                            <?= htmlspecialcharsbx($item['title'] ?? '') ?>
                        </span>

                            <iconify-icon
                                    icon="lucide:chevron-right"
                                    width="24"
                                    height="24"
                                    noobserver=""
                            ></iconify-icon>
                        </a>

                        <?php
                        break;

                endswitch; ?>
            <?php endforeach; ?>
        </div>


    </div>
</div>

<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult)): ?>
    <div data-fls-spollers="1024,max" class="spollers">

        <?php foreach ($arResult as $arItem): ?>
            <?php
            $hasChildren = !empty($arItem['CHILDREN']);
            ?>

            <?php if ($hasChildren): ?>

                <details class="spollers__item">
                    <summary class="spollers__title">
                        <a href="<?= htmlspecialcharsbx($arItem['LINK']) ?>">
                            <?= htmlspecialcharsbx($arItem['TEXT']) ?>
                        </a>
                    </summary>

                    <div class="spollers__body">
                        <ul>
                            <?php foreach ($arItem['CHILDREN'] as $arSubItem): ?>
                                <li>
                                    <a href="<?= htmlspecialcharsbx($arSubItem['LINK']) ?>">
                                        <?= htmlspecialcharsbx($arSubItem['TEXT']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </details>

            <?php else: ?>

                <div class="spollers__item">
                    <div class="spollers__title">
                        <a href="<?= htmlspecialcharsbx($arItem['LINK']) ?>">
                            <?= htmlspecialcharsbx($arItem['TEXT']) ?>
                        </a>
                    </div>
                </div>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>
<?php endif; ?>

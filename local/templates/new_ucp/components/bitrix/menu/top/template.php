<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult)): ?>
    <ul class="menu">
        <?php foreach ($arResult as $arItem): ?>
            <?php
            $hasChildren = !empty($arItem['CHILDREN']);
            ?>

            <li class="menu__item<?= $hasChildren ? ' menu__item--has-dropdown' : '' ?>">
                <a
                        href="<?= htmlspecialcharsbx($arItem['LINK']) ?>"
                        class="menu__link"
                >
                    <span><?= htmlspecialcharsbx($arItem['TEXT']) ?></span>

                    <?php if ($hasChildren): ?>
                        <span class="menu__arrow">
                            <iconify-icon
                                    icon="lucide:chevron-down"
                                    width="100%"
                                    height="100%"
                                    noobserver
                            ></iconify-icon>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if ($hasChildren): ?>
                    <div class="menu__dropdown">
                        <ul class="menu__dropdown-list">
                            <?php foreach ($arItem['CHILDREN'] as $arSubItem): ?>
                                <li class="menu__dropdown-item">
                                    <a
                                            href="<?= htmlspecialcharsbx($arSubItem['LINK']) ?>"
                                            class="menu__dropdown-link"
                                    >
                                        <?= htmlspecialcharsbx($arSubItem['TEXT']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </li>

        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<style>

.home__feed-nav-list {
    display: grid;
    grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
    gap: 16px;

    width: 100%;
    margin: 0;
    padding: 0;

    list-style: none;
}

/* Планшет / небольшая ширина */
@media (max-width: 1100px) {

    .home__feed-nav-list[style*="--columns: 5"] {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

}

</style><?php
/**
 * @var $block array
 * @var $this SprintEditorBlocksComponent
 */

if (!empty($block['blocks'])):

    $total = count($block['blocks']);

    // Максимум плиток в строке
    $maxPerRow = 5;

    // Количество строк
    $rowCount = (int)ceil($total / $maxPerRow);

    // Равномерно распределяем элементы между строками
    $base = intdiv($total, $rowCount);
    $remainder = $total % $rowCount;

    $rows = [];

    for ($i = 0; $i < $rowCount; $i++) {
        $rows[] = $base + ($i < $remainder ? 1 : 0);
    }

    $blockIndex = 0;
?>
<style>

.home__feed-nav-list {
    display: grid;
    grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
    gap: 16px;

    width: 100%;
    margin: 0;
    padding: 0;

    list-style: none;
}

/* Планшет / небольшая ширина */
@media (max-width: 1100px) {

    .home__feed-nav-list[style*="--columns: 5"] {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

}

</style>
<nav class="home__feed-nav">

    <?php foreach ($rows as $columns): ?>

        <ul
            class="home__feed-nav-list"
            style="--columns: <?= $columns ?>;"
        >
            <?php for ($i = 0; $i < $columns; $i++): ?>

                <?php $this->includeBlock($block['blocks'][$blockIndex]); ?>

                <?php $blockIndex++; ?>

            <?php endfor; ?>
        </ul>

    <?php endforeach; ?>

</nav>

<?php endif; ?>
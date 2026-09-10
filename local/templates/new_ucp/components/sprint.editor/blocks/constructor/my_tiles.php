<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<?php if (!empty($block['blocks'])): ?>

    <?php
    $total = count($block['blocks']);
    $rows = [];

    $rowCount = (int)ceil($total / 5);

    while ($rowCount > 1 && ceil($total / $rowCount) < 3) {
        $rowCount--;
    }

    $base = intdiv($total, $rowCount);
    $remainder = $total % $rowCount;

    for ($i = 0; $i < $rowCount; $i++) {
        $rows[] = $base + ($i < $remainder ? 1 : 0);
    }

    $blockIndex = 0;
    ?>

    <nav class="home__feed-nav" style="height: 150px;">

        <?php foreach ($rows as $rowCount): ?>

            <ul
                    class="home__feed-nav-list"
                    style="height:100%; grid-template-columns: repeat(<?= $rowCount ?>, 1fr);"
            >
                <?php for ($i = 0; $i < $rowCount; $i++): ?>

                    <?php $this->includeBlock($block['blocks'][$blockIndex]); ?>

                    <?php $blockIndex++; ?>

                <?php endfor; ?>
            </ul>

        <?php endforeach; ?>

    </nav>

<?php endif; ?>
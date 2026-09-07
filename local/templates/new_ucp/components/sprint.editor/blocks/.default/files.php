<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>

<?php if (!empty($block['files'])) : ?>
    <div class="documents">
        <?php foreach ($block['files'] as $item) : ?>
            <div class="documents__item">
                <a download="<?= htmlspecialcharsbx($item['file']['ORIGINAL_NAME']) ?>"
                   title="<?= htmlspecialcharsbx($item['desc']) ?>"
                   href="<?= htmlspecialcharsbx($item['file']['SRC']) ?>">
                    <div class="icon">
                        <div class="icon-wrapper">
                            <iconify-icon icon="bi:file-earmark-pdf-fill" width="100%" height="100%"
                                          noobserver=""></iconify-icon>
                        </div>
                    </div>
                    <p><?= htmlspecialcharsbx($item['file']['ORIGINAL_NAME']) ?></p>
                    <button type="button">
                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
                    </button>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?><?php

$items = Sprint\Editor\Blocks\VideoGallery::getItems(
        $block, [
        'width' => 320,
        'height' => 240,
        'exact' => 0,
], [
                'width' => 1024,
                'height' => 768,
                'exact' => 0,
        ]
);
?>

<?php foreach ($items as $item): ?>
    <?php if (!empty($item['YOUTUBE_CODE'])): ?>
        <div class="page__video">
            <iframe src="https://www.youtube.com/embed/<?= $item['YOUTUBE_CODE'] ?>" title="YouTube video player" frameborder="0" allow="
                                            accelerometer;
                                            autoplay;
                                            clipboard-write;
                                            encrypted-media;
                                            gyroscope;
                                            picture-in-picture;
                                            web-share;
                                        " referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    <?php else:?>
                 <video src="<?= $item['DETAIL_SRC'] ?>" controls></video>
    <?php endif; ?>
<?php endforeach; ?>

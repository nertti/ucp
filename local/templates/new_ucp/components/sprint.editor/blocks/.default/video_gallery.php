<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<style>
    .page__video {
        width: 100%;
        max-width: 780px;
        height: 480px;
        border-radius: 8px;
        margin-inline: auto;
    }
    .video__list .page__video{
        height: 280px;
    }
    .video__list._three .page__video{
        height: 180px;
    }
</style>
<?php if (count($block['items']) > 1): ?>
<div class="video__list <?php if (count($block['items']) == 3): ?> _three<?php endif; ?>">
    <?php foreach ($block['items'] as $item): ?>
        <?php
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $item['video'], $matches);
        $video_id = $matches[1] ?? null;
        ?>

        <?php if (!empty($video_id)): ?>
            <div class="page__video">
            <iframe src="https://www.youtube.com/embed/<?= $video_id ?>" title="YouTube video player"
                    frameborder="0" allow="
                                            accelerometer;
                                            autoplay;
                                            clipboard-write;
                                            encrypted-media;
                                            gyroscope;
                                            picture-in-picture;
                                            web-share;
                                        " referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php else:?>
    <?php foreach ($block['items'] as $item): ?>
        <?php
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $item['video'], $matches);
        $video_id = $matches[1] ?? null;
        ?>

        <?php if (!empty($video_id)): ?>
            <div class="page__video">
                <iframe src="https://www.youtube.com/embed/<?= $video_id ?>" title="YouTube video player"
                        frameborder="0" allow="
                                            accelerometer;
                                            autoplay;
                                            clipboard-write;
                                            encrypted-media;
                                            gyroscope;
                                            picture-in-picture;
                                            web-share;
                                        " referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

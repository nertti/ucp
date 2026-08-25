<?php
foreach ($arResult["ITEMS"] as &$arItem) {
    $text = $arItem["DETAIL_TEXT"];
    $firstParagraph = '';
    if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $text, $matches)) {
        $firstParagraph = $matches[1];
    } else {
        $firstParagraph = explode("\n", $text)[0];
    }
    $previewText = strip_tags($firstParagraph);
    if (mb_strlen($previewText) > 180) {
        $previewText = mb_substr($previewText, 0, 180) . '...';
    }
    $arItem["PREVIEW_TEXT"] = $previewText;
}



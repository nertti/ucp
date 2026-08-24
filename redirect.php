<?php

/**
 * <IfModule mod_rewrite.c>
 *    RewriteEngine On
 *    RewriteRule ^(ok\d+)$ /redirect.php?id=$1 [L,R=301]
 *  </IfModule>
 */

try {
  $id = NULL;

  if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
  }

  if (!$id) {
    throw new Error('Error. No id in redirect request');
  }

  $linksMap = [
    "ok1" => "https://do.ucp.by/course/view.php?id=405",
    "ok2" => "https://do.ucp.by/course/view.php?id=404",
    "ok3" => "https://do.ucp.by/course/view.php?id=1245",
    "ok5" => "https://do.ucp.by/course/view.php?id=406",
    "ok6" => "https://do.ucp.by/course/view.php?id=426",
    "ok7" => "https://do.ucp.by/course/view.php?id=443",
    "ok8" => "https://do.ucp.by/course/view.php?id=1155",
    "ok9" => "https://do.ucp.by/course/view.php?id=1482",
    "ok10" => "https://do.ucp.by/course/view.php?id=464",
    "ok11" => "https://do.ucp.by/course/view.php?id=1483",
    "ok12" => "https://do.ucp.by/course/view.php?id=1249",
    "ok13" => "https://do.ucp.by/course/view.php?id=442",
    "ok14" => "https://do.ucp.by/course/view.php?id=1250",
    "ok15" => "https://do.ucp.by/course/view.php?id=1251",
    "ok16" => "https://do.ucp.by/course/view.php?id=1252",
    "ok17" => "https://do.ucp.by/course/view.php?id=1253",
    "ok19" => "https://do.ucp.by/course/view.php?id=1484",
    "ok20" => "https://do.ucp.by/course/view.php?id=1485",
    "ok21" => "https://do.ucp.by/course/view.php?id=1486",
    "ok22" => "https://do.ucp.by/course/view.php?id=1487",
    "ok23" => "https://do.ucp.by/course/view.php?id=1488",
    "ok25" => "https://do.ucp.by/course/view.php?id=1247",
    "ok26" => "https://do.ucp.by/course/view.php?id=1489",
    "ok27" => "https://do.ucp.by/course/view.php?id=1490",
    "ok33" => "https://do.ucp.by/course/view.php?id=1491",
    "ok34" => "https://do.ucp.by/course/view.php?id=1492",
    "ok35" => "https://do.ucp.by/course/view.php?id=1493"
  ];


  if (isset($linksMap[$id])) {
    $location = $linksMap[$id];
    header("Location: $location");
    exit;
  } else {
    throw new Error('Error. No id in links map');
  }
} catch (\Throwable $th) {
  header("Location: /");
  exit;
}

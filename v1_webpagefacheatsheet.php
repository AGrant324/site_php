<?php #bulletinboardpublish.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$fa = Array();
$fa["Arrows"] = Array(
fa-angle-double-down,
fa-angle-double-left,
fa-angle-double-right,
fa-angle-double-up,
fa-angle-down,
fa-angle-left,
fa-angle-right,
fa-angle-up,
fa-arrow-circle-down,
fa-arrow-circle-left,
fa-arrow-circle-o-down,
fa-arrow-circle-o-left,
fa-arrow-circle-o-right,
fa-arrow-circle-o-up,
fa-arrow-circle-right,
fa-arrow-circle-up,
fa-arrow-down,
fa-arrow-left,
fa-arrow-right,
fa-arrow-up,
fa-arrows,
fa-arrows-alt,
fa-arrows-h,
fa-arrows-v,
fa-backward,
fa-caret-down,
fa-caret-left,
fa-caret-right,
fa-caret-square-o-down,
fa-caret-square-o-left,
fa-caret-square-o-right,
fa-caret-square-o-up,
fa-caret-up,
fa-cart-arrow-down,
fa-chevron-circle-down,
fa-chevron-circle-left,
fa-chevron-circle-right,
fa-chevron-circle-up,
fa-chevron-down,
fa-chevron-left,
fa-chevron-right,
fa-chevron-up,
fa-cloud-download,
fa-cloud-upload,
fa-compress,
fa-download,
fa-exchange,
fa-expand,
fa-external-link,
fa-external-link-square,
fa-fast-backward,
fa-fast-forward,
fa-forward,
fa-hand-o-down,
fa-hand-o-left,
fa-hand-o-right,
fa-hand-o-up,
fa-history,
fa-level-down,
fa-level-up,
fa-location-arrow,
fa-long-arrow-down,
fa-long-arrow-left,
fa-long-arrow-right,
fa-long-arrow-up,
fa-mail-forward,
fa-mail-reply,
fa-mail-reply-all,
fa-play,
fa-random,
fa-recycle,
fa-reply,
fa-reply-all,
fa-retweet,
fa-share,
fa-share-square,
fa-share-square-o,
fa-sign-in,
fa-sign-out,
fa-sort,
fa-sort-alpha-asc,
fa-sort-alpha-desc,
fa-sort-amount-asc,
fa-sort-amount-desc,
fa-sort-asc,
fa-sort-desc,
fa-sort-down,
fa-sort-numeric-asc,
fa-sort-numeric-desc,
fa-sort-up,
fa-step-backward,
fa-step-forward,
fa-toggle-down,
fa-toggle-left,
fa-toggle-right,
fa-toggle-up,
fa-unsorted,
fa-upload,
fa-youtube-play
);

print_r($fa);








Back_Navigator();
PageFooter("Default","Final");

?>


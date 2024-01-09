<?php
error_reporting(0);
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/service/IyeoService.php';
use app\service\IyeoService;

$seq = $_GET['seq'];
$type = $_GET['type'] ?? "notice";
$psw = $_POST['psw'];

if($type === "notice") {
  $_title = "공지사항";
  $_depth2 = "1";
}
else if($type === "customer") {
  $_title = "1:1 문의";
  $_depth2 = "2";
}
else if($type === "news") {
  $_title = "보도자료";
  $_depth2 = "3";
}
else {
  echo '<script>alert("잘못된 접근입니다."); location.href = "/";</script>';
  exit;
}

$service = new IyeoService();
if($type != "news"){
  $data = $service->inquiryDetail($seq,$type);
  $seqs = $service->getNextPreSeqs($seq,$type);
  $service->hitAddCount($seq,$data['hit']);
}else{
  $data = $service->newsDetail($seq,$type);
  $seqs = $service->getNewsNextPreSeqs($seq,$type);
  $service->newsHitAddCount($seq,$data['hit']);
}
$preSeq = $seqs['preSeq'];
$nextSeq = $seqs['nextSeq'];

$defaultPagePath = "/page/inquiry_view?type=".$type."&seq=";

$nextPageText = ($seqs['nextSeq']) ? "다음글" : "다음글이 없습니다.";
$nextPagePath = ($seqs['nextSeq']) ? $defaultPagePath.$seqs['nextSeq'] : "javascript:void(0)";
$prePageText = ($seqs['preSeq']) ? "이전글" : "이전글이 없습니다.";
$prePagePath = ($seqs['preSeq']) ? $defaultPagePath.$seqs['preSeq'] : "javascript:void(0)";
?>

<!doctype html>
<html lang="ko">
<head>
  <title><?= $data['title'] ?> | 이여 곰탕</title>
  <meta property="og:title" content="<?= $data['title'] ?> | 이여 F&B"/>
  <meta property="og:url" content="https://iyeo.co.kr/page/inquiry_view?type=notice&seq=<?=$seq?>"/>
  <meta name="description" content="<?= str_replace("&nbsp;", "", strip_tags($data['content']) ) ?>" />
  <meta property="og:description" content="<?= str_replace("&nbsp;", "", strip_tags($data['content']) ) ?>" />

  <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/head.php"; ?>
</head>
<body>
<div id="wrap" class="page-inquiry type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="5"/>
    <input type="hidden" id="depth2" value="<?=$_depth2?>"/>
  </header>
  <section class="sec sec-kv _motionSec" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub5.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit _motion _motionToBottom _delay1">커뮤니티</h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">커뮤니티</span></span></li>
        <li>
          <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop"><?= $_title ?></a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item <?= ($_depth2 === "1" ? "_active" : "") ?>" data-action="value" data-url="/page/inquiry?type=notice">공지사항</a>
              <!--<a href="javascript:void(0)" class="nav-item" <?php /*= ($_depth2 === "2" ? "_active" : "") */?>data-action="value" data-url="/page/inquiry?type=customer">1:1문의</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="">채용공고</a>-->
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec _motionSec">
        <div class="m-main">
          <div class="bbs-detail">
            <header class="sec-header">
              <h2 class="small-tit wow fadeInUp" data-wow-delay="0.4s"><?= $data['title'] ?></h2>
              <ul class="info-flex flex wow fadeInUp" data-wow-delay="0.6s">
                <li><?= $data['name'] ?? "관리자" ?></li>
                <li><?= $data['created_at'] ?></li>
                <li><span class="view"><?= $data['hit'] ?>명이 이 글을 읽었습니다.</span></li>
              </ul>
            </header>
            <div class="editor-container wow fadeInUp" data-wow-delay="0.8s">
              <?= str_replace("&nbsp;", "", $data['content']) ?>
            </div>
            <div class="next-container wow fadeInUp" data-wow-delay="1.0s">
              <ul class="flex">
                <li>
                  <a href="<?=$prePagePath?>" class="page-item prev"><?= $prePageText ?></a>
                </li>

                <li>
                  <a href="<?=$nextPagePath?>" class="page-item next none"><?= $nextPageText ?></a>
                </li>
              </ul>
            </div>
            <div class="btn-right wow fadeInUp" data-wow-delay="1.2s">
              <a href="/page/inquiry?type=<?=$type?>" class="btn c-brown">목록</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/footer.php"; ?>
  </footer>
</div>
<script>
  $(function(){
    new WOW().init();
  })
</script>
</body>
</html>
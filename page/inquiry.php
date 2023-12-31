<?php
$type = $_GET['type'] ?? "notice";
if($type === "notice") {
  $_title =  "공지사항";
  $_active = "5";
  $_active2 = "1";
}
else if($type === "customer") {
  $_title = "1:1 문의";
  $_active = "5";
  $_active2 = "2";
}
else if($type === "news") {
  $_title = "보도자료";
  $_active = "5";
  $_active2 = "3";
}
else {
  echo '<script>alert("잘못된 접근입니다."); location.href = "/";</script>';
  exit;
}

$page = $_GET['page'] ?? 1;
?>

<!doctype html>
<html lang="ko">

<head>
  <title><?= $_title ?> | 이여 곰탕</title>
  <meta property="og:title" content="<?= $_title ?> | 이여 F&B"/>
  <meta property="og:url" content="https://iyeo.co.kr/page/startup"/>

  <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/head.php"; ?>
</head>

<body>

<div id="wrap" class="page-bbs type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="<?=$_active?>"/>
    <input type="hidden" id="depth2" value="<?=$_active2?>"/>
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
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop"><?=$_title?></a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item <?=($type === "notice" ? "_active" : "")?>" data-action="value" data-url="/page/inquiry?type=notice">공지사항</a>
              <a href="javascript:void(0)" class="nav-item <?=($type === "customer" ? "_active" : "")?>" data-action="value" data-url="/page/inquiry?type=customer">1:1문의</a>
              <a href="javascript:void(0)" class="nav-item <?=($type === "news" ? "_active" : "")?>" data-action="value" data-url="">보도자료</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/recruiting">채용공고</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <input type='hidden' id='inquiry_page' name='inquiry_page' value="<?= $page ?>">
      <section class="sec _motionSec">
        <div class="m-main">
          <article class="article">
            <header class="sec-header">
              <h3 class="small-tit wow fadeInDown" data-wow-delay="0.4s"><?= $_title ?></h3>
            </header>

            <ul class="bbs-list" data-selector="listAppend"></ul>
            <div class="paging-container">
              <ul class="paging" data-selector="pageing"></ul>
              <?php if($type !== "notice") { ?>
                <a href="/page/inquiry_write?type=<?=$type?>" class="btn c-brown">등록하기</a>
              <?php } ?>
            </div>
          </article>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/footer.php"; ?>
  </footer>
</div>
<script src="/_asset/_js/page.inquiry.js"></script>
<script>
  $(function(){
    Page.Render('<?=$type?>');
  })
</script>
</body>
</html>
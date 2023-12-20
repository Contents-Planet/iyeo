<?php
$type = $_GET['type'] ?? "notice";
if($type === "startups") {
  $_title =  "창업 문의";
  $_active = "4";
  $_depth1 = "창업안내";
}
else if($type === "customer") {
  $_title = "1:1 문의";
  $_active = "5";
  $_depth1 = "고객의 소리";
}
?>

<!doctype html>
<html lang="ko">

<head>
  <title><?= $_title ?> | 이여 F&B</title>
  <meta property="og:title" content="<?= $_title ?> | 이여 F&B"/>
  <meta property="og:url" content="https://iyeo.co.kr/page/startup"/>

  <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/head.php"; ?>
</head>

<body>
<div id="wrap" class="page-inquiry type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="4"/>
  </header>
  <section class="sec sec-kv" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub4.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit"><?= $_depth1 ?></h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <?php if($type === "startups") { ?>
        <li><span class="nav-item"><span class="txt">창업안내</span></span></li>
        <li>
          <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop">창업 문의</a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/startup">창업 안내</a>
              <a href="javascript:void(0)" class="nav-item _active" data-action="value" data-url="/page/inquiry_write?type=startups">창업 문의</a>
            </div>
          </div>
        </li>
        <?php } ?>
        <?php if($type === "customer") { ?>
          <li><span class="nav-item"><span class="txt">고객의 소리</span></span></li>
          <li>
            <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
              <a href="javascript:void(0)" class="nav-item ico" data-action="drop">1:1문의</a>
              <div class="drop-wrap">
                <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/inquiry?type=notice">공지사항</a>
                <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/inquiry?type=customer">1:1문의</a>
                <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="">채용공고</a>
              </div>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec">
        <div class="m-main">
          <article class="article a2">
            <header class="sec-header success-header">
              <h3 class="header-tit"><?= $_title ?>가<br />정상적으로 접수되었습니다.</h3>
              <p class="dec">
                빠른 시일내에 답변드리도록 하겠습니다. <br />
                감사합니다.
              </p>
              <strong class="tit">고객센터: 1551-2508</strong>
            </header>
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
</body>

</html>
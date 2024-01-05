<?php
$page = $_GET['page'] ?? 1;
?>

<!doctype html>
<html lang="ko">

<head>
  <title>채용공고 | 이여 곰탕</title>
  <meta property="og:title" content="채용공고 | 이여 F&B"/>
  <meta property="og:url" content="https://iyeo.co.kr/page/startup"/>

  <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/head.php"; ?>
</head>

<body>

<div id="wrap" class="page-bbs type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="5"/>
    <input type="hidden" id="depth2" value="4"/>
  </header>

  <section class="sec sec-kv _motionSec" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub5.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit">커뮤니티</h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">커뮤니티</span></span></li>
        <li>
          <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop">채용공고</a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/inquiry?type=notice">공지사항</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/inquiry?type=customer">1:1문의</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="">보도자료</a>
              <a href="javascript:void(0)" class="nav-item _active" data-action="value" data-url="/page/recruiting">채용공고</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <input type='hidden' id='inquiry_page' name='inquiry_page' value="<?= $page ?>">
      <section class="sec">
        <div class="m-main">
          <article class="article">
            <header class="sec-header">
              <h3 class="small-tit">채용공고</h3>
            </header>

            <ul class="bbs-list" data-selector="listAppend"></ul>
            <div class="paging-container">
              <ul class="paging" data-selector="pageing"></ul>
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
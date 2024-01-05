<!doctype html>
<html lang="ko">
<head>
  <title>메뉴 소개 | 이여 곰탕</title>
  <meta property="og:title" content="메뉴 소개 | 이여 곰탕" />
  <meta property="og:url" content="https://iyeo.co.kr/page/menu" />

  <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/head.php"; ?>

  <link rel="stylesheet" href="//static.econtents.co.kr/_asset/_lib/WOW-master/css/libs/animate.css" type="text/css">
</head>
<body>

<div id="wrap" class="page-menu type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="2"/>
  </header>

  <section class="sec sec-kv _motionSec" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub2.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit _motion _motionToTop _delay1">메뉴 소개</h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">메뉴 소개</span></span></li>
      </ul>
    </div>
  </section>

  <div id="container">
    <div id="contents">
      <section class="sec">
        <div class="m-main">
          <ul class="prd-flex flex _motionSec" data-selector="listAppend"></ul>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/footer.php"; ?>
  </footer>
</div>
<script src="//static.econtents.co.kr/_asset/_lib/WOW-master/dist/wow.min.js"></script>
<script src="/_asset/_js/page.menu.js"></script>
</body>
</html>

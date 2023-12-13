<!doctype html>
<html lang="ko">
<head>
  <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/head.php"; ?>
</head>
<body>

<div id="wrap" class="page type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="3"/>
  </header>

  <section class="sec sec-kv" style="background-image:url(/_img/bg_sub3.jpg)">
    <div class="m-main">
      <header class="page-header">
        <strong class="header-tit">매장 찾기</strong>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">매장 찾기</span></span></li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec">
        <div class="m-main">
          <figure class="fig-item">
            <img src="/_img/location1.jpg" alt=""/>
          </figure>
          <figure class="fig-item">
            <img src="/_img/location2.jpg" alt=""/>
          </figure>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/footer.php"; ?>
  </footer>
</div>
</body>
</html>

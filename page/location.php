<!doctype html>
<html lang="ko">
<head>
  <title>본사오시는길 | 브랜드소개 | 이여 F&B</title>
  <meta property="og:title" content="본사오시는길 | 브랜드소개 | 이여 F&B" />
  <meta property="og:url" content="https://iyeo.co.kr/page/about" />

  <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/head.php"; ?>
</head>
<body>

<div id="wrap" class="page-location type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="1"/>
  </header>

  <section class="sec sec-kv" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub1.webp)">
    <div class="m-main">
      <header class="page-header">
        <p class="header-dec">K푸드를 선도하는</p>
        <strong class="header-tit">이여곰탕</strong>
        <h2 class="a11y">브랜드소개</h2>
        <h3 class="a11y">본사오시는길</h3>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">브랜드 소개</span></span></li>
        <li>
          <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop">본사 오시는 길</a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/about">이여곰탕 소개</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="/page/bi">CI·BI 소개</a>
              <a href="javascript:void(0)" class="nav-item _active" data-action="value" data-url="/page/location">본사 오시는 길</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec">
        <div class="m-main">
          <header class="sec-header">
            <h2 class="header-tit">
              건강한 맛, 정직한 고집 <br />
              이여F&B입니다.
            </h2>
          </header>
          <div class="map-container" data-selector="mapContainer">
            <div id="map"></div>
          </div>

          <dl class="info-flex flex">
            <dt>이여F&B 본사</dt>
            <dd>
              <dl class="dl-item">
                <dt>주소</dt>
                <dd>서울 강남구 봉은사로63길 23 4F</dd>
              </dl>
              <dl class="dl-item">
                <dt>전화</dt>
                <dd><a href="tel:0234432508" class="tel">02-3443-2508</a></dd>
              </dl>
            </dd>
          </dl>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/footer.php"; ?>
  </footer>
</div>
<script src="/_asset/_js/page.location.js"></script>
</body>
</html>

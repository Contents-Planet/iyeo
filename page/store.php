<!doctype html>
<html lang="ko">
<head>
  <title>매장 찾기 | 이여 곰탕</title>
  <meta property="og:title" content="매장 찾기 | 이여 곰탕" />
  <meta property="og:url" content="https://iyeo.co.kr/page/store" />

  <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/head.php"; ?>
</head>
<body>

<div id="wrap" class="page-store type-sub">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/header.php"; ?>
    <input type="hidden" id="depth1" value="3"/>
  </header>

  <section class="sec sec-kv _motionSec" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub3.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit _motion _motionToBottom _delay1">매장 찾기</h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">매장 찾기</span></span></li>
      </ul>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec sec1">
        <div class="scroll-dot" data-selector="map-dot"></div>
        <div class="m-main">
          <div class="map-container" data-selector="mapContainer">
            <div id="map"></div>
          </div>
          <article class="article">
            <table class="tbl t-list">
              <colgroup>
                <col style="width:80px" />
                <col class="m-hide" style="width:120px" />
                <col />
                <col class="m-hide" style="width:160px" />
                <col style="width:100px" />
              </colgroup>
              <thead>
              <tr>
                <th>지역</th>
                <th class="m-hide">매장명</th>
                <th>주소</th>
                <th class="m-hide">연락처</th>
                <th>지도 보기</th>
              </tr>
              </thead>
              <tbody data-selector="listAppend"></tbody>
            </table>
          </article>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/footer.php"; ?>
  </footer>
</div>
<script src="/_asset/_js/page.store.js"></script>
</body>
</html>

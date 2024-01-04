<!doctype html>
<html lang="ko">
<head>
  <title>이여 곰탕</title>
  <meta property="og:title" content="이여 곰탕" />
  <meta property="og:url" content="https://iyeo.co.kr/" />

  <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/head.php"; ?>
</head>
<body>
<div id="wrap" class="page-main">
  <header id="header">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/header.php"; ?>
    <input type="hidden" id="page" value="main"/>
  </header>

  <section class="sec sec-kv">
    <div class="scroll-dot btt-dot" data-selector="bttDot"></div>
    <div class="swiper slide-container" data-selector="mainKv">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="video-container" data-selector="kvVideo"></div>
        </div>

        <!--<div class="swiper-slide">
          <div class="img-box" style="background-image:url(../_img/main_1.jpg)">
            <div class="m-main">
              <dl class="dec-wrap">
                <dt><strong class="kv-tit">서울 4대 곰탕</strong></dt>
                <dd>
                  <p class="dec">이제는 진짜 한우곰탕으로 모시겠습니다.</p>
                  <a href="/page/about" class="btn c-white-line">자세히 보기</a>
                </dd>
              </dl>
            </div>
          </div>
        </div>-->
      </div>
    </div>
  </section>
  <div id="container">
    <div id="contents">
      <section class="sec sec1">
        <div class="m-main">
          <div class="col-flex flex">
            <div class="col-left">
              <dl class="dec-wrap">
                <dt>
                  <small class="s-txt">IYEO MENU</small>
                  <strong class="sec-tit">3대째 이어져 오는<br />우직한 식법</strong>
                </dt>
                <dd>
                  <p class="dec">
                    매일 직접 공수한 100% 국내산 한우를 <br />
                    일일이 발골합니다.
                  </p>
                  <a href="/page/menu" class="btn c-black-line">자세히 보기</a>
                </dd>
              </dl>
            </div>
            <div class="col-right pc-hide">
              <div class="img-box" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/main_sec1_img1.webp)"></div>
            </div>
          </div>
        </div>
      </section>

      <section class="sec sec2" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/main_sec2_bg.webp)">
        <div class="m-main">
          <div class="col-flex flex">
            <div class="col-left">
              <figure class="fig-item">
                <img src="https://static.econtents.co.kr/_img/iyeo/main_sec2_img.webp" alt="" />
              </figure>
            </div>
            <div class="col-right">
              <dl class="dec-wrap">
                <dt>
                  <small class="s-txt">IYEO STORE</small>
                  <strong class="sec-tit">마지막 육수 한방울에도<br />건강을 담아</strong>
                </dt>
                <dd>
                  <p class="dec">
                    “약식동원(藥食同源)”<br />
                    3대를 이어 온 정직한 맛으로 모시겠습니다.
                  </p>
                  <a href="/page/store" class="btn c-black-line">자세히 보기</a>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <footer id="footer">
    <?php include_once $_SERVER["DOCUMENT_ROOT"]."/page/_inc/footer.php"; ?>
  </footer>
</div>
<script src="/_asset/_js/page.main.js"></script>
<script>
  $(function(){
    PageCommon.youtubePlay('kvVideo', '0', 'l8Nv29RJtKs')
  })
</script>
</body>
</html>

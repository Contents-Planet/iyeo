<?php
$type = $_GET['type'] ?? "notice";
if($type === "notice") {
  $_title =  "공지사항";
  $_depth2 =  "1";
} if($type === "customer") {
  $_title = "1:1 문의";
  $_depth2 =  "2";
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
    <input type="hidden" id="depth1" value="5"/>
    <input type="hidden" id="depth2" value="<?=$_depth2?>"/>
  </header>
  <section class="sec sec-kv" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub5.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit"><?= $_title ?></h2>
      </header>
      <ul class="location-bar flex">
        <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
        <li><span class="nav-item"><span class="txt">고객의 소리</span></span></li>
        <li>
          <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
            <a href="javascript:void(0)" class="nav-item ico" data-action="drop"><?= $_title ?></a>
            <div class="drop-wrap">
              <a href="javascript:void(0)" class="nav-item <?= ($_depth2 === "1" ? "_active" : "") ?>" data-action="value" data-url="/page/inquiry?type=notice">공지사항</a>
              <a href="javascript:void(0)" class="nav-item" <?= ($_depth2 === "2" ? "_active" : "") ?>data-action="value" data-url="/page/inquiry?type=customer">1:1문의</a>
              <a href="javascript:void(0)" class="nav-item" data-action="value" data-url="">채용공고</a>
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
          <div class="bbs-detail">
            <header class="sec-header">
              <h2 class="small-tit">이여곰탕 김포장기점 오픈</h2>
              <ul class="info-flex flex">
                <li>작성자</li>
                <li>23-10-10 09:53</li>
                <li><span class="view">12명이 이 글을 읽었습니다.</span></li>
              </ul>
            </header>
            <div class="editor-container">
              안녕하세요. 이여F&B 입니다.<br />
              긴 연휴가 지나고 선선해진 바람에 가을이 성큼다가온 것을 느낍니다.<br />
              아름다운 계절의 변화와 함께 저희 이여곰탕 김포장기점이 오픈합니다!<br /><br />

              * 이여곰탕 김포장기점<br />
              - 오픈 : 11월 30일 목요일<br />
              - 위치 : 경기도 김포시 장기동 2083-6 김포마스터비즈파크 1층<br />
              - 연락처 : 070-7704-9800<br /><br />

              많은 관심과 사랑 부탁드리며, 문의사항 있으시면 언제든지 연락 주시기 바랍니다.<br />
              감사합니다.
            </div>
            <div class="next-container">
              <ul class="flex">
                <li>
                  <a href="/page/inquiry_view?type=notice&seq=22" class="page-item prev">이전글</a>
                </li>

                <li>
                  <a href="javascript:void(0)" class="page-item next none">다음글이 없습니다.</a>
                </li>
              </ul>
            </div>
            <div class="btn-right">
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
<script src="/_asset/_js/page.inquiry.js"></script>
</body>

</html>
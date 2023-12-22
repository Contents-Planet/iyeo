<?php
error_reporting(0);
$type = $_GET['type'] ?? "notice";
if($type === "startups") {
  $_title =  "창업 문의";
  $_active = "4";
} if($type === "customer") {
  $_title = "1:1 문의";
  $_active = "5";
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
    <input type="hidden" id="depth1" value="<?=$_active?>"/>
  </header>
  <section class="sec sec-kv" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub<?=$_active?>.webp)">
    <div class="m-main">
      <header class="page-header">
        <h2 class="header-tit"><?= $_title ?></h2>
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
          <li><span class="nav-item"><span class="txt">커뮤니티</span></span></li>
          <li>
            <div class="drop-box" data-selector="dropContainer" data-sid="moveLink">
              <a href="javascript:void(0)" class="nav-item ico" data-action="drop">고객센터</a>
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
            <header class="sec-header">
              <h3 class="small-tit"><?= $_title ?></h3>
              <span class="req-dec"><span class="t-red">*</span> 는 필수입력항목입니다.</span>
            </header>
            <form method='post' name="frm">
              <input type='hidden' value='write' name='mode'>
              <input type='hidden' value='<?= $type ?>' name='type'>

              <dl class="chk-dl drop-box" data-selector="dropContainer">
                <dt>
                  <label href="javascript:void(0)" class="chk-label drop-chk" data-action="allChk">
                    <input type="checkbox" name="privacy" value="" placeholder="개인정보취급방침을 동의하셔야 서비스를 이용하실 수 있습니다." data-validate="req" />
                    <span class="txt">개인정보취급방침을 읽었으며 이에 동의합니다. <small class="req-txt">(필수)</small></span>
                    <input type="hidden" name="privacy_view" />
                  </label>
                  <a href="javascript:void(0)" class="btn-drop" data-action="dropDown" data-sid="1">전문보기</a>
                </dt>
                <dd class="drop-wrap">

                </dd>
              </dl>

              <div class="inquiry-container">
                <dl class="inner-dl">
                  <dt><label class="label req" for="name">성명</label></dt>
                  <dd>
                    <input type="text" name="name" id="name" placeholder="성명을 입력해주세요." data-validate="req"/>
                  </dd>
                </dl>
                <dl class="inner-dl">
                  <dt><label class="label req" for="phone">연락처</label></dt>
                  <dd>
                    <input type="text" name="phone" id="phone" placeholder="연락처를 입력해주세요." data-validate="req"/>
                  </dd>
                </dl>
                <?php if ($type == 'startups') { ?>
                  <dl class="inner-dl">
                    <dt><span class="label req">희망지역</span></dt>
                    <dd>
                      <ul class="area-flex flex">
                        <li>
                          <input type="text" placeholder="시/도를 입력해주세요." name="area" title="시/도" data-validate="req"/>
                        </li>
                        <li>
                          <input type="text" placeholder="구/군을 입력해주세요." name="area2" title="구/군" data-validate="req"/>
                        </li>
                      </ul>
                      <input type="text" placeholder="상세주소를 입력해주세요." name="area3" title="상세주소" data-validate="req"/>
                    </dd>
                  </dl>
                <?php } ?>
                <?php if ($type === "customer") { ?>
                  <dl class="inner-dl">
                    <dt><label class="label req" for="title">문의 제목</label></dt>
                    <dd>
                      <input type="text" placeholder="문의제목을 입력해주세요." name="title" id="title" data-validate="req"/>
                    </dd>
                  </dl>
                <?php } ?>
                <dl class="inner-dl">
                  <dt><label class="label req" for="content">문의 내용</label></dt>
                  <dd>
                    <textarea placeholder="문의내용을 입력해주세요." name="content" id="content" data-validate="req"></textarea>
                  </dd>
                </dl>
                <?php if ($type === "customer") { ?>
                <dl class="inner-dl">
                  <dt><label class="label req" for="pw">문의 비밀번호</label></dt>
                  <dd>
                    <input type="password" placeholder="1:1문의 비밀번호를 입력해주세요." name="pw" id="pw" data-validate="req"/>
                  </dd>
                </dl>
                <?php } ?>
              </div>

              <div class="btn-wrap">
                <a href="javascript:void(0)" class="btn c-brown s2" data-action="submit">문의하기</a>
              </div>
            </form>
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
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var geocoder = new kakao.maps.services.Geocoder();

// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var selectedMarker = null, // 클릭한 마커를 담을 변수
	imageSrc = 'https://static.econtents.co.kr/_img/iyeo/marker.webp', // 마커이미지의 주소입니다
	imageSize = new kakao.maps.Size(35, 44), // 마커이미지의 크기입니다
	imageOption = {offset: new kakao.maps.Point(18, 44)}, // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
	markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),

	overSize = new kakao.maps.Size(40, 50),
	overOption = {offset: new kakao.maps.Point(20, 50)},
	overImage = new kakao.maps.MarkerImage(imageSrc, overSize, overOption),
	marker = new kakao.maps.Marker();

var clickedOverlay = null;

$(function(){
	PageCommon.Init();
	GNB.Init();
	MotionSec.Init();
})

var PageCommon = {
	/**
	 * youtube interaction
	 */
	youtubePlay : function(container, sid, youtube) {
		$("[data-selector="+ container +"]").find("[data-selector=videoFrame]").remove();
		var $playWrap ='<div class="iframe" id="iframe-wrap'+ sid +'" data-selector="videoFrame"></div>';
		$("[data-selector="+ container +"]").append($playWrap);

		var player = new YT.Player('iframe-wrap'+ sid, {
			height: '100%',
			width: '100%',
			videoId: youtube,
			rel : 0, //0으로 해놓아야 재생 후 관련 영상이 안뜸
			events: {
				'onReady': function(event) {
					event.target.playVideo();
					event.target.mute();
					event.target.setVolume(0);
				},
				'onStateChange': function(event) {
					if(event.data === 0) {
						event.target.playVideo();
					}
				}
			}
		})
	},

	Video : function(e) {
		var seq = e.data("seq"),
			youtube = e.data("id"),
			container = e.data("container");

		PageCommon.youtubePlay(container, seq, youtube);
	},

	moveTo: function (top) {
		var moveTo = $("#sec-" + top).offset().top;
		$("body, html").animate({scrollTop: moveTo}, '500');
	},

	/**
	 * 비동기 전용 페이징 컨트롤
	 *
	 * @param _wraper
	 * @param _total
	 * @param _page
	 * @param _row
	 * @param _scale
	 * @param _pagingCallback
	 * @param _finishCallback
	 * @returns {string}
	 */
	AjaxPaging: function (_wraper, _total, _page, _row, _scale, _url, _param, _pagingCallback, _finishCallback) {
		var paging = "",
			totalPage = 0,
			start = 0,
			end = 0,
			prev = 0,
			next = 0,
			pageNum = [];

		if (!_total) return "";

		if (_row < 1) _row = 1;
		if (_scale < 1) _scale = 1;
		if (_page < 1) _page = 1;
		totalPage = Math.ceil(_total / _row);
		if (_page > totalPage) _page = totalPage;
		if (_page < 1) _page = 1;

		if (_total > 0) {
			start = (Math.floor(_page / _scale) * _scale) + 1;
			if (!(_page % _scale)) start -= _scale;

			prev = start - _scale;
			next = start + _scale;

			if (start < 1) start = 1;
			end = start + _scale - 1;
			if (end > totalPage) end = totalPage;
			if (prev < 1) prev = 1;
			if (next > totalPage) next = totalPage;
		}

		for (var i = start; i <= end; i++)
			pageNum.push(i);

		paging = '';
		if (start > 1) {
			//paging += '<li><a href="javascript:;" data-page="1">&lt;&lt;</a></li> ';
		}
		if (_scale < end) {
			paging += '<li><a href="' + _url + '?page=1' + (_param ? "&" + _param : "") + '" class="page-first page"><span class="a11y">처음</span></a></li> ';
			paging += '<li><a href="' + _url + '?page=' + prev + (_param ? "&" + _param : "") + '" class="page-prev page"><span class="a11y">이전</span></a></li> ';
		}

		for (var i = 0; i < pageNum.length; i++) {
			if (pageNum[i] === parseInt(_page)) paging += ' <li><a href="javascript:void(0);" class="_active page">' + pageNum[i] + '</a></li> ';
			else paging += ' <li><a href="' + _url + '?page=' + pageNum[i] + (_param ? '&' + _param : '') + '" class="page">' + pageNum[i] + '</a></li> ';
		}

		if (next !== end) {
			paging += ' <li><a href="' + _url + '?page=' + next + (_param ? '&' + _param : '') + '" class="page-next page" data-page="' + next + '"><span class="a11y">다음</span></a></li> ';
			paging += '<li><a href="' + _url + '?page=' + totalPage + (_param ? '&' + _param : '') + '" class="page-last page"><span class="a11y">마지막</span></a></li> ';
		}

		_wraper.html(paging);
		_wraper.find('.paging > li > a').on("click", function () {
			var currentPage = $(this).attr("data-page");

			//console.log(currentPage);
			if (typeof _pagingCallback === "function") _pagingCallback.call(null, currentPage);
		});

		if (typeof _finishCallback === "function") _finishCallback.call();
	},

	Bind : function(){
		$("[data-action=video]").unbind("click");
		$(document).on("click", "[data-action=video]", function(){
			console.log("Ddd");
			PageCommon.Video($(this));
		})
	},

	Init : function(){
		PageCommon.Bind();
	}
}

/*******************
 *  GNB
 *******************/
var GNB = {
	Reset: function () {
		$("#header").removeClass('_open');
		$("#header").removeClass('_openDepth');
		$("#header").find("[data-selector=dropConteinr]").removeClass("_active");
		ND.FN.noScroll('off');
	},

	OpenMenu : function(){
		console.log("ddd");
		if ($("#header").hasClass("_open")) {
			GNB.Reset();
		} else {
			$("#header").addClass('_open');

			setTimeout(function(){

			}, 200);
		}
	},

	NowPage : function(){
		var __depth1 = $("#depth1").val(),
			__depth2 = $("#depth2").val(),
			$depth1 = $("[data-selector=depth1][data-sid="+ __depth1 +"]");

		$("[data-selector=depth1]").removeClass("_active");
		$("[data-selector=depth2]").removeClass("_active");
		$depth1.addClass("_active");
		$depth1.closest("li").find("[data-action=depth2][data-sid="+ __depth2 +"]").addClass("_active");
	},

	OpenDepth : function(){
		$("#header").addClass("_openDepth");
	},

	Sticky: function () {
		var top = $("#header").offset().top;

		if(top > 1) {
			$("#header").addClass("_sticky");
		} else {
			$("#header").removeClass("_sticky");
		}
	},

	Floating: function () {
		var $bn = $("[data-selector=floatBar]"),
			bnTop = $bn.offset().top,
			bnHeight = $bn.outerHeight(),
			bnBtt = bnTop + bnHeight,
			winHeight = $(window).outerHeight(),
			top = $("#header").offset().top,
			btt = winHeight + top,
			footTop = $("[data-selector=footDot]").offset().top;

		//console.log(bnTop, footTop)
		if(bnTop >= footTop) {
			$bn.addClass("_sticky")
		}
		if(btt - bnHeight < footTop) {
			$bn.removeClass("_sticky")
		}
	},

	Bind: function () {
		/* all menu */
		$("[data-action=AllMenu]").unbind("click").on("click", function () {
			GNB.OpenMenu();
		})

		$("#header [data-selector=dropConteinr]").unbind("mouseleave").on("mouseleave", function(){
			if ($("body").hasClass("_frame-pc")) {
				Nav.Reset();
			}
		})

		$("#header").unbind("mouseenter").on("mouseenter", function(){
			GNB.OpenDepth();
		})

		$("#header").unbind("mouseleave").on("mouseleave", function(){
			GNB.Reset();
		})

		$(window).scroll(function(){
			GNB.Sticky();
			GNB.Floating();
		})
	},

	Init: function () {
		GNB.Bind();
		GNB.NowPage();
		GNB.Sticky();
		GNB.Floating();
	}
}

var Map = {
	/* 현재위치 ㅎ*/
	CurrentLocation : function(add, _callback) {
		geocoder.addressSearch(add, function(result, status) {
			nowLocation = {"lat" : result[0].x, "lon" : result[0].y}
			if (typeof _callback === 'function') {
				_callback.call(null, nowLocation);
			}
		})
	},

	/* 죄표 주소로변환 */
	SearchAddrFromCoords : function(coords, _callback) {
		geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), _callback);
	},

	/* 주소 좌표로변환 */
	SearchCordsFromAdd : function(add, _callback) {
		geocoder.addressSearch(add, function(result, status) {
			if (status === kakao.maps.services.Status.OK) {
				var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
				if (typeof _callback === 'function') {
					_callback.call(null, coords);
				}
			}
		})
	}
}

var MotionSec = {
	Active : function(){
		var $top = $(".motion-line.top"),
			$btt = $(".motion-line.btt");

		if($top.index() > -1 && $btt.index() > -1) {
			var top = $top.offset().top,
				btt = $btt.offset().top;

			//console.log(top, btt)
			$.each($("._motionSec"), function(index, row){
				var rowTop = $(row).offset().top,
					rowHeight = $(row).outerHeight(),
					rowBtt = parseInt(rowTop) + parseInt(rowHeight);

				/*console.log(rowTop, rowBtt, "top : "+ top, "btt : "+ btt)
				console.log(top +" <= "+ rowTop +" && "+ btt +" >= "+ rowTop)*/

				if(!$(row).hasClass("_motionActive")) {
					if((top >= rowTop && top <= rowBtt) || (btt >= rowTop && btt <= rowBtt)) {
						$(row).addClass("_motionActive")
					}
				}
			})
		}
	},

	Bind : function(){
		$(window).scroll(function(){
			MotionSec.Active();
		})
	},

	Init : function(){
		MotionSec.Bind();
		MotionSec.Active();
	}
}
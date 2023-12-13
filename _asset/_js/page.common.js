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
})

var PageCommon = {
	moveTo: function (top) {
		var moveTo = $("#sec-" + top).offset().top;
		$("body, html").animate({scrollTop: moveTo}, '500');
	},

	Bind : function(){

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
		var __depth1 = $("#depth1").val();

		$("[data-selector=depth1]").removeClass("_active");
		$("[data-selector=depth1][data-sid="+ __depth1 +"]").addClass("_active");
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

		$("[data-item=nav]").unbind("click").on("click", function(){
			GNB.MovePage($(this));
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
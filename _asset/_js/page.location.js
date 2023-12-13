var mapContainer = document.getElementById('map'), // 지도를 표시할 div
	mapOption = {
		center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
		level: 8 // 지도의 확대 레벨
	};

// 지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

$(function(){
	Page.Init();
})

var Page = {
	AddMarker : function(){
		Map.CurrentLocation('서울 강남구 봉은사로63길 23', function(res) {
			$("#map").remove();
			$("[data-selector=mapContainer]").html("<div id=map></div>");

			console.log(res)
			var lon = res.lon,
				lat = res.lat,
				tit = "이여 F&B";

			var mapContainer = document.getElementById('map'),
				mapOption = {
					center: new kakao.maps.LatLng(lon, lat),
					level: 5
				};

			var map = new kakao.maps.Map(mapContainer, mapOption),
				center = map.getCenter(),
				level = map.getLevel()

			var imageSrc = "https://static.econtents.co.kr/_img/iyeo/marker.webp", // 마커이미지의 주소입니다
				imageSize = new kakao.maps.Size(35, 42), // 마커이미지의 크기입니다
				imageOption = {offset: new kakao.maps.Point(18, 42)}, // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
				markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption)

			var marker = new kakao.maps.Marker({
				position : new kakao.maps.LatLng(lon, lat),
				title : tit,
				clickable : true,
				image: markerImage
			});

			marker.setMap(map);
			kakao.maps.event.addListener(marker, 'click', function() {
				var level = map.getLevel()-1;
				// 지도를 클릭된 클러스터의 마커의 위치를 기준으로 확대합니다
				map.setLevel(level, {anchor: center});
			});
		})
	},

	Bind: function () {

	},

	Init: function () {
		Page.Bind();
		Page.AddMarker();
	}
}

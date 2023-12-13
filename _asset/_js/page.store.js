var mapContainer = document.getElementById('map'), // 지도를 표시할 div
	mapOption = {
		center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
		level: 9 // 지도의 확대 레벨
	};

// 지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

var depth1 = $("[namw=depth1]").val() ? $("[namw=depth1]").val() : '서울',
	depth2 = $("[namw=depth2]").val() ? $("[namw=depth2]").val() : '중구';

var $positions = [];

$(function(){
	Page.Init();
})

var Page = {
	GetData : function(formData, _callback){
		var ajaxUrl = '/api/api.store.json';
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: ajaxUrl,
			data: formData,
			success: function(response) {
				if (typeof _callback === 'function') {
					_callback.call(null, response);
				}
			}
		});
	},

	Render : function(){
		Page.GetData('',function(res){
			if(res.result === "ok" && res.data) {
				var $data = res.data,
					html = "";

				$.each(res.data, function(index, row) {
					var jsonObj = new Object();
					jsonObj.seq = row.seq;
					jsonObj.area = row.area;
					jsonObj.store = row.store;
					jsonObj.add = row.add;
					jsonObj.tel = row.tel;
					geocoder.addressSearch(row.add, function (result, status) {
						jsonObj.lat = status === kakao.maps.services.Status.OK ? result[0].y : '';
						jsonObj.lng = status === kakao.maps.services.Status.OK ? result[0].x : '';
					})
					$positions.push(jsonObj);
				})

				setTimeout(function(){
					var pin = 0;
					var $mapData = {
						"depth1" : depth1,
						"depth2" : depth2,
						"positions" : $positions
					};
					Page.AddMarker($mapData);

					$.each($positions, function(index, row) {
						html += '	<tr data-tit="' + row.store + '" data-selector="storeItem">';
						html += '		<td>' + row.area + '</td>';
						html += '		<td class="m-hide">' + row.store + '</td>';
						html += '		<td>';
						html += '			<div class="dec">';
						html += '				<strong class="store pc-hide">' + row.store + '</strong>';
						html += '				<p class="add">' + row.add + '</p>';
						html += '				<a href="tel:' + row.tel + '" class="tel pc-hide">' + row.tel + '</a>';
						html += '			</div>';
						html += '		</td>';
						html += '		<td class="m-hide"><a href="tel:' + row.tel + '" class="tel">' + row.tel + '</a></td>';
						html += '		<td><a href="javascript:void(0)" class="marker" data-action="mapMarker" data-lat="' + row.lat + '" data-lng="' + row.lng + '"><span class="a11y">위치보기</span></a></td>';
						html += '	</tr>';
					})
					$("[data-selector=listAppend]").html(html);
				}, 300)
			}
		})
	},

	AddMarker : function(data){
		$.each(data.positions, function(index, row){
			var marker = new kakao.maps.Marker({
				position : new kakao.maps.LatLng(row.lat, row.lng),
				title : row.store,
				clickable : true,
				image: markerImage,
			});

			/*customoverlay */
			var content = '<div class="customoverlay">';
			content += '  <span href="javascript:void(0)" data-action="">';
			content += '    <span class="strore">'+ row.store +'</span>';
			content += '  </span>';
			content += '</div>';

			var customOverlay = new kakao.maps.CustomOverlay({
				position: new kakao.maps.LatLng(row.lat, row.lng),
				content: content
			});

			marker.setMap(map);
			kakao.maps.event.addListener(marker, 'click', function() {
				$('[data-selector=storeItem]').removeClass("_active");
				$('[data-tit="'+ marker.getTitle() +'"]').addClass("_active");

				if (!selectedMarker || selectedMarker !== marker) {
					// 클릭된 마커 객체가 null이 아니면
					// 클릭된 마커의 이미지를 기본 이미지로 변경하고
					!!selectedMarker && selectedMarker.setImage(markerImage);

					marker.setImage(markerImage);
					//window.open(place, '', '');
				}

				if (clickedOverlay) {
					clickedOverlay.setMap(null);
				}
				customOverlay.setMap(map);
				clickedOverlay = customOverlay;

				// 클릭된 마커를 현재 클릭된 마커 객체로 설정합니다
				selectedMarker = marker;
			});
		})

		$("[data-action=mapMarker]").unbind("click");
		$(document).on("click", "[data-action=mapMarker]", function () {
			var lat = $(this).data("lat"),
				lng = $(this).data("lng");

			var moveLatLon = new kakao.maps.LatLng(lat, lng);
			map.setLevel('2');
			map.panTo(moveLatLon);

			$("[data-selector=storeItem]").removeClass("_active");
			$(this).closest("[data-selector=storeItem]").addClass("_active");

			if($("body").hasClass("_frameMobile")) {
				var top = $("[data-selector=map-dot]").offset().top,
					headHeight = $("#header").outerHeight();
				$('html, body').animate({scrollTop: (top - headHeight)}, 300);
			}

		})
	},

	Bind: function () {

	},

	Init: function () {
		Page.Bind();
		Page.Render();
	}
}

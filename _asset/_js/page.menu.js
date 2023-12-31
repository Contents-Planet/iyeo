$(function () {
	Page.Init();
})

var Page = {
	GetData: function (formData, _callback) {
		var ajaxUrl = '/routes/api';
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: ajaxUrl,
			data: {
				mode: "getMenus"
			},
			success: function (response) {
				if (typeof _callback === 'function') {
					_callback.call(null, response);
				}
			}
		});
	},

	Render: function () {
		Page.GetData('', function (res) {
			if (res.result === 200 && res.datas) {
				var $data = res.datas.sort(function (a, b) {
					if (parseInt(a.sort) > parseInt(b.sort)) return 1;
					if (parseInt(a.sort) < parseInt(b.sort)) return -1;
				})

				var html = "";

				$.each($data, function (index, row) {
					html += ' <li>';
					html += ' 	<div class="prd-item wow fadeInRight" data-wow-delay="'+ (index * 2 / 10) +'s">';
					html += ' 		<div class="img-box" style="background-image:url(' + row.img + ')"></div>';
					html += ' 		<div class="dec-wrap">';
					html += ' 			<strong class="tit">' + row.tit + '</strong>';
					html += ' 			<p class="dec">' + row.dec + '</p>';
					html += ' 		</div>';
					html += ' 	</div>';
					html += ' </li>';
				})
				$("[data-selector=listAppend]").html(html);
			}
		})
	},

	Bind: function () {

	},

	Init: function () {
		Page.Bind();
		Page.Render();
		new WOW().init();
	}
}

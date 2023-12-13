
$(function(){
	Page.Init();
})

var Page = {
	GetData : function(formData, _callback){
		var ajaxUrl = '/routes/api';
		var page = $("#inquiry_page").val() ?? 1;
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: ajaxUrl,
			data: {
				"mode" : "getList",
				"page" : page
			},
			success: function(response) {
				if (typeof _callback === 'function') {
					_callback.call(null, response);
				}
			}
		});
	},

	Render : function(){
		Page.GetData('',function(res){
			if(res.result === 200 && res.datas) {
				var datas = res.datas,
					html = "";

				setTimeout(function(){
					$.each(datas, function(index, row) {
						html += '	<tr style="background-color:#fff;" data-tit="' + row.seq + '" data-selector="storeItem">';
						html += '		<td class="m-hide">' + row.name + '</td>';
						html += '		<td>';
						html += '			<div class="dec">' + row.title + '</div>';
						html += '		</td>';
						html += '		<td class="m-hide">' + row.reg_date + '</a></td>';
						html += '		<td>' + row.reple_yn + '</td>';
						html += '	</tr>';
					})
					$("[data-selector=listAppend]").html(html);
				}, 300)
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

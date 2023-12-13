$(function(){
	Page.Init();
})

var Page = {
	GetData : function(formData, _callback){
		var ajaxUrl = '/api/api.menu.json';
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

				$.each($data, function(index, row) {
					html += ' <li>';
					html += ' 	<div class="prd-item">';
					html += ' 		<div class="img-box" style="background-image:url('+ row.img +')"></div>';
					html += ' 		<div class="dec-wrap">';
					html += ' 			<strong class="tit">'+ row.tit +'</strong>';
					html += ' 			<p class="dec">'+ row.dec +'</p>';
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
	}
}

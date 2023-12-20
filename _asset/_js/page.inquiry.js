
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

	Render : function(type){
		var formData = {
			type : type
		}
		Page.GetData(formData,function(res){
			if(res.result === 200 && res.datas) {
				var datas = res.datas,
					html = "";

				var no = '4';
				$.each(datas, function(index, row) {

					html += '	<li>';
					html += '		<a href="'+ (type === "customer" ? 'javascript:void(0)' : '/page/inquiry_view') +'" class="link-item" '+ (type === "customer" ? 'data-action="qnaView"' : '') +'>';
					html += '			<strong class="no">'+ no +'</strong>';
					html += '			<div class="dec-wrap">';
					html += '				<strong class="tit">' + row.title + '</strong>';
					if(type === "notice") {
						html += '				<p class="dec">' + row.content + '</p>';
					}
					html += '				<dl class="writer">';
					html += '					<dt>'+ row.name + '</dt>';
					html += '					<dd>'+ row.reg_date + '</dd>';
					html += '				</dl>'
					html += '			</div>';
					html += '		</a>';
					if(row.reple_yn === "Y") {
						html += '		<a href="" class="link-item type-re">';
						html += '			<div class="dec-wrap flex">';
						html += '				<strong class="tit">' + row.title + '</strong>';
						html += '				<dl class="writer">';
						html += '					<dt>'+ row.name + '</dt>';
						html += '					<dd>'+ row.reg_date + '</dd>';
						html += '				</dl>';
						html += '			</div>';
						html += '		</a>';
						html += '	</li>';
					}
					html += '	</li>';
					no -= 1;
				})
				$("[data-selector=listAppend]").html(html);
			}
		})
	},

	Submit : function(){
		var $fm = $("[name=frm]");
		if (ND.Form.Validate($fm)) {
			if(confirm("등록 하시겠습니까?")) {
				$fm.attr("action", "/routes/api").submit();
			}
		}
	},

	Bind: function () {
		$("[data-action=submit]").unbind("click").on("click", function(){
			Page.Submit();
		})

		$("[data-action=qnaView]").unbind("click").on("click", function(){
			Page.ViewDetail($(this));
		})
	},

	Init: function () {
		Page.Bind();
	}
}

var __nowPage = ND.RETURN.param("page") ? ND.RETURN.param("page") : 1;

	$(function(){
	Page.Init();
})

var Page = {
	GetData : function(formData, _callback){
		var ajaxUrl = '/routes/api';

		$.ajax({
			type: 'post',
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

	Render : function(type){
		var formData = {
			mode : "getList",
			type : type,
			page : __nowPage
		}
		Page.GetData(formData,function(res){
			if(res.result === 200 && res.datas) {
				var datas = res.datas,
					totCnt = res.total_count,
					pageCnt = 10,
					no = totCnt - pageCnt * (__nowPage - 1),
					html = "";

				$.each(datas, function(index, row) {

					html += '	<li>';
					html += '		<a href="'+ (type === "customer" ? 'javascript:void(0)' : '/page/inquiry_view?type='+ type +'&seq='+ row.seqs) +'" class="link-item" '+ (type === "customer" ? 'data-action="qnaView"' : '') +'>';
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
				PageCommon.AjaxPaging($("[data-selector=pageing]"), totCnt, parseInt(__nowPage), pageCnt, 5, '/page/inquiry', 'type='+ type);
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

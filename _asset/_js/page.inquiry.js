var __nowPage = ND.RETURN.param("page") ? ND.RETURN.param("page") : 1,
	__type = ND.RETURN.param("type"),
	__seq = ND.RETURN.param("seq");

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
			if(res.result === 200) {
				var datas = res.datas,
					totCnt = res.total_count,
					pageCnt = 10,
					no = totCnt - pageCnt * (__nowPage - 1),
					html = "";

				console.log(datas)
				if(datas) {
					$.each(datas, function(index, row) {

						html += '	<li>';
						html += '		<a href="'+ (type === "customer" ? 'javascript:void(0)' : '/page/inquiry_view?type='+ type +'&seq='+ row.seqs) +'" class="link-item '+ (type === "notice" ? "notice-item" : '') +'" '+ (type === "customer" ? 'data-action="qnaView"' : '') +' data-seq="' + row.seqs + '">';
						html += '			<strong class="no">'+ no +'</strong>';
						html += '			<div class="dec-wrap">';
						if(type === "notice") {
							html += '				<p class="date">'+ row.reg_date + '</p>';
						}
						html += '				<strong class="tit">' + row.title + '</strong>';
						if(type === "notice") {
							html += '				<div class="editor">' + row.content.replace(/(<([^>]+)>)/ig,"") + '</div>';
						}
						if(type !== "notice") {
							html += '				<dl class="writer">';
							html += '					<dt>' + row.name + '</dt>';
							html += '					<dd>' + row.reg_date + '</dd>';
							html += '				</dl>'
						}
						html += '			</div>';
						html += '		</a>';
						/*if(row.reple_yn === "Y") {
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
						}*/
						html += '	</li>';
						no -= 1;
					})
					PageCommon.AjaxPaging($("[data-selector=pageing]"), totCnt, parseInt(__nowPage), pageCnt, 5, '/page/inquiry', 'type='+ type);
				} else {
					html += '	<li><p class="no-data">등록된 게시글이 없습니다.</p></li>';
				}

				$("[data-selector=listAppend]").html(html);
			}
		})
	},

	Submit : function(){
		var $fm = $("[name=frm]");
		if (ND.Form.Validate($fm)) {

			if($("[name=privacy_view]").val() !== "Y") {
				alert("개인정보취급방침을 확인하셔야 합니다.")
				$("[data-action=privacyDrop]").click();
				return;
			}

			if(confirm("등록 하시겠습니까?")) {
				$fm.attr("action", "/routes/api").submit();
			}
		}
	},

	ChkPsw : function(e){
		var seq = e.data("seq"),
			pop = '';

		pop += '	<div class="pop-container pop-psw" data-selector="layerPop">';
		pop += '		<div class="pop-inner">';
		pop += '			<header class="pop-header">';
		pop += '				<strong class="tit">비밀번호확인</strong>';
		pop += '				<a href="javascript:void(0)" class="pop-close" data-action="popClose"><span class="a11y">팝업닫기</span></a>';
		pop += '			</header>';
		pop += '			<div class="pop-contents">';
		pop += '				<form name="popFrm" method="post">';
		pop += '					<div class="dl-flex">';
		pop += '						<dl>';
		pop += '							<dt><label class="label req" for="_psw">비밀번호</label></dt>';
		pop += '							<dd>';
		pop += '								<input type="hidden" name="seq" value="'+ seq +'"/>';
		pop += '								<input type="password" name="psw" id="_psw" placeholder="비밀번호를 입력해주세요."/>';
		pop += '							</dd>';
		pop += '						</dl>';
		pop += '						<div class="btn-wrap"><a href="javascript:void(0)" class="btn c-black" data-action="chkSubmit">확인</a></div>';
		pop += '					</div>';
		pop += '				</form>';
		pop += '			</div>';
		pop += '		</div>';
		pop += '	</div>';

		$("[data-selector=layerPop]").remove();
		$("body").append(pop).addClass("_pop");
	},

	ChkSubmit : function(e){
		var $pop = e.closest("[data-selector=layerPop]"),
			fm = $pop.find("[name=popFrm]"),
			seq = fm.find("[name=seq]").val(),
			psw = fm.find("[name=psw]").val(),
			formData = {
				mode : "passwordCheck",
				seq : seq,
				password : psw
			}

			if(!psw) {
				alert("비밀번호를 입력해주세요.");
				return;
			}

		Page.GetData(formData, function(res){
			if(res.result === 200) {
				if(res.passwordCheck){
					fm.attr("action", "/page/inquiry_view?type="+ __type +"&seq="+ seq).submit();
				}else{
					alert("비밀번호가 일치하지 않습니다.");
				}
			} else {
				alert("정확한 비밀번호를 입력해주세요.");
				return;
			}
		})
	},

	PopClose : function(e){
		var $pop = e.closest("[data-selector=layerPop]");
		$pop.remove();
		$("body").removeClass("_pop");
	},

	ViewDetail : function(){
		var formData = {
			mode : "viewDetail",
			seq : __seq
		}
		Page.GetData(formData, function(res){
			console.log(res)
			/*if(res.result === 200) {
				fm.attr("action", "/page/inquiry_view?type="+ __type +"&seq="+ seq).submit();
			} else {
				alert("정확한 비밀번호를 입력해주세요.");
				return;
			}*/
		})
	},

	PrivacyDrop : function(e){
		var $drop = e.closest("[data-selector=dropContainer]");
		$drop.toggleClass("_open");
		$("[name=privacy_view]").val("Y");
	},

	Bind: function () {
		$("[data-action=submit]").unbind("click").on("click", function(){
			Page.Submit();
		})

		$("[data-action=qnaView]").unbind("click");
		$(document).on("click", "[data-action=qnaView]", function(){
			Page.ChkPsw($(this));
		})

		$("[data-action=chkSubmit]").unbind("click");
		$(document).on("click", "[data-action=chkSubmit]", function(){
			Page.ChkSubmit($(this));
		})

		$("[type=password]").unbind("keydown");
		$(document).on("keydown", "[type=password]", function(e) {
			if (e.keyCode === 13) {
				e.preventDefault();
			};
		});

		$("[data-action=popClose]").unbind("click");
		$(document).on("click", "[data-action=popClose]", function(){
			Page.PopClose($(this));
		})

		$("[data-action=privacyDrop]").unbind("click");
		$(document).on("click", "[data-action=privacyDrop]", function(){
			Page.PrivacyDrop($(this));
		})
	},

	Init: function () {
		Page.Bind();
	}
}

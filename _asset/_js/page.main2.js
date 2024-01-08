$(function(){
	Page.Init();
	MainPop.Init();
})

var Page = {
	Slide : function(){
		var option = {
			autoplay: false
		}
		ND.SLIDE.Swiper("mainKv", option)
	},

	Bind : function(){
		$("[data-action=kv]").unbind("click").on("click", function(){
			var container = "kvVideo",
				sid = "1",
				youtube = "l8Nv29RJtKs";
			PageCommon.youtubePlay(container, sid, youtube);
		})
	},

	Init : function(){
		Page.Bind();
		//Page.Slide();
	}
}


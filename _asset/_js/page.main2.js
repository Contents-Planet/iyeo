$(function(){
	Page.Init();
	MainPop.Init();

	setTimeout(() => {
		var container = "kvVideo",
			sid = "1",
			youtube = "l8Nv29RJtKs";
		PageCommon.youtubePlay(container, sid, youtube);
	}, 5000);
})

var Page = {
	Slide : function(){
		var option = {
			autoplay: false
		}
		ND.SLIDE.Swiper("mainKv", option)
	},

	Bind : function(){

	},

	Init : function(){
		Page.Bind();
		//Page.Slide();
	}
}


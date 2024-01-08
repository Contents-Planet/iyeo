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

	},

	Init : function(){
		Page.Bind();
		//Page.Slide();

		setTimeout(() => {
			PageCommon.youtubePlay("kvVideo", "1", "l8Nv29RJtKs");
		}, 500);
	}
}


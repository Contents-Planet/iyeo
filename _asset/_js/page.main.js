$(function(){
	Page.Init();
})

var Page = {
	Slide : function(){
		var option = {
			autoplay: false
		}
		ND.SLIDE.Swiper("mainKv", option)
	},

	MainVideo : function(){

	},

	Bind : function(){

	},

	Init : function(){
		Page.Bind();
		Page.Slide();
		//PageCommon.youtubePlay('kvVideo', '0', 'l8Nv29RJtKs')
	}
}


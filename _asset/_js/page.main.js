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

	Bind : function(){

	},

	Init : function(){
		Page.Bind();
		Page.Slide();
	}
}


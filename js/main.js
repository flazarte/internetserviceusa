(function($) {


	function mobileMenuToggle(){
		$('#menu-toggle,.header-menu-mobile .menu-list-mobile .arrow-con').on('click',function(){
			$('.menu-list-mobile').toggleClass('show');
			$('.header-menu-mobile .search-input-mobile').removeClass('show');

		});
		$('#menu-search').on('click',function(){
			$('.search-input-mobile').toggleClass('show');
			$('.header-menu-mobile .menu-list-mobile').removeClass('show');
		});
	}

	function socialShare(){
		$('.share-btn,.social-con').hover(
	       function(){ $(this).parent('.share-con').find('.social-con').addClass('open') },
	       function(){ $(this).parent('.share-con').find('.social-con').removeClass('open') }
		)
	}

	function openSubmenu(){
		$('header .header-menu .menu-left ul li.parent-li').hover(
			function(){ $(this).find('ul').addClass('open') },
			function(){ $(this).find('ul').removeClass('open') }
		)
		$('header .header-menu .menu-left ul li.parent-li ul').hover(
			function(){ $(this).closest('.parent-li').find('ul').addClass('open') },
			function(){ $(this).closest('.parent-li').find('ul').removeClass('open') }
		)
		
	}

	function slider(){

		// Common Slider
		$(".slider-con").owlCarousel({
		    margin:20,
		    nav:true,
		    items: 3,
		    loop: $('.slider-con .item').length > 3 ? true:false,
		    responsiveClass:true,
		    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		    responsive : {
		    	0 : {
		    		items: 1
		    	},
		    	767:{
		            items:3
		        },
		    	1000 : {
			        items:3
		        }
		    }
		});

		// Popular Article Carousel
		$("#popular-articles").owlCarousel({
		    margin:20,
		    nav:true,
		    items: 3,
		    loop:true,
		    responsiveClass:true,
		    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		    responsive : {
		    	0 : {
		    		items: 1
		    	},
		    	600:{
		            items:2
		        },
		    	1150 : {
			        items:3
		        }
		    }
		});

		// Latest Article Carousel
		$("#latest-articles").owlCarousel({
		    margin:20,
		    nav:true,
		    items: 3,
		    loop:true,
		    responsiveClass:true,
		    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		    responsive : {
		    	0 : {
		    		items: 1
		    	},
		    	600:{
		            items:2
		        },
		    	1000 : {
			        items:3
		        }
		    }
		});


		
		// Product Detail Sync Carousel
		  
		let galleries = document.querySelectorAll(".product-template-default .article-con .article-main .article-head .left");

		Array.prototype.forEach.call(galleries, function(el, i) {
		    const $this = $(el);
		    const $owl1 = $this.find("#product-detail1");
		    const $owl2 = $this.find("#product-detail2");
		    let flag = false;
		    let duration = 300;

		    $owl1.owlCarousel({
				items: 1,
				lazyLoad: false,
				loop: false,
				margin: 10,
				nav: false,
				responsiveClass: true
			})
		    .on("changed.owl.carousel", function(e) {
		        if (!flag) {
		          	flag = true;
		          	$owl2
		            	.find(".owl-item")
		            	.removeClass("current")
		            	.eq(e.item.index)
		            	.addClass("current");
		          	if (
		            $owl2
		              	.find(".owl-item")
		              	.eq(e.item.index)
		              	.hasClass("active")
		          	) {
		          	} else {
		            	$owl2.trigger("to.owl.carousel", [e.item.index, duration, true]);
		          	}
		          	flag = false;
		        }
		    });

		    $owl2.on("initialized.owl.carousel", function() {
	        $owl2
	          	.find(".owl-item")
	          	.eq(0)
	          	.addClass("current");
	      	})
	      	.owlCarousel({
		        items: 4,
		        lazyLoad: false,
		        loop: false,
		        margin: 10,
		        nav: true,
		        responsiveClass: true,
	         	navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    			responsive : {
			    	0 : {
			    		items: 4,
			    		mouseDrag:true,
			    	},
			    	767:{
			            items:3,
			            mouseDrag:true,
			        },
			    	1000 : {
				        items:5,
				        mouseDrag:false,
			        }
			    }
	      	})
	      	.on("click", ".owl-item", function(e) {
	        	e.preventDefault();
	        	var number = $(this).index();
	        	$owl1.trigger("to.owl.carousel", [number, duration, true]);
	      	});
	  	});
	}

	function animation(){
		setTimeout(function(){ 
			$('header .header-logo .cart-icon').addClass('animate-this');

		}, 1000);
		
	}	

	function shopMenu(){
		$('.shop-body .shop-menu ul li .item-con .accordion').click(function(){
			var $this = $(this);
			if($(this).closest('li').is('.open')){
				
				$this.closest('li').removeClass('open');
				$('.shop-body .shop-menu ul li .item-name').removeClass('open');

				$this.removeClass('open');

			}else{
				$('.shop-body .shop-menu ul li ul').removeClass('open');
				$this.closest('li').find('ul .item-name').removeClass('open');
				$(this).closest('li').addClass('open');

				$('.shop-body .shop-menu ul li .item-name').removeClass('open');
				$(this).closest('li').find('.item-name').addClass('open');
				
				$('.shop-body .shop-menu ul li .item-con .accordion').removeClass('open');
				$this.addClass('open');
			}
				
			return false;
		});
		
		$('.header-menu-mobile .menu-list-mobile ul li .item-con .accordion').click(function(){
			var $this = $(this);
			if($(this).closest('li').is('.open')){
				
				$this.closest('li').removeClass('open');
				$('.header-menu-mobile .menu-list-mobile ul li').removeClass('open');

				$this.removeClass('open');

			}else{
				$('.header-menu-mobile .menu-list-mobile ul li ul').removeClass('open');
				$this.closest('li').find('ul .item-name').removeClass('open');
				$(this).closest('li').addClass('open');

				$('.header-menu-mobile .menu-list-mobile ul li').removeClass('open');
				$(this).closest('li').addClass('open');
				
				$('.header-menu-mobile .menu-list-mobile ul li .item-con .accordion').removeClass('open');
				$this.addClass('open');
			}
				
			return false;
		})
	}
	

	$( document ).ready(function() {
	    mobileMenuToggle();
	    // socialShare();
		slider();
		animation();
		shopMenu();
		openSubmenu();
	});

})( jQuery );
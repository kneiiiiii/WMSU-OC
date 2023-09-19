<?php include_once 'template/site_top.php';?>

<body id="home">

    <!-- preloader -->
    <div id="preloader">
        <img src="site_assets/img/preloader.gif" alt="Preloader">
    </div>
    <!-- end preloader -->

    <!-- 
        Fixed Navigation
        ==================================== -->
    <header id="navigation" class="navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <!-- responsive nav button -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars fa-2x"></i>
                </button>
                <!-- /responsive nav button -->

                <!-- logo -->
                <a class="navbar-brand" href="#home">
                    <h1 id="logo">
                        <img src="site_assets/img/logo.png" alt="Branding">
                    </h1>
                </a>
                <!-- /logo -->
            </div>

            <!-- main nav -->
            <nav class="collapse navbar-collapse navbar-right" role="navigation">
                <ul id="nav" class="nav navbar-nav">
                    <li class="current"><a href="#home">Home</a></li>
                    <li><a href="#foods">Foods</a></li>
					<li><a href="#registration">Registration</a></li>
                    <li><a href="#signin">Log-In</a></li>
                </ul>
            </nav>
            <!-- /main nav -->

        </div>
    </header>
    <!--
        End Fixed Navigation
        ==================================== -->



    <!--
        Home Slider
        ==================================== -->

    <section id="slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Indicators bullet -->
            <ol class="carousel-indicators">
                
            </ol>
            <!-- End Indicators bullet -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <!-- single slide -->
                <div class="item active img-fluid"  style="background-image: url(site_assets/img/banner-2.jpg);">
                    <div class="carousel-caption">
                      
					</div>
                </div>
                <!-- end single slide -->

                <!-- single slide -->
                <div class="item img-fluid" style="background-image: url(site_assets/img/banner-3.jpg);">
                    <div class="carousel-caption">
                        

                    </div>
                </div>
                <!-- end single slide -->
				
				<!-- single slide -->
                <div class="item img-fluid" style="background-image: url(site_assets/img/banner-4.jpg);">
                    <div class="carousel-caption">
                        
					</div>
                </div>
                <!-- end single slide -->

            </div>
            <!-- End Wrapper for slides -->

        </div>
    </section>

    <!--
        End Home SliderEnd
        ==================================== -->

    
    <!--
        Our Works
        ==================================== -->

    <section id="foods" class="works clearfix">
        <div class="container">
            <div class="row">

                <div class="sec-title text-center">
                    <h2>MENU</h2>
                    <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
                </div>

                <div class="sec-sub-title text-center ">
					<p>We are always here to serve you</p>
                </div>

                <div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">
                    <ul class="text-center">
                        <li><a href="javascript:;" data-filter="all" class="active filter">All</a></li>
                        <li><a href="javascript:;" data-filter=".SoloMeal" class="filter">Solo Meal</a></li>
                        <li><a href="javascript:;" data-filter=".ComboMeal" class="filter">Combo Meal</a></li>
                        <li><a href="javascript:;" data-filter=".Drinks" class="filter">Drinks</a></li>
						<li><a href="javascript:;" data-filter=".Snacks" class="filter">Snacks</a></li>
                        <li><a href="javascript:;" data-filter=".Desserts" class="filter">Desserts</a></li>
                    </ul>
                </div>
			</div>
        </div>

        <div class="project-wrapper">
			<!-- Solo Meal -->
			<figure class="mix work-item SoloMeal mb-4">
                <img src="site_assets/img/ads_img/solo/Half Spicy, Half Soy Garlic Fried Chicken.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Half Spicy, Half Soy Garlic Fried Chicken" href="site_assets/img/ads_img/solo/Half Spicy, Half Soy Garlic Fried Chicken.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Half Spicy, Half Soy Garlic Fried Chicken</h4>
                    <p>Solo Meal</p>
                </figcaption>
            </figure>
			<figure class="mix work-item SoloMeal">
                <img src="site_assets/img/ads_img/solo/Marinated Beef Bulgogi Solo Meal.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Marinated Beef Bulgogi Solo Meal" href="site_assets/img/ads_img/solo/Marinated Beef Bulgogi Solo Meal.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Marinated Beef Bulgogi Solo Meal</h4>
                    <p>Solo Meal</p>
                </figcaption>
            </figure>
			<figure class="mix work-item SoloMeal">
                <img src="site_assets/img/ads_img/solo/Spicy Fried Chicken Whole.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Spicy Fried Chicken Whole" href="site_assets/img/ads_img/solo/Spicy Fried Chicken Whole.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Spicy Fried Chicken Whole</h4>
                    <p>Solo Meal</p>
                </figcaption>
            </figure>
			<!-- END Solo Meal -->
			
			<!-- COmbo Meal -->
			<figure class="mix work-item ComboMeal">
                <img src="site_assets/img/ads_img/combo/combo1.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Combo 1" href="site_assets/img/ads_img/combo/combo1.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Combo 1</h4>
                    <p>Combo Meal</p>
                </figcaption>
            </figure>
			<figure class="mix work-item ComboMeal">
                <img src="site_assets/img/ads_img/combo/combo2.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Combo 2" href="site_assets/img/ads_img/combo/combo2.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Combo 2</h4>
                    <p>Combo Meal</p>
                </figcaption>
            </figure>
			<figure class="mix work-item ComboMeal">
                <img src="site_assets/img/ads_img/combo/combo3.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Combo 3" href="site_assets/img/ads_img/combo/combo3.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Combo 3</h4>
                    <p>Combo Meal</p>
                </figcaption>
            </figure>
			<!-- END COmbo Meal -->
			
			<!-- Drinks -->
			<figure class="mix work-item Drinks">
                <img src="site_assets/img/ads_img/drinks/Buko Salad Drink.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Buko Salad Drink" href="site_assets/img/ads_img/drinks/Buko Salad Drink.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Buko Salad Drink</h4>
                    <p>Drinks</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Drinks">
                <img src="site_assets/img/ads_img/drinks/Buko Shake.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Buko Shake" href="site_assets/img/ads_img/drinks/Buko Shake.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Buko Shake</h4>
                    <p>Drinks</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Drinks">
                <img src="site_assets/img/ads_img/drinks/Sago at Gulaman.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Sago at Gulaman" href="site_assets/img/ads_img/drinks/Sago at Gulaman.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Sago at Gulaman</h4>
                    <p>Drinks</p>
                </figcaption>
            </figure>
			<!-- End Drinks -->
			
			<!-- Snacks -->
			<figure class="mix work-item Snacks">
                <img src="site_assets/img/ads_img/snacks/Balut.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Balut" href="site_assets/img/ads_img/snacks/Balut.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Balut</h4>
                    <p>Snacks</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Snacks">
                <img src="site_assets/img/ads_img/snacks/Chicharon.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Chicharon" href="site_assets/img/ads_img/snacks/Chicharon.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Chicharon</h4>
                    <p>Snacks</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Snacks">
                <img src="site_assets/img/ads_img/snacks/Suman.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Suman" href="site_assets/img/ads_img/snacks/Suman.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Suman</h4>
                    <p>Snacks</p>
                </figcaption>
            </figure>
			<!-- End Snacks -->
			
			<!-- Desserts -->
			<figure class="mix work-item Desserts">
                <img src="site_assets/img/ads_img/dessert/Banana Cue.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Banana Cue" href="site_assets/img/ads_img/dessert/Banana Cue.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Banana Cue</h4>
                    <p>Desserts</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Desserts">
                <img src="site_assets/img/ads_img/dessert/Buko Salad.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Buko Salad" href="site_assets/img/ads_img/dessert/Buko Salad.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Buko Salad</h4>
                    <p>Desserts</p>
                </figcaption>
            </figure>
			<figure class="mix work-item Desserts">
                <img src="site_assets/img/ads_img/dessert/Taho.jpg" alt="">
                <figcaption class="overlay">
                    <a class="fancybox" rel="ads_img" title="Taho" href="site_assets/img/ads_img/dessert/Taho.jpg"><i
                            class="fa fa-eye fa-lg"></i></a>
                    <h4>Taho</h4>
                    <p>Desserts</p>
                </figcaption>
            </figure>
			<!-- End Desserts -->
		</div>


    </section>

    <!--
        End Our Works
        ==================================== -->

    <!--
        Contact Us
        ==================================== -->

    <section id="registration" class="contact">
        <div class="container">
            <div class="row mb50">

                <div class="sec-title text-center mb50 wow fadeInDown animated" data-wow-duration="500ms">
                    <h2>Register Here!</h2>
                    <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
                </div>

                <div class="sec-sub-title text-center wow rubberBand animated" data-wow-duration="1000ms">
                </div>

                <!-- contact address -->
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInLeft animated" data-wow-duration="500ms">
                    <div class="contact-address">
                        <h3>WMSU - Online Canteen</h3>
                        <p><i class="fa fa-map-marker fa-lg"></i> &nbsp;&nbsp; Normal Rd, Zamboanga City </p>
						<p><i class="fa fa-location-arrow fa-lg"></i> &nbsp;&nbsp; Zamboanga del Sur, 7000</p>
                        <p><i class="fa fa-phone-square fa-lg"></i> &nbsp;&nbsp; (062) 991 1040<a href="../login_form.php">Sign-In</a></p>
                    </div>
                </div>
                <!-- end contact address -->

                <!-- contact form -->
                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 wow fadeInDown animated" data-wow-duration="500ms"
                    data-wow-delay="300ms">
                    <div class="contact-form">
                        <form id="contact-form" name="contact-form">
						
                            <div class="input-group">
                                <div class="input-field">
                                    <input autocomplete="off" type="text" name="lastname" id="lastname"  class="form-control"
									placeholder="&#xf054 Last Name" style="font-family:Arial, FontAwesome">
                                </div>
								<div class="input-field">
                                    <input autocomplete="off" type="text" name="firstname" id="firstname" class="form-control"
									placeholder="&#xf054 First Name" style="font-family:Arial, FontAwesome">
                                </div>
                                
                            </div>
							<div class="input-group">
								<div class="input-field">
                                    <input autocomplete="off" type="text" name="mi" id="mi" class="form-control"
									placeholder="&#xf054 MI" style="font-family:Arial, FontAwesome">
                                </div>
								<div class="input-field">
                                    <input type="text" name="contact" id="contact" class="form-control"
									placeholder="&#xf054 Contact" style="font-family:Arial, FontAwesome">
                                </div>
							</div>
						
                            <div class="input-group">
                                <div class="input-field">
                                    <input autocomplete="off" type="email" name="email_add" id="email_add" class="form-control"
									placeholder="&#xf054 Email Address" style="font-family:Arial, FontAwesome">
                                </div>
								<div class="input-field">
                                    <input type="password" name="pass_word" id="pass_word" class="form-control"
									placeholder="&#xf054 Password" style="font-family:Arial, FontAwesome">
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="submit" id="form-submit" name="form-submit" class="pull-right" value="Register">
                            </div>
                        </form>
						
                    </div>
                </div>
                <!-- end contact form -->
   
            </div>
        </div>

    </section>
	
	<!--
        Meet Our Team
        ==================================== -->

    <section id="signin" class="team">
        <div class="container">
            <div class="row">

                <div class="sec-title text-center wow fadeInUp animated" data-wow-duration="700ms">
                    <h2>Log - In</h2>
                    <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
                </div>

				<figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated"
                    data-wow-duration="500ms" data-wow-delay="300ms">
                </figure>
                <!-- single member -->
                <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated"
                    data-wow-duration="500ms">
                    <div class="member-thumb">
                        <img src="site_assets/img/signin_banner_0.png" alt="Team Member" class="img-responsive">
                        <figcaption class="overlay">
                            <h5><a href='login_form.php'>Click Here!</a> </h5>
                        </figcaption>
					 </div>
                  
                </figure>
                <!-- end single member -->

                <!-- single member -->
                <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated"
                    data-wow-duration="500ms" data-wow-delay="300ms">
                    <div class="member-thumb">
                        <img src="site_assets/img/signin_banner_1.png" alt="Team Member" class="img-responsive">
                        <figcaption class="overlay">
                            <h5><a href='login_customer.php'>Click Here!</a> </h5>
                        </figcaption>
					</div>
                   
                </figure>
                <!-- end single member -->
				<figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated"
                    data-wow-duration="500ms" data-wow-delay="300ms">
                </figure>
               

            </div>
        </div>
    </section>

    <?php include_once 'template/site_bottom.php';?>
    <script>
        var wow = new WOW({
            boxClass: 'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 120,          // distance to the element when triggering the animation (default is 0)
            mobile: false,       // trigger animations on mobile devices (default is true)
            live: true        // act on asynchronously loaded content (default is true)
        }
        );
        wow.init();
    </script>
    <!-- Custom Functions -->
    <script src="site_assets/js/custom.js"></script>

    <script type="text/javascript">
        $(function () {
            /* ========================================================================= */
            /*	Registration Form
            /* ========================================================================= */

            $('#contact-form').validate({
                rules: {
                    lastname: {
                        required: true,
                        minlength: 2
                    },
					firstname: {
                        required: true,
                        minlength: 2
                    },
					mi: {
                        required: true,
                        maxlength: 1
                    },
                    email_add: {
                        required: true,
                        email: true
                    },
                    pass_word: {
                       required: true,
					   minlength: 5
                    },
                    contact: {
                       required: true,
					   number: true,
					   minlength: 7
                    }
                },
                messages: {
                    lastname: {
                        required: "Last Name is Mandatory",
                        minlength: "your last name must consist of at least 2 characters"
                    },
					 firstname: {
                        required: "First Name is Mandatory",
                        minlength: "your first name must consist of at least 2 characters"
                    },
					 mi: {
                        required: "MI is Mandatory",
                        minlength: "your MI must consist of at least 1 characters"
                    },
                    email_add: {
                        required: "Email Address is Mandatory"
                    },
                    pass_word: {
                        required: "Password Address is Mandatory",
						minlength: "Your password must be at least 5 characters long"
                    },
                    contact: {
                        required: "Contact Number is Mandatory",
						minlength: "Your Contact must be at least 7 characters long",
						number:"Please enter numbers Only"
                    }
                },
				
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "process.php",
                        success: function () {

                            $('#contact-form :input').attr('disabled', 'disabled');
                            $('#contact-form').fadeTo("slow", 0.15, function () {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor', 'default');
                                $('#success').fadeIn();
                            });
							alert("Successfully Added!.");
                        },
                        error: function () {
                            $('#contact-form').fadeTo("slow", 0.15, function () {
                                $('#error').fadeIn();
                            });
                        }
                    });
                }
				
				
            });
			
			
			$('#form-submit1').click(function(){
			
				var lastname 		= $("#lastname").val();
				var firstname 		= $("#firstname").val();
				var mi 				= $("#mi").val();
				var contact 		= $("#contact").val();
				var email_add 		= $("#email_add").val();
				var pass_word 		= $("#pass_word").val();
			
				
					$.ajax({
						url:"process.php",
						type:"post",
						data:{
							lastname:lastname,
							firstname:firstname,
							mi:mi,
							contact:contact,
							email_add:email_add,
							pass_word:pass_word
						},success:function(data,status){
							if(data == 'true'){
								alert("Successfully Added!.");
							}
						}
					});
			});
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en" ng-app="gemStore">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Bootstrap Latest compiled and minified CSS -->
		<link type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Optional Bootstrap theme -->
		<link type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet"/>

		<!-- LINK TO YOUR CUSTOM CSS FILES HERE -->
		<link type="text/css" href="../lib/css/styles.css" rel="stylesheet"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script type="text/javascript" src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.1/additional-methods.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- angular.js -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
		<!--
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.7/ngStorage.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js"></script>
		-->
		<script type="text/javascript" src="../lib/angular/tutorial-store.js"></script>

		<!-- Page Title -->
		<title>Store Tutorial With Angular.js</title>
	</head>

	<body ng-controller="StoreController as store">
		<!--  Store Header  -->
		<header>
			<h1 class="text-center">Flatlander Crafted Gems</h1>
			<h2 class="text-center">– an Angular store –</h2>
		</header>

		<!--  Products Container  -->
		<div class="list-group">
			<!--  Product Container  -->
			<div class="list-group-item" ng-repeat="product in store.products">
				<h3>{{product.name}} <em class="pull-right">{{product.price | currency}}</em></h3>

				<!-- Image Gallery  -->
				<div ng-controller="GalleryController as gallery"  ng-show="product.images.length">
					<div class="img-wrap">
						<img ng-src="{{product.images[gallery.current]}}" />
					</div>
					<ul class="img-thumbnails clearfix">
						<li class="small-image pull-left thumbnail" ng-repeat="image in product.images">
							<img ng-src="{{image}}" />
						</li>
					</ul>
				</div>

				<!-- Product Tabs  -->
				<section ng-controller="TabController as tab">
					<ul class="nav nav-pills">
						<li ng-class="{ active:tab.isSet(1) }">
							<a href="" ng-click="tab.setTab(1)">Description</a>
						</li>
						<li ng-class="{ active:tab.isSet(2) }">
							<a href="" ng-click="tab.setTab(2)">Specs</a>
						</li>
						<li ng-class="{ active:tab.isSet(3) }">
							<a href="" ng-click="tab.setTab(3)">Reviews</a>
						</li>
					</ul>

					<!--  Description Tab's Content  -->
					<div ng-show="tab.isSet(1)">
						<h4>Description</h4>
						<blockquote>{{product.description}}</blockquote>
					</div>


					<!--  Spec Tab's Content  -->
					<div ng-show="tab.isSet(2)">
						<h4>Specs</h4>
						<blockquote>Shine: {{product.shine}}</blockquote>
					</div>

					<!--  Review Tab's Content  -->
					<div ng-show="tab.isSet(3)">
						<!--  Product Reviews List -->
						<ul>
							<h4>Reviews</h4>
							<li ng-repeat="review in product.reviews">
								<blockquote>
									<strong>{{review.stars}} Stars</strong>
									{{review.body}}
									<cite class="clearfix">-{{review.author}} on {{review.createdOn}}</cite>
								</blockquote>
							</li>
						</ul>

						<!--  Review Form -->
						<form name="reviewForm" class="container" ng-controller="ReviewController as reviewCtrl" ng-submit="reviewForm.$valid && reviewCtrl.addReview(product)" novalidate>

							<!--  Live Preview -->
							<blockquote ng-show="review">
								<strong>{{reviewCtrl.review.stars}} Stars</strong>
								{{reviewCtrl.review.body}}
								<cite class="clearfix">-{{reviewCtrl.review.author}}</cite>
							</blockquote>

							<!--  Review Form -->
							<h4>Submit a Review</h4>
							<fieldset class="form-group">
								<select ng-model="reviewCtrl.review.stars" class="form-control" ng-options="stars for stars in [5,4,3,2,1]" title="Stars" required>
									<option value="">Rate the Product</option>
								</select>
							</fieldset>
							<fieldset class="form-group">
								<textarea ng-model="reviewCtrl.review.body" class="form-control" placeholder="Write a short review of the product..." title="Review" required></textarea>
							</fieldset>
							<fieldset class="form-group">
								<input ng-model="reviewCtrl.review.author" type="email" class="form-control" placeholder="jimmyDean@example.org" title="Email" required />
							</fieldset>
							<fieldset class="form-group">
								<div> reviewForm is {{reviewForm.$valid}}</div>
								<input type="submit" class="btn btn-primary pull-right" value="Submit Review" />
							</fieldset>
						</form>
					</div>
				</section>
			</div>
		</div>
	</body>
</html>
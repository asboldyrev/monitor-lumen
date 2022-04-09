<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}"/>
		<title>{{ env('APP_NAME') }}</title>
	</head>
	<body>
		<div id="app">
			<div class="container my-2">
				<div class="columns">
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2"><app-system></app-system></div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2"><app-processor></app-processor></div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2"><app-memory></app-memory></div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2"><app-average></app-average></div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2">FileSystem</div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2">Login</div>
					<div class="column col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-3 my-2">Docker</div>
				</div>
			</div>
		</div>
		<script src="{{ mix('/js/manifest.js') }}"></script>
		<script src="{{ mix('/js/vendor.js') }}"></script>
		<script src="{{ mix('/js/app.js') }}"></script>
	</body>
</html>

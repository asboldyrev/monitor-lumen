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
					<div class="column col-3"><appsystem></appsystem></div>
					<div class="column col-3">Processor</div>
					<div class="column col-3">Memory</div>
					<div class="column col-3">Average</div>
					<div class="column col-3">FileSystem</div>
					<div class="column col-3">Login</div>
					<div class="column col-3">Docker</div>
				</div>
			</div>
		</div>
		<script src="{{ mix('/js/manifest.js') }}"></script>
		<script src="{{ mix('/js/vendor.js') }}"></script>
		<script src="{{ mix('/js/app.js') }}"></script>
	</body>
</html>

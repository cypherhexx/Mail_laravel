@extends('app')
@section('content')
<!-- Main navbar -->
@yield('header')
<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
				@yield('sidebar')
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
					@yield('page-header')				
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

				@yield('main')
					<!-- Footer -->
				@yield('footer')
					
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
@endsection


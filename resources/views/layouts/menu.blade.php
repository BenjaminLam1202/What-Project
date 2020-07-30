<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Bootstrap CSS -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<title>Manager</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Infantry</title>
  </head>
  <style type="text/css">
  	.navbar.bg-light{
  		background-color: #000 !important;
  		transition: ease 0.5s;
  	}
  	.user-profile{
  		width: 50px;
  		height: 50px;
  		background-color: #f1f1f1;
  	}
  	.navbar .menu-bar{
  		display: inline-block;
  		width: 50px;
  		height: 50px;
  		margin-right: 10px;
  		position: relative;
  		cursor: pointer;
  	}
  	.navbar .menu-bar .bars{
  		position: relative;
  		top:50%;
  		width:30px;
  		height: 2px;
  		background-color: #fff;
  	}
  	.navbar .menu-bar .bars::after{
  		content: "";
  		position: absolute;
  		bottom: -8px;
  		width: 100%;
  		height: 2px;
  		background-color: #fff;
  	}
  	.navbar .menu-bar .bars::before{
  		content: "";
  		position: absolute;
  		top:-8px;
  		width: 100%;
  		height: 2px;
  		background-color: #fff;
  	}
  	.navbar ul.navbar-nav li.nav-item.ets-right-0 .dropdown-menu{
  		left: auto;
  		right: 0;
  		position: absolute;
  	} 
  	.side-bar{
  		position: fixed;
	  	top:81px;
  		left:0;
  		padding: 15px;
  		display: inline-block;
  		width: 100px;
  		background-color: #fff;
  		box-shadow: 0px 0px 8px #ccc;
  		height: 100vh;
  		transition: ease 0.5s; 
  		overflow-y: auto;
  	}
  	.main-body-content{
  		display: inline-block;
  		padding: 15px;
  		background-color:#eef4fb;
  		height: 100vh;
  		padding-left: 100px;
  		transition: ease 0.5s; 
  	}
  	.ets-pt{
  		padding-top: 100px;
  	}
  	.main-admin.show-menu .side-bar{
  		width: 250px;
  	}

  	.main-admin.show-menu .main-body-content{
  		padding-left: 265px;
  	}
  	.main-admin.show-menu .navbar .menu-bar .bars{
  		width: 15px;
  	}
  	.main-admin.show-menu .navbar .menu-bar .bars::after{
  		width: 10px;
  	}
  	.main-admin.show-menu .navbar .menu-bar .bars::before{
  		width: 25px;
  	}
  	.main-admin.show-menu .side-bar-links{
  		opacity: 1;
  	}
  	.main-admin.show-menu .side-bar .side-bar-icons{
  		opacity: 0;
  	}
  	/**** end effacts ****/
  	.side-bar .side-bar-links{
  		opacity: 0;
  		transition:  ease 0.5s;
  	}
  	.side-bar .side-bar-links ul.navbar-nav li a{
  		font-size: 14px;
  		color: #000;
  		font-weight: 500;
  		padding: 10px;
  	}
  	.side-bar .side-bar-links ul.navbar-nav li a i{
  		font-size:20px;
  		color: #8ac1f6;
  	}
  	.side-bar .side-bar-links ul.navbar-nav li a:hover, .side-bar-links ul.navbar-nav li a:focus{
  		text-decoration: none;
  		background-color: #8ac1f6;
  		color:#fff;
  	}
  	.side-bar .side-bar-links ul.navbar-nav li a:hover i{
  		color:#fff;
  	}
  	.side-bar .side-bar-logo img{
  		width: 100px;
  		height: 100px;
  	}
  	.side-bar .side-bar-icons{
  		position: absolute;
  		top:20px;
  		right:0;
  		width: 100px;
  		opacity: 1;
  		transition: ease 0.5s;
  	}
  	.side-bar .side-bar-icons .side-bar-logo img{
  		width: 50px;
  		height: 50px;
  		object-fit: cover;
  	}
  	.side-bar .side-bar-icons .side-bar-logo h5{
  		font-size: 14px;
  	}
  	.side-bar .side-bar-icons .set-width{
  		color: #000;
  		font-size: 32px;
  	}
  	.side-bar .side-bar-icons .set-width:hover,.side-bar .side-bar-icons .set-width:focus{
  		color: #8ac1f6;
  		text-decoration: none;
  	}
  </style>
  <body>

  	<div id="page-container" class="main-admin">

	  	<nav class="navbar navbar-expand-lg navbar-light bg-light position-absolute w-100">

		  <a class="navbar-brand" href="#"></a>

		  <div id="open-menu" class="menu-bar">

		  	<div class="bars"></div>

		  </div>
        <h5><a href="{!! route('user.change-language', ['en']) !!}">ENG</a><a href="{!! route('user.change-language', ['vn']) !!}">VN</a></h5>
		    <ul class="navbar-nav ml-auto">

		      <li class="nav-item dropdown ets-right-0">

		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

		        <h5 style="color: white;">{{ Auth::user()->name }}

					  @if(DB::table('notifications')->count() > 0) 
                        
            <i class="fa fa-envelope-o"><span class="badge badge-danger">{{DB::table('notifications')->count()}}</span></i>
                                    
            @endif

		        </h5>

		        </a>

		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(DB::table('notifications')->count() == null) 
              <div class="container-fluid">
                <p>no notification ="> <i class="fa fa-heart" aria-hidden="true" style="color: red;"></i></p>
              </div>
              @endif
		          @foreach($notifications as $notification)

					    <div class="alert alert-success" role="alert">
                <div class="container-fluid">
						    <p>{{ json_decode($notification->data)->name }}</p>

						    <a href="/admin/noti/{{ $notification->id }}" class="float-right" data-id="{{ $notification->id }}">Mark as read</a>
                </div>
						  </div>

                @if($loop->index==3)
                    <a href="{{route('demo.xoahet')}}" >

                        <p class="text-center">Mark all as read</p>

                    </a>
                  @break;
                @endif
              @endforeach

		        </div>

		      </li>

		    </ul>

		</nav>

	  	<div class="side-bar position-absolute">

	  		<div class="side-bar-links">

	  			<div class="side-bar-logo text-center py-3">

	  				<h5> {{ __('admin.title') }}</h5>
            <small>Be brave enough to beat everything</small>
	  			</div>

	  			<ul class="navbar-nav">

	  				<li class="nav-item">
	  					<a href="{{ route('admin.manager') }}" class="nav-links d-block"><i class="fa fa-user-plus"></i> {{ __('admin.manager') }}</a>
	  				</li>
            <li class="nav-item">
              <a href="{{ route('admin.post.index') }}" class="nav-links d-block"><i class="fa fa-newspaper-o"></i> {{ __('admin.post') }}</a>
            </li>
            
            <li class="nav-item">
              <a href="{{ route('admin.category.index') }}" class="nav-links d-block"><i class="fa fa-book" aria-hidden="true"></i> {{ __('admin.category') }}</a>
            </li>
            
              <li>
                <hr>
              </li>
              

            <li class="nav-item">
              <a href="/adminer" class="nav-links d-block"><i class="fa fa-database" aria-hidden="true"></i> {{ __('admin.database_adminer') }}</a>
            </li>

            <li class="nav-item">
              <a href="https://github.com/hiltoncybrigde/GoogleHere" class="nav-links d-block"><i class="fa fa-github" aria-hidden="true"></i> {{ __('admin.git_adminer') }}</a>
            </li>
              <li>
                <hr>
              </li>


             @guest

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>

                  @if (Route::has('register'))

                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>

                  @endif

              @else
                  <li class="nav-item dropdown">

                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-key" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span></a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>

                      </div>

                  </li>

              @endguest

	  			</ul>

	  		</div>

	  		<div class="side-bar-icons">

				<div class="side-bar-logo text-center py-3">
          					<h5>{{ __('admin.myblog') }}</h5>
				</div>

				<div class="icons d-flex flex-column align-items-center">
					<a href="{{ route('admin.manager') }}" class="set-width text-center display-inline-block my-1"><span style="color: #96201E;"><i class="fa fa-user-plus"></i></span></a>
          <small>{{ __('admin.manager') }}</small>
				</div>

        <div class="icons d-flex flex-column align-items-center">
          <a href="{{ route('admin.post.index') }}" class="set-width text-center display-inline-block my-1"><span style="color: #96201E;"><i class="fa fa-newspaper-o"></i></span></a>
          <small>{{ __('admin.post') }}</small>
        </div>

        <div class="icons d-flex flex-column align-items-center">
          <a href="{{ route('admin.category.index') }}" class="set-width text-center display-inline-block my-1"><span style="color: #96201E;"><i class="fa fa-book" aria-hidden="true"></i></span></a>
          <small>{{ __('admin.category') }}</small>
        </div>

          <hr>
        <div class="side-bar-logo text-center py-3">
          <h5>{{ __('admin.link') }}</h5>
        </div>      

        <div class="icons d-flex flex-column align-items-center">
          <a href="/adminer" class="set-width text-center display-inline-block my-1"><span style="color: #AD5D1A;"><i class="fa fa-database" aria-hidden="true"></i></span></a>
          <small>{{ __('admin.database') }}</small>
        </div>

        <div class="icons d-flex flex-column align-items-center">
          <a href="https://github.com/hiltoncybrigde/GoogleHere" class="set-width text-center display-inline-block my-1"><i class="fa fa-github" aria-hidden="true"></i></a>
          <small>Git</small>
        </div>

          <hr>

			</div>

		</div>

  	<div class="main-body-content w-100 ets-pt">
  		<div class="table-responsive bg-light">
  				<main class="py-4">
					@yield('contenter')

				</main>
  		</div>
  	</div>
</div>
    @include('layouts.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
    		jQuery("#open-menu").click(function(){
    			if(jQuery('#page-container').hasClass('show-menu')){
    			jQuery("#page-container").removeClass('show-menu');
    		}
    			
    			else{
    			jQuery("#page-container").addClass('show-menu');
    			}
    		});
    	});
    </script>
  </body>



</html>

@extends('planear')

@section('content')
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product" ng-app="App">

<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
			 More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Usa laravel!</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="humans.txt">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

    <!-- Facebook Metadata /-->
    <meta property="fb:page_id" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <meta property="og:title" content="" />

    <!-- Google+ Metadata /-->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <!-- We highly recommend you use SASS and write your custom styles in sass/_custom.scss.
		 However, there is a blank style.css in the css directory should you prefer -->
    <link rel="stylesheet" href="css/gumby.css">
    <link rel="stylesheet" href="css/style.css">


    <script src="js/libs/modernizr-2.6.2.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/controllers.js"></script>
</head>

<body ng-controller="eventCreateCtrl">

    <!-- Grab Google CDN's jQuery, fall back to local if offline -->
    <!-- 2.0 for modern browsers, 1.10 for .oldie -->
    <script>
        var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
        if (!oldieCheck) {
            document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
        } else {
            document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
        }
    </script>
    <script>
        if (!window.jQuery) {
            if (!oldieCheck) {
                document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
            } else {
                document.write('<script src="js/libs/jquery-1.10.1.min.js"><\/script>');
            }
        }
    </script>

    <!--
	Include gumby.js followed by UI modules followed by gumby.init.js
	Or concatenate and minify into a single file -->
    <script gumby-touch="js/libs" src="js/libs/gumby.js"></script>
    <script src="js/libs/ui/gumby.retina.js"></script>
    <script src="js/libs/ui/gumby.fixed.js"></script>
    <script src="js/libs/ui/gumby.skiplink.js"></script>
    <script src="js/libs/ui/gumby.toggleswitch.js"></script>
    <script src="js/libs/ui/gumby.checkbox.js"></script>
    <script src="js/libs/ui/gumby.radiobtn.js"></script>
    <script src="js/libs/ui/gumby.tabs.js"></script>
    <script src="js/libs/ui/gumby.navbar.js"></script>
    <script src="js/libs/ui/jquery.validation.js"></script>
    <script src="js/libs/gumby.init.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- # # # # # Real content of the document # # # # # -->
    <div class="navbar" id="nav1" gumby-fixed="top">
        <a class="toggle" gumby-trigger="#nav1 > div > ul" href="#"><i class="icon-menu"></i></a>
        <div class="row">
            <ul class="twelve columns centered">
                <li><a href="home">Home</a>
                </li>
                <li><a href="event_create">Create event!</a>
                </li>
                <li><a href="profile"><i class="icon-user"></i>Profile</a>
                </li>
                <li><a href="goodbye"><i class="icon-cancel"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="first_element"> Create your event!</h1>

    <div class="row">
        <h2>name</h2>
    </div>
    <div class="row">
        <div class="field">
            <input ng-model="eventName" class="input" type="text" placeholder="Event name" />
        </div>
    </div>

    <h2>very short description</h2>
    </div>
    <div class="row">
        <div class="field">
            <input ng-model="eventDescription" class="input" type="text" placeholder="Code + beer night!" />
        </div>
    </div>

    <div class="row">
        <div class="seven columns">
            <h2>guest</h2>
            <div class="field">
                <input class="input" type="text" placeholder="Invite them all :)" />
            </div>
        </div>

        <div class="five columns">
            <h2>event type</h2>
            <li class="field">
                <div class="picker">
                    <select ng-model="eventType">
                        <option value="#" disabled>what kind of event is?...</option>
                        <option>Party</option>
                        <option>Work</option>
                        <option>Friendly</option>
                    </select>
                </div>
            </li>
        </div>
    </div>

    <div class="row">
        <i class="icon-up-circled" id="big_button" ng-click="postEvent()"></i>
    </div>


</body>

</html>

@endsection

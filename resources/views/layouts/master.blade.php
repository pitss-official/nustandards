<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="NuStandards - Got Skill, Get Certified. Get professional level certificate that matches with current industry standards from Nukrip Technologies Private Limited">
    <meta name="author" content="Nukrip Technologies Private Limited">
    <meta name="keyword" content="Certification,Professional,Engineering,Test,CSE,ECE,Nukrip,Languages,Driverless,Simulation,Automation,Selfdriving,Autonomus,Cars">
    <title>{{ config('app.name') }}</title><link rel="stylesheet" href="{{@asset('css/app.css')}}"><link rel="stylesheet" href="{{@asset('css/all.css')}}"><style>.footer{position:fixed;left:0;bottom:0;width: 100%;}</style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<div id="app">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="/images/fullLogo.png" width="160">
        <img class="navbar-brand-minimized" src="/images/logos.png" width="30">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="/images/user.svg" >
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>{{ __('Logout') }}
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <router-link class="nav-link" to="/home">
                        <i class="nav-icon icon-speedometer"></i> Dashboard
                    </router-link>
                </li>
                <li class="nav-title">Certifications</li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/activeCertifications">
                        <i class="nav-icon icon-briefcase"></i> Active Certifications</router-link>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <router-link class="nav-link" to="/pendingCertifications">--}}
{{--                        <i class="nav-icon icon-badge"></i> Pending Results</router-link>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <router-link class="nav-link" to="/passedCertifications">
                        <i class="nav-icon icon-badge"></i> Passed Certifications</router-link>
                </li>
                @if(Auth::user()->id==1)
                <li class="nav-item">
                    <router-link class="nav-link" to="/genrateCert">
                        <i class="nav-icon icon-badge"></i> Genrate Certificate</router-link>
                </li>
                @endif
                <li class="divider"></li>
                <li class="nav-title">Support</li>
                <li class="nav-item">
                    <a class="nav-link" href="https://purchase.nustandards.com">
                        <i class="nav-icon icon-basket"></i> Purchase Courses</a>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/contact-us">
                        <i class="nav-icon icon-call-out"></i> Contact us</router-link>
                </li>

            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <router-link class="btn" to="/home">
                        <i class="icon-graph"></i>  Dashboard</router-link>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <router-view></router-view>
</div>
</div>
</main>
</div>
</div>
<footer class="app-footer footer">
    <div>
        <span>NuStandards &copy; {{date("Y")}} - {{date("Y")+1}}</span>
        <a href="https://www.nukrip.com">Nukrip Technologies Private Limited</a>
    </div>
    </div>
</footer>
<script src="{{@asset('js/app.js')}}"></script>
</body>
</html>

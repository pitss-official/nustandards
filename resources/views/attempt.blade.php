<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description"
          content="NuStandards - Got Skill, Get Certified. Get professional level certificate that matches with current industry standards from Nukrip Technologies Private Limited">
    <meta name="author" content="Nukrip Technologies Private Limited">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/all.css">
    <style>.footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        .question-bar {
            background-color: white;
            padding: 5px
        }</style>
</head>
<body class="app sidebar-show aside-menu-show">
<header class="app-header ">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <img src="/images/fullLogo.png" width="200" class="img-fluid">
            </div>
        </div>
    </div>
{{--            <img class="mx-auto d-block"  >--}}
{{--        </div>--}}
{{--    </div>--}}
</header>
<br>
<div class="app-body">
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{TestID : {{$testName}}}</h4>
                            <table class="table browser m-t-30 no-border">
                                <tbody>
                                <tr>
                                    <td style="width:40px">{topicid}</td>
                                    <td>{topic-lists}</td>
                                    <td class="text-right"><span class="label label-light-info">23%</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Questions</h4>
                            <table class="table browser m-t-30 no-border">
                                <tbody>
                                <tr class="callout callout-success bg-white">
                                    <td>Google Chrome</td>
                                    <td class="text-right"><span class="label label-light-info">23%</span></td>
                                    <td class="text-right"><span class="label label-light-info">23%</span></td>
                                    <td class="text-right"><span class="label label-light-info">23%</span></td>
                                </tr>
                                <tr class="callout callout-success bg-white"><td style="border-top: none"><button class="btn btn-info" onclick="selectQuestion({quesID})">Q1</button></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{question}</h4>
                            {options}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content here -->
    </main>
</div>
<footer class="app-footer">
    <div>
        <span>NuStandards &copy; {{date("Y")}} - {{date("Y")+1}}</span>
        <a href="https://www.nukrip.com">Nukrip Technologies Private Limited</a>. Disclaimer: Content displayed here, belongs to its respective owners. Nukrip doesn't claim any content as its own.
    </div>
</footer>
</body>
</html>

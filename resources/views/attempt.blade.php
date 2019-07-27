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
    <link rel="icon" href="{{@asset('/images/logos.png')}}">
    <style>.footer{position:fixed;left:0;bottom:0;width: 100%;}</style>
</head>
<body class="app sidebar-show aside-menu-show">
<div id="app">
<header class="app-header ">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <img src="/images/fullLogo.png" width="200" class="img-fluid">
            </div>
        </div>
    </div>
</header>
<br>
<div class="app-body">
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center"><strong>{{$certification['certificationCode']}}: {{$certification['certificationName']}}<div class="pull-right"><button class="btn btn-secondary" id="btn-toggle" onClick="toggle()">-</button></div></strong></h4>
                            <table class="table browser m-t-30 no-border" id="add-info">
                                <tbody>
                                @foreach($topicsQuestions as $topic)
                                <tr>
                                    <td style="font-size: 0.7rem;border-top: none" class="tr-notop">{{$topic['code']}}: {{$topic['topicName']}}</td>
                                    <td class="text-right" style="font-size: 0.7rem;border-top: none"><span class="label label-light-info">{{(count($topic['questions'])*100/$totalQuestions)}}</span></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <questioners-modal-window></questioners-modal-window>
        </div>
    </main>
</div>
<footer class="footer app-footer">
    <div>
        <span>NuStandards &copy; {{date("Y")}} - {{date("Y")+1}}</span>
        <a href="https://www.nukrip.com">Nukrip Technologies Private Limited</a>. <br>Disclaimer: Content displayed here, belongs to its respective owners. Nukrip doesn't claim any content as its own.
    </div>
</footer></div>
</body>
<script src="/js/app.js" defer></script>
<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    window.onbeforeunload = function (e) {
        e.preventDefault();
        e.returnValue = 'Really want to quit?';
    };
    window.onload = function (e) {
        $('#add-info').hide();
        $('#btn-toggle').html('+');
    }
    document.onkeydown = function (e) {
        e = e || window.event;//Get event

        if (!e.ctrlKey) return;

        var code = e.which || e.keyCode;//Get key code

        switch (code) {
            case 83:
            case 87:
            default:
                e.preventDefault();
                e.stopPropagation();
                break;
        }
    };
    function toggle() {
        if($('#btn-toggle').html()=="+")
        {
            $('#btn-toggle').html('-');
            $('#add-info').show();
        }
        else {
            $('#btn-toggle').html('+');
            $('#add-info').hide();
        }
    }
</script>
<script>
    var topicsWithQuestions=@json($topicsQuestions);
    var loraXampIDSYU={{$attemptID}};
    var timer={{$endTime}}
</script>
</html>

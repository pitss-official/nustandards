<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Test</title>
    <STYLE>
        .water-back {
            margin: auto;
            padding-top: -1.25cm;
            padding-left: -1.25cm;
            position: fixed;
            width:    100%;
            height:   100%;
            z-index:  -1000;
        }
        @font-face {
            font-family: 'Source Code Pro ExtraLight';
            src: url('{{asset("/fonts/SourceCodePro-ExtraLight.ttf")}}') format('truetype');
        }
        .column {
            float: left;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </STYLE><link href="https://fonts.googleapis.com/css?family=Libre+Barcode+39|Great+Vibes|Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<div class="water-back" width="109%"><img style="max-width:109%; max-height:100%;" src="{{public_path('/sdfjhios7sdfbdjfy7sdfjn/AAECBack.png')}}"></div>

<div class="row">
    <div class="column" style="width: 5.8%"></div>
    <div class="column" style="width: 50%; margin-top: 7.87cm"><center><p style="font-size: 40px; font-family: 'Pacifico', cursive;">{{$name}}</p></center></div>
    <div class="column" style="width: 35%"></div>
</div>
<div class="row" style="margin-top: 2.55cm">
    <div class="column" style="width: 9.75%"></div>
    <div class="column">
        <p style="font-size: 14px; font-family: 'Source Code Pro ExtraLight';">{{$grade}}</p>
        <p style="font-size: 14px; font-family: 'Source Code Pro ExtraLight'; margin-top: -0.535cm">{{$certID}}</p>
        <p style="font-size: 14px; font-family: 'Source Code Pro ExtraLight'; margin-top: -0.525cm">{{$validStart}}</p>
        <p style="font-size: 14px; font-family: 'Source Code Pro ExtraLight'; margin-top: -0.525cm">{{$validEnd}}</p>
    </div>
</div>
<div class="row" style="padding-top: 17.225cm; position: fixed;z-index: 10;">
    <div class="column" style="width: 1.5%"></div>
    <div class="column" style="width: 95%"><p style="font-family: 'Libre Barcode 39', cursive; font-size: 27px">{{$certID}}</p></div>
</div>
</body>
</html>

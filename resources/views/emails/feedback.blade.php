<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <style>
        div{
            margin: .5rem;
        }
        #wrapper{
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }
        .mail-body{
            width: 80%;
            padding: .5rem 1rem;
            border: 1px solid #111;
            border-radius: 9px;
        }
        .header{
            background: #111;
            border-radius: 9px;
            color: #f4f4f4;
            padding: 1rem;
            text-align: center;
        }
        .message{
            padding-top: 1rem;
            height: 75%;
            border-bottom: 1px solid #111;
        }
        .footer{
            padding-top: 1rem;
            color: #141414;
            font-size: .9rem;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div class="mail-body">
        <div class="header">
            <h2>Вам відправлено відгук
                "{{$title}}"</h2>
        </div>
        <!-- /.header -->
        <div class="message">
            {{$feedback}}
        </div>
        <!-- /.message -->
        <div class="footer">
            Відправлено з сайту {{asset('/')}}.
        </div>
        <!-- /.footer -->
    </div>
    <!-- /.mail-body -->
</div>
<!-- /#wrapper -->
</body>
</html>

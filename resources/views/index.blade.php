<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            #main {
                margin:80px auto;
                width:500px;
            }
            h1 {
                font:bold 40px/38px helvetica, verdana, sans-serif;
                margin:0;
            }
            h1 a {
                color:#600;
                text-decoration:none;
            }
            p {
                background: #ECECEC;
                font:10px/14px verdana, sans-serif;
                margin:8px 0 15px;
                border: 1px #CCC solid;
                padding: 15px;
            }
            .item {
                padding:10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
               @foreach ($articles as $article)
                 <tr>
                     <td>{{ $article[0] }}</td>
                     <br>
                     <td>{{ $article[1] }}</td>
                     <br>
                 </tr>
             @endforeach
            </div>
        </div>
    </body>
</html>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        body {
            background-color: #efefef;
            font-family: Arial;
        }
        .wrap {
            background-color: #fff;
            margin: 0 auto;
            overflow: hidden;
            padding: 30px;
            width: 600px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="content">
            <article>
                <header>
                    {{ TITLE }}
                    <time>{{ DATE }}</time>
                </header>
                <div class="post">
                    {{ CONTENT }}
                </div>
            </article>
        </div>
    </div>
</body>
</html>
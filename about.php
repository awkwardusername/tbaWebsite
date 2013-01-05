<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="css/master.css"/>
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
    <link rel="stylesheet" type="text/css" href="css/lightzap.css"/>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/lightzap.min.js"></script>
    <script>
        $(document).ready(function () {

            var div = $('#header');
            var start = $(div).offset().top;

            $.event.add(window, "scroll", function () {
                var p = $(window).scrollTop();
                $(div).css('position', ((p) > start) ? 'fixed' : 'static');
                $(div).css('top', ((p) > start) ? '0px' : '');
            });

        });
    </script>
</head>

<body>

<div id="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo-banner.png" alt="The Blood Ambulance" id="banner"/></a>
    </div>

    <div id="navi">
        <a href="index.php">home</a> | <a href="pool.php">pool</a> | <a href="members.php">members</a> | <a
            href="about.php">?!~</a>
    </div>
</div>

<div id="wrap">
    <div id="content">
        The Blood Ambulance isThe Blood Ambulance is a website dedicated for presenting and featuring digital wallpapers
        and pictures created in anime/manga style that is usually found in websites such as pixiv.net, deviantart.com
        and the rest of the internet. The users could also upload his/her image or any image that he had found in the
        internet that will satisfy the website's purpose.
    </div>
</div>

<div class="podbar">

    <p>Copyright &copy; 2012 The Blood Ambulance. All rights reserved, except from those things which aren't ours.</p>

</div>
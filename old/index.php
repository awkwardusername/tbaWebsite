<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="../css/master.css"/>
    <link rel="stylesheet" type="text/css" href="../css/footer.css"/>
    <link rel="stylesheet" type="text/css" href="../css/lightzap.css"/>
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/lightzap.min.js"></script>
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
        <a href="index.php">
            <img src="../images/logo-banner.png" alt="The Blood Ambulance" id="banner"/></a>
    </div>

    <div id="navi">
        <a href="index.php">home</a> | <a href="../pool.php">pool</a> | <a href="../members.php">members</a> | <a
            href="about.html">?!~</a>
    </div>
</div>

<div class="wrap">
    <div id="content">
        <div class="main">
            <div id="post-pic">
                <a href="../images/main/post-pic.png" rel="lightzap" title="MPTD # 2332">
                    <img src="../images/main/post-pic.png" alt="MPTD # 2332" width="100%"/></a>
            </div>
            <div id="post-desc">
                <h1>MPTD # 2332</h1>

                <p>Some obviously awesome description of what this image is. Some obviously awesome description of what
                    this image is. Some obviously awesome description of what this image is. Some obviously awesome
                    description of what this image is. Some obviously awesome description of what this image is. </p>
            </div>

            <div id="toprated">
                <h1>Top Rated Pictures</h1>

                <p>blah</p>
            </div>
            <div id="recentuploads">
                <h1>Recently Uploaded Pictures</h1>

                <p>blah</p>
            </div>
        </div>
        <!-- msain -->

    </div>
</div>

<br/>
<br/>

<div class="podbar">

    <p>Copyright &copy; 2012 The Blood Ambulance. All rights reserved, except from those things which aren't ours.</p>

</div>


</body>
</html>

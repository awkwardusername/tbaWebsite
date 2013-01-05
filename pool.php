<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="css/master.css"/>
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
    <link rel="stylesheet" type="text/css" href="css/pool.css"/>
    <link href="css/lightzap.css" rel="stylesheet"/>

    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/lightzap.min.js"></script>
    <script src="js/jquery.infinitescroll.js"></script>
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


<div id="content">
    <section id="pool">
        <?php
        for ($i = 1; $i < 64; $i++) {
            echo '<a href=\'pool/uploads/q (';
            echo $i;
            echo ').jpg\' ';
            echo 'rel=\'lightbox[pool]\' title=\'';
            echo $i;
            echo '\'><img src=\'pool/thumbs/q (';
            echo $i;
            echo ').jpg\' alt=\'';
            echo $i;
            echo '\' /></a>';
        }
        ?>

    </section>
    <!-- msain -->

</div>

<br/>
<br/>

<div class="podbar">

    <p>Copyright &copy; 2012 The Blood Ambulance. All rights reserved, except from those things which aren't ours.</p>

</div>


</body>
</html>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="css/master2.css"/>
    <link rel="stylesheet" type="text/css" href="css/pool.css" />
    <link rel="stylesheet" type="text/css" href="css/lightzap.css"/>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/lightzap.min.js"></script>
    <script>
    </script>
</head>

<body>
<div id="header">

    <div id="logo">
        <a href="index.php">
            <img src="images/logo-banner.png" alt="The Blood Ambulance" id="banner"/></a>
    </div>
    <div id="navi">
        <a href="index.php">home</a> | <a href="pool.php">pool</a> | <a href="members.php">members</a> | <a
            href="about.php">?!~</a>
    </div>
</div>


<div id="img-pool">
    <section id="pool">
        <?php
        for ($i = 1; $i < 64; $i++)
        {
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
<div id="footer">
    <p>Copyright &copy; 2012 The Blood Ambulance. All rights reserved, except from those things which aren't ours.</p>
</div>


</body>
</html>
﻿<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="css/master2.css"/>
    <link rel="stylesheet" type="text/css" href="css/lightzap.css"/>
    <link rel="shortcut icon" type="image/gif" href="favicon.gif"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js"></script>
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
    <div id="user">
        <?php
        include "head_login.php";
        ?>
    </div>
    <div id="navi">
        <a href="index.php">home</a> | <a href="pool.php">pool</a> | <a href="members.php">members</a> | <a
            href="about.php">?!~</a> | <a href="forum/index.php" target="_blank">Forums</a>
    </div>
</div>
<div id="sidebar">
    <div id="chat">
        <?php
        include "sidebar.php";
        ?>
    </div>
</div>
<div id="content_forum">
    <div id="forum">
        <iframe src="http://localhost/TheBloodAmbulance/forum/" width="99%" height="1500px"></iframe>
    </div>
</div>


<br/>
<br/>

<div id="footer">
    <p>Copyright &copy; 2012 <a href="https://facebook.com/groups/thebloodambulance" target="_blank">The Blood
        Ambulance</a>. All rights reserved, except from those things which aren't ours.</p>
</div>

</body>
</html>
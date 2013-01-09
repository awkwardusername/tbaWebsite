<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Blood Ambulance</title>
    <link rel="stylesheet" type="text/css" href="css/master2.css"/>
    <link rel="stylesheet" type="text/css" href="css/lightzap.css"/>
    <link rel="shortcut icon" type="image/gif" href="favicon.gif"/>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/lightzap.min.js"></script>
    <style type="text/css">
        #toprated {

        }

        .single {
            padding: 5px;
            padding-bottom: 0;
        }

        .author {
            text-align: left;
            padding-left: 5px;
        }

        .rating {
            text-align: right;
            font-weight: bold;
            padding-right: 5px;
        }
    </style>
</head>

<body>

<div id="header">
    <div id="logo">
        <a href="index.php">
            <img src="images/logo-banner.png" alt="The Blood Ambulance" id="banner"/></a>
    </div>
    <div id="user">
        <?php
        include "login.php";
        ?>
    </div>
    <div id="navi">
        <a href="index.php">home</a> | <a href="pool.php">pool</a> | <a href="members.php">members</a> | <a
            href="about.php">?!~</a>
    </div>
</div>
<div id="sidebar">
    <div id="chat">
        <?php
        include "sidebar.php";
        ?>
    </div>
</div>
<div id="content">
    <div id="post-pic">
        <a href="images/main/post-pic.jpg" rel="lightzap" title="MPTD # 2332">
            <img src="images/main/post-pic.jpg" alt="MPTD # 2332" width="100%"/></a>
    </div>
    <div id="post-desc">
        <h1>MPTD # 2332</h1>

        <p>This website is in the clouds. I mean, the clouds. Where? At @<a href="http://dry-sands-7734.herokuapp.com/">heroku</a>
            and @<a href="http://tbadraft.orchestra.io/">engineyard</a>. Took me hours to set up the server itself.
            Also, this website is also hosted at <a href="https://github.com/awkwardusername/tbaWebsite">github</a>. As
            of now, be happy with this page description that I am giving you. I am also happy with it too. Because,
            finally, i've done something that I actually enjoy doing. Website will be continually improved and the whole
            of The Blood Ambulance community in <a href="https://facebook.com/groups/thebloodambulance">facebook</a>.
        </p>
    </div>

    <div id="toprated">
        <h1>Top Rated Pictures</h1>
        <table>
            <tr>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-2.jpg" rel="lightzap[hurr]"><img src="pool/thumb-2.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-3.jpg" rel="lightzap[hurr]"><img src="pool/thumb-3.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-4.jpg" rel="lightzap[hurr]"><img src="pool/thumb-4.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-5.jpg" rel="lightzap[hurr]"><img src="pool/thumb-5.jpg"/></a>
                </td>
            </tr>
            <tr>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
            </tr>

        </table>
    </div>
    <div id="recentuploads">
        <h1>Recently Uploaded Pictures</h1>
        <table>
            <tr>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
                <td class="single" colspan="2">
                    <a href="pool/thumb-1.jpg" rel="lightzap[hurr]"><img src="pool/thumb-1.jpg"/></a>
                </td>
            </tr>
            <tr>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
                <td class="author">
                    by <strong>awk</strong>
                </td>
                <td class="rating">
                    500
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- msain -->

<br/>
<br/>

<div id="footer">
    <p>Copyright &copy; 2012 <a href="https://facebook.com/groups/thebloodambulance" target="_blank">The Blood
        Ambulance</a>. All rights reserved, except from those things which aren't ours.</p>
</div>


</body>
</html>

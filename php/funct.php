<?php
function createsessions($username, $password)
{
    //Add additional member to Session array as per requirement
    session_register();

    $_SESSION["gdusername"] = $username;
    $_SESSION["gdpassword"] = md5($password);

    if (isset($_POST['remme'])) {
        //Add additional member to cookie array as per requirement
        setcookie("gdusername", $_SESSION['gdusername'], time() + 60 * 60 * 24 * 100, "/");
        setcookie("gdpassword", $_SESSION['gdpassword'], time() + 60 * 60 * 24 * 100, "/");
        return;
    }
}

function clearsessionscookies()
{
    unset($_SESSION['gdusername']);
    unset($_SESSION['gdpassword']);

    session_unset();
    session_destroy();

    setcookie("gdusername", "", time() - 60 * 60 * 24 * 100, "/");
    setcookie("gdpassword", "", time() - 60 * 60 * 24 * 100, "/");
}

function confirmUser($username, $password)
{
    // $md5pass = md5($password); // Not needed any more as pointed by ted_chou12

    /* Validate from the database but as for now just demo username and password */
    $form_username = forum_trim($username);
    $form_password = forum_trim($password);

    $query = array(
        'SELECT' => 'u.id, u.group_id, u.password, u.salt',
        'FROM' => 'users AS u'
    );
    $query['WHERE'] = 'username=\'$username\'';
    $result = query_build($query);
    list($user_id, $group_id, $db_password_hash, $salt) = fetch_row($result);

    $authorized = false;
    if (!empty($db_password_hash))
    {
        $sha1_in_db = (strlen($db_password_hash) == 40) ? true : false;
        $form_password_hash = forum_hash($form_password, $salt);

        if ($sha1_in_db && $db_password_hash == $form_password_hash)
            $authorized = true;
        else if ((!$sha1_in_db && $db_password_hash == md5($form_password)) || ($sha1_in_db && $db_password_hash == sha1($form_password)))
        {
            $authorized = true;

            $salt = random_key(12);
            $form_password_hash = forum_hash($form_password, $salt);

            // There's an old MD5 hash or an unsalted SHA1 hash in the database, so we replace it
            // with a randomly generated salt and a new, salted SHA1 hash
            $query = array(
                'UPDATE' => 'users',
                'SET' => 'password=\'' . $form_password_hash . '\', salt=\'escape($salt)\'',
                'WHERE' => 'id=' . $user_id
            );

            query_build($query);
        }
    }

    return $authorized;
}

function checkLoggedin()
{
    if (isset($_SESSION['gdusername']) AND isset($_SESSION['gdpassword']))
        return true;
    elseif (isset($_COOKIE['gdusername']) && isset($_COOKIE['gdpassword'])) {
        if (confirmUser($_COOKIE['gdusername'], $_COOKIE['gdpassword'])) {
            createsessions($_COOKIE['gdusername'], $_COOKIE['gdpassword']);
            return true;
        } else {
            clearsessionscookies();
            return false;
        }
    } else
        return false;
}

function random_key($len, $readable = false, $hash = false)
{
    $key = '';

    $return = ($hook = get_hook('fn_random_key_start')) ? eval($hook) : null;
    if ($return != null)
        return $return;

    if ($hash)
        $key = substr(sha1(uniqid(rand(), true)), 0, $len);
    else if ($readable) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        for ($i = 0; $i < $len; ++$i)
            $key .= substr($chars, (mt_rand() % strlen($chars)), 1);
    } else
        for ($i = 0; $i < $len; ++$i)
            $key .= chr(mt_rand(33, 126));

    return $key;
}

function forum_trim($str, $charlist = " \t\n\r\0\x0B\xC2\xA0")
{
    return utf8_trim($str, $charlist);
}

function utf8_trim($str, $charlist = FALSE)
{
    if ($charlist === FALSE)
    {
        return trim($str);
    }

    // Quote charlist for use in a characterclass
    $charlist = preg_quote($charlist, '#');

    return preg_replace('#^[' . $charlist . ']+|[' . $charlist . ']+$#u', '', $str);
}

function forum_hash($str, $salt)
{
    return sha1($salt . sha1($str));
}

function query_build($query, $return_query_string = false, $unbuffered = false)
{
    $sql = '';

    if (isset($query['SELECT']))
    {
        $sql = 'SELECT ' . $query['SELECT'] . ' FROM ' . (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . $query['FROM'];

        if (isset($query['JOINS']))
        {
            foreach ($query['JOINS'] as $cur_join)
                $sql .= ' ' . key($cur_join) . ' ' . (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . current($cur_join) . ' ON ' . $cur_join['ON'];
        }

        if (!empty($query['WHERE']))
            $sql .= ' WHERE ' . $query['WHERE'];
        if (!empty($query['GROUP BY']))
            $sql .= ' GROUP BY ' . $query['GROUP BY'];
        if (!empty($query['HAVING']))
            $sql .= ' HAVING ' . $query['HAVING'];
        if (!empty($query['ORDER BY']))
            $sql .= ' ORDER BY ' . $query['ORDER BY'];
        if (!empty($query['LIMIT']))
            $sql .= ' LIMIT ' . $query['LIMIT'];
    } else if (isset($query['INSERT']))
    {
        $sql = 'INSERT INTO ' . (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . $query['INTO'];

        if (!empty($query['INSERT']))
            $sql .= ' (' . $query['INSERT'] . ')';

        if (is_array($query['VALUES']))
            $sql .= ' VALUES(' . implode('),(', $query['VALUES']) . ')';
        else
            $sql .= ' VALUES(' . $query['VALUES'] . ')';
    } else if (isset($query['UPDATE']))
    {
        $query['UPDATE'] = (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . $query['UPDATE'];

        $sql = 'UPDATE ' . $query['UPDATE'] . ' SET ' . $query['SET'];

        if (!empty($query['WHERE']))
            $sql .= ' WHERE ' . $query['WHERE'];
    } else if (isset($query['DELETE']))
    {
        $sql = 'DELETE FROM ' . (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . $query['DELETE'];

        if (!empty($query['WHERE']))
            $sql .= ' WHERE ' . $query['WHERE'];
    } else if (isset($query['REPLACE']))
    {
        $sql = 'REPLACE INTO ' . (isset($query['PARAMS']['NO_PREFIX']) ? '' : $this->prefix) . $query['INTO'];

        if (!empty($query['REPLACE']))
            $sql .= ' (' . $query['REPLACE'] . ')';

        $sql .= ' VALUES(' . $query['VALUES'] . ')';
    }

    return ($return_query_string) ? $sql : query($sql, $unbuffered);
}

function query($sql, $unbuffered = false)
{
    if (strlen($sql) > 140000)
        exit('Insane query. Aborting.');

    if (defined('FORUM_SHOW_QUERIES'))
        $q_start = forum_microtime();

    $this->query_result = @mysqli_query($this->link_id, $sql);

    if ($this->query_result)
    {
        if (defined('FORUM_SHOW_QUERIES'))
            $this->saved_queries[] = array($sql, sprintf('%.5f', forum_microtime() - $q_start));

        ++$this->num_queries;

        return $this->query_result;
    } else
    {
        if (defined('FORUM_SHOW_QUERIES'))
            $this->saved_queries[] = array($sql, 0);

        return false;
    }
}

function fetch_row($query_id = 0)
{
    return ($query_id) ? @mysqli_fetch_row($query_id) : false;
}

function connectDB($db_host, $db_username, $db_password, $db_name, $db_prefix, $foo)
{
    // Was a custom port supplied with $db_host?
    if (strpos($db_host, ':') !== false)
        list($db_host, $db_port) = explode(':', $db_host);

    if (isset($db_port))
        $link_id = @mysqli_connect($db_host, $db_username, $db_password, $db_name, $db_port);
    else
        $link_id = @mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (!$link_id)
        error('Unable to connect to MySQL and select database.<br/>MySQL reported: ' . mysqli_connect_error(), __FILE__, __LINE__);

    return $link_id;
}

function error()
{
    global $forum_config;

    if (!headers_sent())
    {
        // if no HTTP responce code is set we send 503
        if (!defined('FORUM_HTTP_RESPONSE_CODE_SET'))
            header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Content-type: text/html; charset=utf-8');
    }

    /*
		Parse input parameters. Possible function signatures:
		error('Error message.');
		error(__FILE__, __LINE__);
		error('Error message.', __FILE__, __LINE__);
	*/
    $num_args = func_num_args();
    if ($num_args == 3)
    {
        $message = func_get_arg(0);
        $file = func_get_arg(1);
        $line = func_get_arg(2);
    } else if ($num_args == 2)
    {
        $file = func_get_arg(0);
        $line = func_get_arg(1);
    } else if ($num_args == 1)
        $message = func_get_arg(0);

    // Set a default title and gzip setting if the script failed before $forum_config could be populated
    if (empty($forum_config))
    {
        $forum_config['o_board_title'] = 'PunBB';
        $forum_config['o_gzip'] = '0';
    }

    // Empty all output buffers and stop buffering
    while (@ob_end_clean()) ;

    // "Restart" output buffering if we are using ob_gzhandler (since the gzip header is already sent)
    if (!empty($forum_config['o_gzip']) && extension_loaded('zlib') && !empty($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false || strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate') !== false))
        ob_start('ob_gzhandler');

    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <title>Error - <?php echo forum_htmlencode($forum_config['o_board_title']) ?></title>
</head>
<body style="margin: 40px; font: 85%/150% verdana, arial, sans-serif; color: #222; max-width: 55em;">
<h1 style="color: #a00000; font-weight: normal;">An error was encountered</h1>
    <?php

    if (isset($message))
        echo '<p>' . $message . '</p>' . "\n";

    if ($num_args > 1)
    {
        if (defined('FORUM_DEBUG'))
        {
            if (isset($file) && isset($line))
                echo '<p>The error occurred on line ' . $line . ' in ' . $file . '</p>' . "\n";

            $db_error = isset($GLOBALS['forum_db']) ? $GLOBALS['forum_db']->error() : array();
            if (!empty($db_error['error_msg']))
            {
                echo '<p><strong>Database reported:</strong> ' . forum_htmlencode($db_error['error_msg']) . (($db_error['error_no']) ? ' (Errno: ' . $db_error['error_no'] . ')' : '') . '.</p>' . "\n";

                if ($db_error['error_sql'] != '')
                    echo '<p><strong>Failed query:</strong> <code>' . forum_htmlencode($db_error['error_sql']) . '</code></p>' . "\n";
            }
        } else
            echo '<p style="font-size: .95em;"><strong>Note:</strong> For detailed error information (necessary for troubleshooting), enable "DEBUG mode".<br/>To enable "DEBUG mode", open up&nbsp;the file config.php in&nbsp;a&nbsp;text editor, add a&nbsp;line that looks like <nobr>"define(\'FORUM_DEBUG\', 1);"</nobr> (without the quotation marks), and re-upload the file.<br/>Once you\'ve solved the problem, it&nbsp;is recommended that "DEBUG mode" be&nbsp;turned off again (just remove the line from the file and re-upload it).</p>' . "\n";
    }

    ?>

</body>
</html>
<?php

    // If a database connection was established (before this error) we close it
    if (isset($GLOBALS['forum_db']))
        $GLOBALS['forum_db']->close();

    exit;
}


?>
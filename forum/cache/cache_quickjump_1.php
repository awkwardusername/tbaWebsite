<?php

    if (!defined('FORUM'))
        exit;
    define('FORUM_QJ_LOADED', 1);
    $forum_id = isset($forum_id) ? $forum_id : 0;

?>
<form id="qjump" method="get" accept-charset="utf-8"
      action="http://segoe-pc:1359/TheBloodAmbulance/forum/viewforum.php">
    <div class="frm-fld frm-select">
        <label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br/>
		<span class="frm-input"><select id="qjump-select" name="id">
            <optgroup label="Forum Threads">
                <option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Announcements</option>
                <option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>News</option>
                <option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>General Topics</option>
                <option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>Fun Stuff</option>
            </optgroup>
        </select>
		<input type="submit" id="qjump-submit" value="<?php echo $lang_common['Go'] ?>"/></span>
    </div>
</form>
<?php

    $forum_javascript_quickjump_code = <<<EOL
(function () {
	var forum_quickjump_url = "http://segoe-pc:1359/TheBloodAmbulance/forum/viewforum.php?id=$1";
	var sef_friendly_url_array = new Array(4);
	sef_friendly_url_array[2] = "announcements";
	sef_friendly_url_array[3] = "news";
	sef_friendly_url_array[4] = "general-topics";
	sef_friendly_url_array[5] = "fun-stuff";

	PUNBB.common.addDOMReadyEvent(function () { PUNBB.common.attachQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array); });
}());
EOL;

    $forum_loader->add_js($forum_javascript_quickjump_code, array('type' => 'inline', 'weight' => 60, 'group' => FORUM_JS_GROUP_SYSTEM));
?>

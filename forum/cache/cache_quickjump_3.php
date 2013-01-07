<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?>
<form id="qjump" method="get" accept-charset="utf-8" action="http://localhost/TheBloodAmbulance/forum/viewforum.php">
    <div class="frm-fld frm-select">
        <label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br/>
		<span class="frm-input"><select id="qjump-select" name="id">
            <optgroup label="The Blood Ambulance">
                <option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Announcements</option>
                <option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>TBA Discussions</option>
                <option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Bug Reports/Site
                    Problems
                </option>
            </optgroup>
            <optgroup label="README">
                <option value="15"<?php echo ($forum_id == 15) ? ' selected="selected"' : '' ?>>Important!</option>
                <option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>Introductions.</option>
            </optgroup>
            <optgroup label="Main">
                <option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>Global News Feed</option>
                <option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Off-topic Discussions
                </option>
                <option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Serious Talks</option>
            </optgroup>
            <optgroup label="Anime/Manga/Gaimuuu">
                <option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>General A/M Discussion
                </option>
                <option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Music/Video, Miku, Osu
                </option>
                <option value="10"<?php echo ($forum_id == 10) ? ' selected="selected"' : '' ?>>Current Anime Episode
                    Talks
                </option>
                <option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>The Games Forum</option>
            </optgroup>
            <optgroup label="Art! Culture! PR)N!">
                <option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>Pixiv Artist
                    Features!~
                </option>
                <option value="12"<?php echo ($forum_id == 12) ? ' selected="selected"' : '' ?>>Japan... NIPPON! Culture
                    and Everything
                </option>
                <option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Er*. Pr)n. L*lis
                </option>
            </optgroup>
        </select>
		<input type="submit" id="qjump-submit" value="<?php echo $lang_common['Go'] ?>"/></span>
    </div>
</form>
<?php

$forum_javascript_quickjump_code = <<<EOL
(function () {
	var forum_quickjump_url = "http://localhost/TheBloodAmbulance/forum/viewforum.php?id=$1";
	var sef_friendly_url_array = new Array(15);
	sef_friendly_url_array[2] = "announcements";
	sef_friendly_url_array[3] = "tba-discussions";
	sef_friendly_url_array[4] = "bug-reportssite-problems";
	sef_friendly_url_array[15] = "important";
	sef_friendly_url_array[16] = "introductions";
	sef_friendly_url_array[5] = "global-news-feed";
	sef_friendly_url_array[6] = "offtopic-discussions";
	sef_friendly_url_array[7] = "serious-talks";
	sef_friendly_url_array[8] = "general-am-discussion";
	sef_friendly_url_array[9] = "musicvideo-miku-osu";
	sef_friendly_url_array[10] = "current-anime-episode-talks";
	sef_friendly_url_array[14] = "the-games-forum";
	sef_friendly_url_array[11] = "pixiv-artist-features";
	sef_friendly_url_array[12] = "japan-nippon-culture-and-everything";
	sef_friendly_url_array[13] = "er-prn-llis";

	PUNBB.common.addDOMReadyEvent(function () { PUNBB.common.attachQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array); });
}());
EOL;

$forum_loader->add_js($forum_javascript_quickjump_code, array('type' => 'inline', 'weight' => 60, 'group' => FORUM_JS_GROUP_SYSTEM));
?>

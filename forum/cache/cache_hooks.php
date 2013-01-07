<?php

define('FORUM_HOOKS_LOADED', 1);

$forum_hooks = array(
    'po_pre_optional_fieldset' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && $forum_user[\'g_pun_tags_allow\'])
			{
				// if pun_approval is installed, we make adding of tags impossible when topic is being created.
				// User can add tags to the topic after it is approved.
				$query= array(
					\'SELECT\'	=> \'disabled\',
					\'FROM\'		=> \'extensions\',
					\'WHERE\'		=> \'id=\\\'pun_approval\\\'\'
				);
				$result=$forum_db->query_build($query) or error(__FILE__, __LINE__);

				$row = $forum_db->fetch_assoc($result);
				if ($row)
					$appr_disabled = $row[\'disabled\'];
				else
					$appr_disabled = true;

				// Chek if pun_approval is installed and enabled
				if ($appr_disabled || $forum_user[\'g_id\'] == FORUM_ADMIN)
				{
					?>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
								<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php echo empty($_POST[\'pun_tags\']) ? \'\' : forum_htmlencode($_POST[\'pun_tags\']) ?>" size="70" maxlength="100"/></span>
						</div>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><div class="fld-input"><?php echo $lang_pun_tags[\'Tags warning\'] ?></div></label><br />
						</div>
					</div>
					<?php
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_pre_checkbox_display' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
				{
					foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $tag_id)
						$res_tags[] = $pun_tags[\'index\'][$tag_id];
				}

				?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="70" maxlength="100"/></span>
					</div>
				</div>
				<?php
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ft_js_include' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

switch ($forum_config[\'o_pun_jquery_include_method\'])
			{
				case PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN:
					$ext_pun_jquery_url = \'//ajax.googleapis.com/ajax/libs/jquery/\'.PUN_JQUERY_VERSION.\'/jquery.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN:
					$ext_pun_jquery_url = \'//ajax.aspnetcdn.com/ajax/jQuery/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN:
					$ext_pun_jquery_url = \'//code.jquery.com/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_LOCAL:
				default:
					$ext_pun_jquery_url = $ext_info[\'url\'].\'/js/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;
			}

			$forum_loader->add_js($ext_pun_jquery_url, array(\'type\' => \'url\', \'async\' => false, \'weight\' => 75));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_row_pre_display' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ((isset($vote_results) || isset($vote_form)) && ($cur_post[\'id\'] == $cur_topic[\'first_post_id\'])) {
				$pun_poll_block = \'\';
				if (!empty($vote_form)) {
					$pun_poll_block	.= $vote_form;
				}
				$pun_poll_block	.= $vote_results;

				if (isset($forum_page[\'message\'][\'edited\'])) {
					array_insert($forum_page[\'message\'], \'edited\', $pun_poll_block, \'pun_poll\');
				} else if (isset($forum_page[\'message\'][\'signature\'])) {
					array_insert($forum_page[\'message\'], \'signature\', $pun_poll_block, \'pun_poll\');
				} else {
					$forum_page[\'message\'][\'pun_poll\'] = $pun_poll_block;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aex_section_manage_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

($hook = get_hook(\'pun_repository_pre_display_ext_list\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content main-extensions">
		<p class="content-options options"><a href="<?php echo $base_url ?>/admin/extensions.php?pun_repository_update&amp;csrf_token=<?php echo generate_form_token(\'pun_repository_update\') ?>"><?php echo $lang_pun_repository[\'Clear cache\'] ?></a></p>
<?php

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	$pun_repository_error = \'\';

	if (pun_repository_generate_cache($pun_repository_error))
	{
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
	}
	else
	{

		?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
		<?php

		// Stop processing hook
		return;
	}
}

$pun_repository_parsed = array();
$pun_repository_skipped = array();

// Display information about extensions in repository
foreach ($pun_repository_extensions as $pun_repository_ext)
{
	// Skip installed extensions
	if (isset($inst_exts[$pun_repository_ext[\'id\']]))
	{
		$pun_repository_skipped[\'installed\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Skip uploaded extensions (including incorrect ones)
	if (is_dir(FORUM_ROOT.\'extensions/\'.$pun_repository_ext[\'id\']))
	{
		$pun_repository_skipped[\'has_dir\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Check for unresolved dependencies
	if (isset($pun_repository_ext[\'dependencies\']))
		$pun_repository_ext[\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_ext[\'dependencies\']);

	if (empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
	{
		// \'Download and install\' link
		$pun_repository_ext[\'options\'] = array(\'<a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_install=\'.$pun_repository_ext[\'id\'].\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_install_\'.$pun_repository_ext[\'id\']).\'">\'.$lang_pun_repository[\'Download and install\'].\'</a>\');
	}
	else
		$pun_repository_ext[\'options\'] = array();

	$pun_repository_parsed[] = $pun_repository_ext[\'id\'];

	// Direct links to archives
	$pun_repository_ext[\'download_links\'] = array();
	foreach (array(\'zip\', \'tgz\', \'7z\') as $pun_repository_archive_type)
		$pun_repository_ext[\'download_links\'][] = \'<a href="\'.PUN_REPOSITORY_URL.\'/\'.$pun_repository_ext[\'id\'].\'/\'.$pun_repository_ext[\'id\'].\'.\'.$pun_repository_archive_type.\'">\'.$pun_repository_archive_type.\'</a>\';

	($hook = get_hook(\'pun_repository_pre_display_ext_info\')) ? eval($hook) : null;

	// Let\'s ptint it all out
?>
		<div class="ct-box info-box extension available" id="<?php echo $pun_repository_ext[\'id\'] ?>">
			<h3 class="ct-legend hn"><span><?php echo forum_htmlencode($pun_repository_ext[\'title\']).\' \'.$pun_repository_ext[\'version\'] ?></span></h3>
			<p><?php echo forum_htmlencode($pun_repository_ext[\'description\']) ?></p>
<?php

	// List extension dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'dependency\']))
		echo \'
			<p>\', $lang_pun_repository[\'Dependencies:\'], \' \', implode(\', \', $pun_repository_ext[\'dependencies\'][\'dependency\']), \'</p>\';

?>
			<p><?php echo $lang_pun_repository[\'Direct download links:\'], \' \', implode(\' \', $pun_repository_ext[\'download_links\']) ?></p>
<?php

	// List unresolved dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
		echo \'
			<div class="ct-box warn-box">
				<p class="warn">\', $lang_pun_repository[\'Resolve dependencies:\'], \' \', implode(\', \', array_map(create_function(\'$dep\', \'return \\\'<a href="#\\\'.$dep.\\\'">\\\'.$dep.\\\'</a>\\\';\'), $pun_repository_ext[\'dependencies\'][\'unresolved\'])), \'</p>
			</div>\';

	// Actions
	if (!empty($pun_repository_ext[\'options\']))
		echo \'
			<p class="options">\', implode(\' \', $pun_repository_ext[\'options\']), \'</p>\';

?>
		</div>
<?php

}

?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $lang_pun_repository[\'Files mode and owner\'] ?></p>
		</div>
<?php

if (empty($pun_repository_parsed) && (count($pun_repository_skipped[\'installed\']) > 0 || count($pun_repository_skipped[\'has_dir\']) > 0))
{
	($hook = get_hook(\'pun_repository_no_extensions\')) ? eval($hook) : null;

	?>
		<div class="ct-box info-box">
			<p class="warn"><?php echo $lang_pun_repository[\'All installed or downloaded\'] ?></p>
		</div>
	<?php

}

($hook = get_hook(\'pun_repository_after_ext_list\')) ? eval($hook) : null;

?>
	</div>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aex_new_action' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Clear pun_repository cache
if (isset($_GET[\'pun_repository_update\']))
{
	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_update\')))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	@unlink(FORUM_CACHE_DIR.\'cache_pun_repository.php\');
	if (file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
		message($lang_pun_repository[\'Unable to remove cached file\'], \'\', $lang_pun_repository[\'PunBB Repository\']);

	redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Cache has been successfully cleared\']);
}

if (isset($_GET[\'pun_repository_download_and_install\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_install\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_install_\'.$ext_id)))
		csrf_confirm_form();

	// TODO: Should we check again for unresolved dependencies here?

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	($hook = get_hook(\'pun_repository_download_and_install_start\')) ? eval($hook) : null;

	// Download extension
	$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data);

	if ($pun_repository_error == \'\')
	{
		if (empty($ext_data))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Validate manifest
		$errors = validate_manifest($ext_data, $ext_id);
		if (!empty($errors))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Everything is OK. Start installation.
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_install_end\')) ? eval($hook) : null;
}

// Handling the download and update extension action
if (isset($_GET[\'pun_repository_download_and_update\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_update\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_update_\'.$ext_id)))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	$pun_repository_error = \'\';

	($hook = get_hook(\'pun_repository_download_and_update_start\')) ? eval($hook) : null;

	pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\');

	// Check dependancies
	$query = array(
		\'SELECT\'	=> \'e.id\',
		\'FROM\'		=> \'extensions AS e\',
		\'WHERE\'		=> \'e.disabled=0 AND e.dependencies LIKE \\\'%|\'.$forum_db->escape($ext_id).\'|%\\\'\'
	);

	($hook = get_hook(\'aex_qr_get_disable_dependencies\')) ? eval($hook) : null;
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	if ($forum_db->num_rows($result) != 0)
	{
		$dependency = $forum_db->fetch_assoc($result);
		$pun_repository_error = sprintf($lang_admin[\'Disable dependency\'], $dependency[\'id\']);
	}

	if ($pun_repository_error == \'\' && ($ext_id != $ext_info[\'id\']))
	{
		// Disable extension
		$query = array(
			\'UPDATE\'	=> \'extensions\',
			\'SET\'		=> \'disabled=1\',
			\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
		);

		($hook = get_hook(\'aex_qr_update_disabled_status\')) ? eval($hook) : null;
		$forum_db->query_build($query) or error(__FILE__, __LINE__);

		// Regenerate the hooks cache
		require_once FORUM_ROOT.\'include/cache.php\';
		generate_hooks_cache();
	}

	if ($pun_repository_error == \'\')
	{
		if ($ext_id == $ext_info[\'id\'])
		{
			// Hey! That\'s me!
			// All the necessary files should be included before renaming old directory
			// NOTE: Self-updating is to be tested more in real-life conditions
			if (!defined(\'PUN_REPOSITORY_TAR_EXTRACT_INCLUDED\'))
				require $ext_info[\'path\'].\'/pun_repository_tar_extract.php\';
		}

		$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data, FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\'); // Download the extension

		if ($pun_repository_error == \'\')
		{
			if (is_writable(FORUM_ROOT.\'extensions/\'.$ext_id))
				pun_repository_dir_copy(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new/\'.$ext_id, FORUM_ROOT.\'extensions/\'.$ext_id);
			else
				$pun_repository_error = sprintf($lang_pun_repository[\'Copy fail\'], FORUM_ROOT.\'extensions/\'.$ext_id);
		}
	}

	if ($pun_repository_error == \'\')
	{
		// Do we have extension data at all? :-)
		if (empty($ext_data))
			$errors = array(true);

		// Validate manifest
		if (empty($errors))
			$errors = validate_manifest($ext_data, $ext_id);

		if (!empty($errors))
			$pun_repository_error = $lang_pun_repository[\'Incorrect manifest.xml\'];
	}

	if ($pun_repository_error == \'\')
	{
		($hook = get_hook(\'pun_repository_download_and_update_ok\')) ? eval($hook) : null;

		// Everything is OK. Start installation.
		pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\');
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_update_error\')) ? eval($hook) : null;

	// Enable extension
	$query = array(
		\'UPDATE\'	=> \'extensions\',
		\'SET\'		=> \'disabled=0\',
		\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_update_enabled_status\')) ? eval($hook) : null;
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	// Regenerate the hooks cache
	require_once FORUM_ROOT.\'include/cache.php\';
	generate_hooks_cache();

	($hook = get_hook(\'pun_repository_download_and_update_end\')) ? eval($hook) : null;
}

// Do we have some error?
if (!empty($pun_repository_error))
{
	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
		array($lang_admin_common[\'Extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		array($lang_admin_common[\'Manage extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		$lang_pun_repository[\'PunBB Repository\']
	);

	($hook = get_hook(\'pun_repository__pre_header_load\')) ? eval($hook) : null;

	define(\'FORUM_PAGE_SECTION\', \'extensions\');
	define(\'FORUM_PAGE\', \'admin-extensions-pun-repository\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	($hook = get_hook(\'pun_repository_display_error_output_start\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content">
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
	</div>
<?php

	($hook = get_hook(\'pun_repository_display_error_pre_ob_end\')) ? eval($hook) : null;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_manage_extensions_improved\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_manage_extensions_improved\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_manage_extensions_improved\',
\'dependencies\'	=> array (
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_GET[\'reinstall\']))
{
	$id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'reinstall\']);

	//include language file
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

	// We validate the CSRF token. If it\'s set in POST and we\'re at this point, the token is valid.
	// If it\'s in GET, we need to make sure it\'s valid.
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'reinstall\'.$id)))
		csrf_confirm_form();

	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
		$lang_admin_common[\'Manage extensions\']
	);

	if (isset($_POST[\'reinstall_cancel\']))
	{
		$display_group_buttons = true;
		include $ext_info[\'path\'].\'/extension_list.php\';
	}
	else
	{
		//Check for dependencies first
		$query = array(
			\'SELECT\'	=> \'e.id\',
			\'FROM\'		=> \'extensions AS e\',
			\'WHERE\'		=> \'e.disabled=0 AND e.dependencies LIKE \\\'%\'.$forum_db->escape($id).\'%\\\'\'
		);

		$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

		if ($forum_db->num_rows($result))
		{
			$dependency = $forum_db->fetch_assoc($result);
			$head_notice = sprintf($lang_pun_man_ext_improved[\'Reinstall ext\'], $id);
			$important_message = sprintf($lang_pun_man_ext_improved[\'Reinstall with deps\'], $dependency[\'id\'], \'"\'.$id.\'"\');
			$type = \'reinstall\';
			$handle = $base_url.\'/admin/extensions.php?section=manage&amp;reinstall=\'.$id;
		
			include  $ext_info[\'path\'].\'/continue.php\';	
		}
	}

	// Fetch info about the extension
	$query = array(
		\'SELECT\'	=> \'e.title, e.version, e.description, e.author, e.uninstall, e.uninstall_note\',
		\'FROM\'		=> \'extensions AS e\',
		\'WHERE\'		=> \'e.id=\\\'\'.$forum_db->escape($id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_get_extension\')) ? eval($hook) : null;

	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	if (!$forum_db->num_rows($result))
		message($lang_common[\'Bad request\']);

	$old_ext_data = $forum_db->fetch_assoc($result);

	// Load manifest (either locally or from punbb.informer.com updates service)
	if (strpos($id, \'hotfix_\') === 0)
		$manifest = @end(get_remote_file(\'http://punbb.informer.com/update/manifest/\'.$id.\'.xml\', 16));
	else
		$manifest = @file_get_contents(FORUM_ROOT.\'extensions/\'.$id.\'/manifest.xml\');

	// Parse manifest.xml into an array and validate it
	$ext_data = xml_to_array($manifest);
	$errors = validate_manifest($ext_data, $id);

	if (!isset($_POST[\'reinstall_continue\']) && isset($_GET[\'only_hoks\']) && version_compare($ext_data[\'extension\'][\'version\'], $old_ext_data[\'version\'], \'>\'))
	{
		//Show continue page
		$important_message = sprintf($lang_pun_man_ext_improved[\'Update error\'], $id);
		$head_notice = $lang_pun_man_ext_improved[\'Ext update\'];
		$type = \'reinstall\';
		$handle = $base_url.\'/admin/extensions.php?section=manage&amp;multy&amp;only_hoks&amp;reinstall=\'.$id;

		include $ext_info[\'path\'].\'/continue.php\';
	}
	if (!empty($errors))
		message(isset($_GET[\'install\']) ? $lang_common[\'Bad request\'] : $lang_admin_common[\'Hotfix download failed\']);

	// Is there some uninstall code to store in the db?
	$uninstall_code = (isset($ext_data[\'extension\'][\'uninstall\']) && trim($ext_data[\'extension\'][\'uninstall\']) != \'\') ? \'\\\'\'.$forum_db->escape(trim($ext_data[\'extension\'][\'uninstall\'])).\'\\\'\' : \'NULL\';

	// Is there an uninstall note to store in the db?
	$uninstall_note = \'NULL\';
	foreach ($ext_data[\'extension\'][\'note\'] as $cur_note)
	{
		if ($cur_note[\'attributes\'][\'type\'] == \'uninstall\' && trim($cur_note[\'content\']) != \'\')
			$uninstall_note = \'\\\'\'.$forum_db->escape(trim($cur_note[\'content\'])).\'\\\'\';
	}
	// Run uninstall + install only if all previous steps are OK

	
	// Run uninstall code
	if (!isset($_GET[\'only_hoks\'])){
		$last_ext_info = $ext_info;
		// Prevent errors when include files in the uninstall section
		$ext_info = array(\'path\' => FORUM_ROOT.\'extensions/\'.$id);
		eval($old_ext_data[\'uninstall\']);
		$ext_info = $last_ext_info;
	}

	// Now delete the extension and its hooks from the db
	$query = array(
		\'DELETE\'	=> \'extension_hooks\',
		\'WHERE\'		=> \'extension_id = \\\'\'.$forum_db->escape($id).\'\\\'\'
	);
	
	($hook = get_hook(\'aex_qr_uninstall_delete_hooks\')) ? eval($hook) : null;
	
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	$query = array(
		\'DELETE\'	=> \'extensions\',
		\'WHERE\'	 => \'id = \\\'\'.$forum_db->escape($id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_delete_extension\')) ? eval($hook) : null;

	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	require_once $ext_info[\'path\'].\'/functions.php\';

	regenerate_glob_vars();

	// Run the author supplied install code
	if (isset($ext_data[\'extension\'][\'install\']) && trim($ext_data[\'extension\'][\'install\']) != \'\' && !isset($_GET[\'only_hoks\'])) {
		$last_ext_info = $ext_info;
		// Prevent errors when include files in the install section
		$ext_info = array(\'path\' => FORUM_ROOT.\'extensions/\'.$id);
		eval($ext_data[\'extension\'][\'install\']);
		$ext_info = $last_ext_info;
	}

	// Make sure we have an array of dependencies
	if (!isset($ext_data[\'extension\'][\'dependencies\']))
		$ext_data[\'extension\'][\'dependencies\'] = array();
	else if (!is_array(current($ext_data[\'extension\'][\'dependencies\'])))
		$ext_data[\'extension\'][\'dependencies\'] = array($ext_data[\'extension\'][\'dependencies\'][\'dependency\']);
	else
		$ext_data[\'extension\'][\'dependencies\'] = $ext_data[\'extension\'][\'dependencies\'][\'dependency\'];

	// Add the new extension
	$query = array(
		\'INSERT\'	=> \'id, title, version, description, author, uninstall, uninstall_note, dependencies\',
		\'INTO\'		=> \'extensions\',
		\'VALUES\'	=> \'\\\'\'.$forum_db->escape($ext_data[\'extension\'][\'id\']).\'\\\', \\\'\'.$forum_db->escape($ext_data[\'extension\'][\'title\']).\'\\\', \\\'\'.$forum_db->escape($ext_data[\'extension\'][\'version\']).\'\\\', \\\'\'.$forum_db->escape($ext_data[\'extension\'][\'description\']).\'\\\', \\\'\'.$forum_db->escape($ext_data[\'extension\'][\'author\']).\'\\\', \'.$uninstall_code.\', \'.$uninstall_note.\', \\\'|\'.implode(\'|\', $ext_data[\'extension\'][\'dependencies\']).\'|\\\'\',
	);
	
	($hook = get_hook(\'aex_qr_add_ext\')) ? eval($hook) : null;
	
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	// Now insert the hooks
	foreach ($ext_data[\'extension\'][\'hooks\'][\'hook\'] as $ext_hook)
	{
		$cur_hooks = explode(\',\', $ext_hook[\'attributes\'][\'id\']);
		foreach ($cur_hooks as $cur_hook)
		{
			$query = array(
				\'INSERT\'	=> \'id, extension_id, code, installed, priority\',
				\'INTO\'		=> \'extension_hooks\',
				\'VALUES\'	=> \'\\\'\'.$forum_db->escape(trim($cur_hook)).\'\\\', \\\'\'.$forum_db->escape($id).\'\\\', \\\'\'.$forum_db->escape(trim($ext_hook[\'content\'])).\'\\\', \'.time().\', \'.(isset($ext_hook[\'attributes\'][\'priority\']) ? $ext_hook[\'attributes\'][\'priority\'] : 5)
			);
			
			($hook = get_hook(\'aex_qr_add_hook\')) ? eval($hook) : null;
			
			$forum_db->query_build($query) or error(__FILE__, __LINE__);
		}
	}

	// Refresh system after install

	regenerate_glob_vars();

	// Regenerate the hooks cache
	require_once FORUM_ROOT.\'include/cache.php\';
	generate_config_cache();
	generate_hooks_cache();

	$display_group_buttons = true;

	include $ext_info[\'path\'].\'/extension_list.php\';
}

$display_group_buttons = true;

if (isset($_GET[\'multy\']) && (isset($_POST[\'disable_selected\']) || isset($_POST[\'enable_selected\']) || isset($_POST[\'uninstall_selected\'])) && (!isset($_POST[\'extens\']) || !is_array(array_keys($_POST[\'extens\'])) || array_keys($_POST[\'extens\']) == array()))
	$no_selected_extensions = true;
else if (isset($_GET[\'multy\']))
{
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

	if ((isset($_GET[\'disable_sel\']) || isset($_GET[\'enable_sel\']) || isset($_GET[\'uninstall_sel\'])) && (!isset($_POST[\'selected_extens\']) || !is_scalar($_POST[\'selected_extens\']))) {
		$forum_flash->add_info($lang_pun_man_ext_improved[\'Input error\']);
		redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_pun_man_ext_improved[\'Input error\']);
	}

	if (!isset($_POST[\'csrf_token\']))
		csrf_confirm_form();

	require_once $ext_info[\'path\'].\'/functions.php\';
	
	//Working with list of selected extensions
	$sel_extens = validate_ext_list(isset($_POST[\'extens\']) ? array_keys($_POST[\'extens\']) : explode(\',\', $_POST[\'selected_extens\']));
	if (empty($sel_extens))
		$no_selected_extensions = true;
	else
	{
		$selected_key = is_key_exists($_POST, array(\'disable_selected\', \'enable_selected\', \'uninstall_selected\'));
		if ($selected_key)
		{
			$type = substr($selected_key, 0, -9);
			eval(\'$dependencies_error = get_dependencies_error_\'.$type.\'($sel_extens);\');
			if (!empty($dependencies_error))
				$continue_page = true;
			else
			{
				switch ($type)
				{
					case \'enable\':
						flip_extensions(\'0\', $sel_extens);
						break;
					case \'disable\':
						flip_extensions(\'1\', $sel_extens);
						break;
					case \'uninstall\':
						uninstall_extensions($sel_extens);
						$forum_flash->add_info($lang_pun_man_ext_improved[\'Uninstall selected\']);
						redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_pun_man_ext_improved[\'Uninstall selected\']);
						break;
				}
			}
		}
		//Continue disable selected
		else if (isset($_GET[\'disable_sel\']) && isset($_POST[\'disable_continue\']))
		{
			if (!isset($_POST[\'disable_type\']) || ($_POST[\'disable_type\'] != 0 && $_POST[\'disable_type\'] != 1))
				message($lang_common[\'Bad request\']);

			if ($_POST[\'disable_type\'] == 0)
				flip_extensions(\'1\', $sel_extens);
			else
			{
				flip_extensions(\'1\', $sel_extens);
				$dependencies_error = get_dependencies_error_disable($sel_extens);
				if (!empty($dependencies_error))
				{
					$disable_dep_exts = array();
					foreach ($dependencies_error as $dep_ext => $main_exts)
					{
						if (!in_array($dep_ext, $sel_extens) && array_intersect($main_exts, $sel_extens) != array())
							$disable_dep_exts[] = $dep_ext;
					}
					flip_extensions(\'1\', $disable_dep_exts);
				}
			}

			$forum_flash->add_info($lang_pun_man_ext_improved[\'Disable selected\']);
			redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_pun_man_ext_improved[\'Disable selected\']);
		}
		//Continue enable selected
		else if (isset($_GET[\'enable_sel\']) && isset($_POST[\'enable_continue\']))
		{
			if (!isset($_POST[\'enable_type\']) || ($_POST[\'enable_type\'] != 0 && $_POST[\'enable_type\'] != 1))
				message($lang_common[\'Bad request\']);

			if (!$_POST[\'enable_type\'])
				flip_extensions(\'0\', $sel_extens);
			else
			{
				flip_extensions(\'0\', $sel_extens);
				$dependencies_error = get_dependencies_error_enable($sel_extens);
				if (!empty($dependencies_error))
				{
					$disable_dep_exts = array();
					foreach ($dependencies_error as $dep_ext => $main_exts)
					{
						foreach ($main_exts as $ext)
							$disable_dep_exts[] = $ext;
					}
					flip_extensions(\'0\', array_unique($disable_dep_exts));
				}
			}
			$forum_flash->add_info($lang_pun_man_ext_improved[\'Enable selected\']);
			redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_pun_man_ext_improved[\'Enable selected\']);
		}
		//Continue uninstall selected
		else if (isset($_GET[\'uninstall_sel\']) && isset($_POST[\'uninstall_continue\']))
		{
			if (!isset($_POST[\'uninstall_type\']) || !in_array($_POST[\'uninstall_type\'], array(0, 1, 2)))
				message($lang_common[\'Bad request\']);

			if ($_POST[\'uninstall_type\'] == 0)
				uninstall_extensions( $sel_extens );
			else if ($_POST[\'uninstall_type\'] == 1 || $_POST[\'uninstall_type\'] == 2)
			{
				uninstall_extensions($sel_extens);
				$dependencies_error = get_dependencies_error_uninstall($sel_extens);

				if ($_POST[\'uninstall_type\'] == 1)
					flip_extensions(\'1\', array_keys($dependencies_error));
				else
					uninstall_extensions(array_keys($dependencies_error));
			}

			$forum_flash->add_info($lang_pun_man_ext_improved[\'Uninstall selected\']);
			redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_pun_man_ext_improved[\'Uninstall selected\']);
		}
	}

	if (isset($continue_page))
	{
		$display_group_buttons = false;
		include $ext_info[\'path\'].\'/continue.php\';
	}
}
if ($section == \'manage\')
	include $ext_info[\'path\'].\'/extension_list.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'manage_tags\')
			{
				//Get some info about topics with tags
				$topic_info = array();
				if (!empty($pun_tags[\'topics\']))
				{
					$pun_tags_query = array(
						\'SELECT\'	=>	\'id, subject\',
						\'FROM\'		=>	\'topics\',
						\'WHERE\'		=>	\'id IN (\'.implode(\',\', array_keys($pun_tags[\'topics\'])).\')\'
					);
					$pun_tags_result = $forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
					while ($cur_topic = $forum_db->fetch_assoc($pun_tags_result))
						$topic_info[$cur_topic[\'id\']] = $cur_topic[\'subject\'];
				}

				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/pun_tags_url.php\';

				if (isset($_POST[\'change_tags\']) && !empty($_POST[\'line_tags\']) && !empty($pun_tags[\'topics\']))
				{
					foreach ($_POST[\'line_tags\'] as $topic_id => $tag_line)
					{
						if (intval($topic_id) < 1)
							break;
						$cur_tags_new = pun_tags_parse_string(utf8_trim($tag_line));

						//All tags was removed?
						if (empty($cur_tags_new))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
							continue;
						}

						//Collect old tags
						$cur_tags_old = array();
						if (!empty($pun_tags[\'topics\'][$topic_id]))
						{
							foreach ($pun_tags[\'topics\'][$topic_id] as $old_tag_id)
								$cur_tags_old[$old_tag_id] = $pun_tags[\'index\'][$old_tag_id];
						}
						//Nothing changed
						if (implode(\', \', $cur_tags_new) == implode(\', \', array_values($cur_tags_old)))
							continue;
						//This array contain indexes of processed new tags
						$processed_tags = array();
						//The array with tags for removal
						$remove_tags_id = array();
						foreach ($cur_tags_old as $tag_old_id => $tag_old)
						{
							$srch_index = array_search($tag_old, $cur_tags_new);
							//Tag was not changed
							if ($srch_index !== FALSE)
							{
								$processed_tags[] = $srch_index;
								continue;
							}

							//Was tag edited?
							$not_found_edited = TRUE;
							foreach ($cur_tags_new as $cur_tag_new)
							{
								if (strcasecmp($cur_tag_new, $tag_old) == 0)
								{
									$not_found_edited = FALSE;
									$edited_tag_id = $tag_old_id;
									$edited_tag = $cur_tag_new;
									break;
								}
							}

							//Tag removed?
							if ($not_found_edited)
							{
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
							else
							{
								//Is this tag already persist in the tag list?
								$edited_tag_id_new = tag_cache_index($edited_tag);
								if ($edited_tag_id_new !== FALSE)
								{
									$pun_tags_query = array(
										\'UPDATE\'	=>	\'topic_tags\',
										\'SET\'		=>	\'tag_id = \'.$edited_tag_id_new,
										\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id = \'.$edited_tag_id
									);
									$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
								}
								else
									pun_tags_add_new($edited_tag, $topic_id);

								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
						}

						//Is there some new tags
						if (count($processed_tags) != count($cur_tags_new))
						{
							foreach ($cur_tags_new as $cur_new_tag_id => $cur_new_tag)
							{
								if (in_array($cur_new_tag_id, $processed_tags))
									continue;
								$tag_exist_index = tag_cache_index($cur_new_tag);
								if ($tag_exist_index === FALSE)
									pun_tags_add_new($cur_new_tag, $topic_id);
								else
									pun_tags_add_existing_tag($tag_exist_index, $topic_id);
							}
						}

						if (!empty($remove_tags_id))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id IN (\'.implode(\',\', $remove_tags_id).\')\'
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						}
					}
					pun_tags_remove_orphans();
					pun_tags_generate_cache();

					$forum_flash->add_info($lang_pun_tags[\'Redirect with changes\']);

					redirect(forum_link($pun_tags_url[\'Section pun_tags\']), $lang_pun_tags[\'Redirect with changes\']);
				}

				$forum_page[\'form_action\'] = forum_link($pun_tags_url[\'Section tags\']);
				$forum_page[\'item_count\'] = 1;

				$forum_page[\'table_header\'] = array();
				$forum_page[\'table_header\'][\'name\'] = \'<th class="tc1" scope="col">\'.$lang_pun_tags[\'Name topic\'].\'</th>\';
				$forum_page[\'table_header\'][\'tags\'] = \'<th class="tc2" scope="col">\'.$lang_pun_tags[\'Tags of topic\'].\'</th>\';

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Management\'], forum_link($forum_url[\'admin_reports\'])),
					array($lang_pun_tags[\'Section tags\'], forum_link($pun_tags_url[\'Section tags\']))
				);

				define(\'FORUM_PAGE_SECTION\', \'management\');
				define(\'FORUM_PAGE\', \'admin-management-manage_tags\');
				require FORUM_ROOT.\'header.php\';

				ob_start();

				if (!empty($topic_info))
				{
					// Load the userlist.php language file
					if (file_exists(FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\'))
						require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\';
					else
						require FORUM_ROOT.\'lang/English/userlist.php\';

					?>
					<div class="main-subhead">
						<h2 class="hn">
							<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
						</h2>
					</div>
					<div class="main-content main-forum">
						<form class="frm-form" id="afocus" method="post" accept-charset="utf-8" action="<?php echo $forum_page[\'form_action\'] ?>">
							<div class="hidden">
								<input type="hidden" name="form_sent" value="1" />
								<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($forum_page[\'form_action\']) ?>" />
							</div>
							<div class="ct-group">
								<table id="pun_tags_table" summary="<?php echo $lang_ul[\'Table summary\'] ?>">
									<thead>
										<tr><?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'table_header\'])."\\n" ?></tr>
									</thead>
									<tbody>
									<?php
										foreach ($topic_info as $topic_id => $topic_subject)
										{
											$tags_arr = $pun_tags[\'topics\'][$topic_id];
											$cur_tags_arr = array();
											foreach ($tags_arr as $tag_id)
												$cur_tags_arr[] = $pun_tags[\'index\'][$tag_id];

											?>
												<tr class="<?php echo ($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\' ?><?php echo ($forum_page[\'item_count\'] == 1) ? \' row1\' : \'\' ?>">
													<td class="tc0" scope="col"><a class="permalink" rel="bookmark" href="<?php echo forum_link($forum_url[\'topic\'], $topic_id) ?>"><?php echo forum_htmlencode($topic_subject) ?></a></td>
													<td class="tc1" scope="col"><input id="fld<?php echo $forum_page[\'item_count\']; ?>" type="text" value="<?php echo forum_htmlencode(implode(\', \', $cur_tags_arr)) ?>" name="line_tags[<?php echo $topic_id; ?>]"/></td>
												</tr>
											<?php
										}
									?>
									</tbody>
								</table>
							</div>
							<div class="frm-buttons">
								<span class="submit"><input type="submit" name="change_tags" value="<?php echo $lang_pun_tags[\'Submit changes\'] ?>" /></span>
							</div>
						</form>
					</div>
					<?php
				}
				else
				{
					?>
						<div class="main-subhead">
							<h2 class="hn">
								<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
							</h2>
						</div>
						<div class="main-content main-forum">
							<div class="ct-box">
								<h3 class="hn"><span><?php echo $lang_pun_tags[\'No tags\']; ?></span></h3>
							</div>
						</div>

					<?php
				}

				$tpl_pun_tags = trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_pun_tags, $tpl_main);
				ob_end_clean();

				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aex_section_manage_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	if (pun_repository_generate_cache($pun_repository_error))
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aex_section_manage_pre_ext_actions' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && isset($pun_repository_extensions[$id]) && version_compare($ext[\'version\'], $pun_repository_extensions[$id][\'version\'], \'<\') && is_writable(FORUM_ROOT.\'extensions/\'.$id))
{
	// Check for unresolved dependencies
	if (isset($pun_repository_extensions[$id][\'dependencies\']))
		$pun_repository_extensions[$id][\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_extensions[$id][\'dependencies\']);

	if (empty($pun_repository_extensions[$id][\'dependencies\'][\'unresolved\']))
		$forum_page[\'ext_actions\'][] = \'<span><a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_update=\'.$id.\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_update_\'.$id).\'">\'.$lang_pun_repository[\'Download and update\'].\'</a></span>\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'co_common' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			define(\'PUN_TAGS_CACHE_UPDATE\', 12);
			require_once $ext_info[\'path\'].\'/functions.php\';

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			// Regenerate cache
			if ((!defined(\'PUN_TAGS_LOADED\') || $pun_tags[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			}

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			// Regenerate cache if the it is more than $pun_cache_period hours old
			if ((!defined(\'PUN_TAGS_GROUPS_PERMS\') || $pun_tags_groups_perms[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_forum_perms_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'es_essentials' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

define(\'PUN_JQUERY_INCLUDE_METHOD_LOCAL\', 0);
			define(\'PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN\', 1);
			define(\'PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN\', 2);
			define(\'PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN\', 3);

			define(\'PUN_JQUERY_VERSION\', \'1.7.1\');

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aop_features_gzip_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_pun_jquery)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			// Reset counter
			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo sprintf($lang_pun_jquery[\'Setup jquery\'], PUN_JQUERY_VERSION) ?></span></h2>
			</div>

			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><strong><?php echo sprintf($lang_pun_jquery[\'Setup jquery legend\'], PUN_JQUERY_VERSION) ?></strong></legend>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_jquery[\'Include method\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_LOCAL; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_LOCAL) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method local label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method google label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method microsoft label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method jquery label\'] ?></label>
						</div>
					</div>
				</fieldset>
			</fieldset>

<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aop_features_validation' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($form[\'pun_jquery_include_method\']))
			{
				$form[\'pun_jquery_include_method\'] = intval($form[\'pun_jquery_include_method\'], 10);
				if (($form[\'pun_jquery_include_method\'] < PUN_JQUERY_INCLUDE_METHOD_LOCAL) || ($form[\'pun_jquery_include_method\'] > PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN))
				{
					$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
				}
			}
			else
			{
				$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($form[\'pun_tags_show\']) || $form[\'pun_tags_show\'] != \'1\')
				$form[\'pun_tags_show\'] = \'0\';
			if (isset($form[\'pun_tags_count_in_cloud\']) && !empty($form[\'pun_tags_count_in_cloud\']) && intval($form[\'pun_tags_count_in_cloud\']) > 0)
				$form[\'pun_tags_count_in_cloud\'] = intval($form[\'pun_tags_count_in_cloud\']);
			else
				$form[\'pun_tags_count_in_cloud\'] = 25;
			if (isset($form[\'pun_tags_separator\']) && !empty($form[\'pun_tags_separator\']))
				$form[\'pun_tags_separator\'] = $form[\'pun_tags_separator\'];
			else
				$form[\'pun_tags_separator\'] = \' \';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';


			if (!isset($form[\'pun_poll_enable_read\']) || $form[\'pun_poll_enable_read\'] != \'1\') $form[\'pun_poll_enable_read\'] = \'0\';
			if (!isset($form[\'pun_poll_enable_revote\']) || $form[\'pun_poll_enable_revote\'] != \'1\') $form[\'pun_poll_enable_revote\'] = \'0\';

			$form[\'pun_poll_max_answers\'] = intval($form[\'pun_poll_max_answers\']);

			if ($form[\'pun_poll_max_answers\'] > 100)
				$form[\'pun_poll_max_answers\'] = 100;

			if ($form[\'pun_poll_max_answers\'] < 2)
				$form[\'pun_poll_max_answers\'] = 2;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aex_section_manage_output_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_manage_extensions_improved\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_manage_extensions_improved\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_manage_extensions_improved\',
\'dependencies\'	=> array (
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'fld_count\'] = 0;
			if (isset($_POST[\'selected_extens\']))
				$sel_extens = explode(\',\', $_POST[\'selected_extens\']);
			else
				$sel_extens = array();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_edit_group_flood_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
				<div class="content-head">
					<h3 class="hn"><span><?php echo $lang_pun_tags[\'Permissions\']; ?></span></h3>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_tags[\'Create tags perms\']; ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="pun_tags_allow" value="1"<?php if ($group[\'g_pun_tags_allow\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_tags[\'Name check\']; ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_edit_end_qr_update_group' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_tags_allow = isset($_POST[\'pun_tags_allow\']) ? intval($_POST[\'pun_tags_allow\']) : \'0\';
			$query[\'SET\'] .= \', g_pun_tags_allow=\'.$pun_tags_allow;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
				$query[\'SET\'] .= \', link_color = \\\'\'.$forum_db->escape($link_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', link_color = NULL\';
			if (!empty($hover_color))
				$query[\'SET\'] .= \', hover_color = \\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', hover_color = NULL\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SET\'] .= \', g_poll_add=\'.((isset($_POST[\'poll_add\']) && $_POST[\'poll_add\'] == \'1\') ? 1 : 0);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'hd_main_elements' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//Output of search results
			if ($forum_config[\'o_pun_tags_show\'] == \'1\' && in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$output_results = array();
				switch (FORUM_PAGE)
				{
					case \'index\':
						if (isset($pun_tags[\'forums\']))
						{
							foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
							{
								//Can user read this forum?
								if (in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]))
								{
									foreach ($tags_list as $tag_id => $tag_weight)
										if (!isset($output_results[$tag_id]))
											$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
										else
											$output_results[$tag_id][\'weight\'] += $tag_weight;
								}
							}
						}
						break;

					case \'viewforum\':
						if (isset($pun_tags[\'forums\'][$id]))
						{
							foreach ($pun_tags[\'forums\'][$id] as $tag_id => $tag_weight)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $id && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;

					case \'viewtopic\':
						if (isset($pun_tags[\'topics\'][$id]))
						{
							foreach ($pun_tags[\'topics\'][$id] as $tag_id)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $pun_tags[\'forums\'][$cur_topic[\'forum_id\']][$tag_id]);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $cur_topic[\'forum_id\'] && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;

					case \'searchtopics\':
					case \'searchposts\':
						//This string will be replaced after getting search results
						$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags"></div>\';
						break;
				}

				if (!empty($output_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($output_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($output_results, \'compare_tags\');
					$output_results = array_tags_slice($output_results);
					$results = array();
					foreach ($output_results as $tag_id => $tag_info)
					{
						$results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					}
					$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags"><ul>\'.implode($forum_config[\'o_pun_tags_separator\'], $results).\'</ul></div>\';
					unset($minfontsize, $maxfontsize, $step, $results, $min_pop, $max_pop);
				}
				unset($output_results, $tags_weights);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'co_modify_url_scheme' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    're_rewrite_rules' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1\';
			$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)[\\/_-]p(age)?[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1&p=$3\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'se_results_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'tag\')
			{
				// Regenerate paging links
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id >= 1)
					$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'search_tag\'], $lang_common[\'Paging separator\'], $tag_id).\'</p>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aop_features_avatars_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
			<div class="content-head">
				<h2 class="hn">
					<span><?php echo $lang_pun_tags[\'Pun Tags\']; ?></span>
				</h2>
			</div>
			<fieldset class="frm-group group1">
				<legend class="group-legend">
					<span><?php echo $lang_pun_tags[\'Settings\']; ?></span>
				</legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" <?php if ($forum_config[\'o_pun_tags_show\'] == \'1\') echo \' checked="checked"\' ?> value="1" name="form[pun_tags_show]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Show Pun Tags\']; ?></span>
							<?php echo $lang_pun_tags[\'Pun Tags notice\']; ?>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_count_in_cloud\']; ?>" maxlength="6" size="6" name="form[pun_tags_count_in_cloud]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Tags count\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Tags count info\']; ?></small>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_separator\']; ?>" maxlength="10" size="6" name="form[pun_tags_separator]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Separator\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Separator info\']; ?></small>
						</label>
					</div>
				</div>
			</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
				<div class="content-head">
					<h2 class="hn"><span><?php echo $lang_pun_poll[\'Name plugin\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group1">
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_revote]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_revote\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Disable revoting info\'] ?></span>
								<?php echo $lang_pun_poll[\'Disable revoting\'] ?>
							</label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_read]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_read\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Disable see results\'] ?></span>
								<?php echo $lang_pun_poll[\'Disable see results info\'] ?>
							</label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Maximum answers info\'] ?></span>
								<small><?php echo $lang_pun_poll[\'Maximum answers\'] ?></small>
							</label>
							</br>
							<span class="fld-input">
								<input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="form[pun_poll_max_answers]" size="6" maxlength="6" value="<?php echo $forum_config[\'p_pun_poll_max_answers\'] ?>"/>
							</span>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'hd_head' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\', \'admin-management-manage_tags\')))
			{
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/style/\'.$forum_user[\'style\'].\'/pun_tags.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'/pun_tags.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/style/Oxygen/pun_tags.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				require FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\';
				$forum_loader->add_css($pun_colored_usergroups_cache, array(\'type\' => \'inline\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'] && ((FORUM_PAGE == \'viewtopic\' && $forum_config[\'o_quickpost\']) || in_array(FORUM_PAGE, array(\'post\', \'postedit\', \'pun_pm-write\', \'pun_pm-inbox\', \'pun_pm-compose\'))))
			{
				if (!defined(\'FORUM_PARSER_LOADED\'))
					require FORUM_ROOT.\'include/parser.php\';

				// Load CSS
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));

				// CSS for disabled JS hide bar
				$forum_loader->add_css(\'#pun_bbcode_bar { display: none; }\', array(\'type\' => \'inline\', \'noscript\' => true));

				// Load JS
				$forum_loader->add_js(\'PUNBB.pun_bbcode=(function(){return{init:function(){return true;},insert_text:function(d,h){var g,f,e=(document.all)?document.all.req_message:((document.getElementById("afocus")!==null)?(document.getElementById("afocus").req_message):(document.getElementsByName("req_message")[0]));if(!e){return false;}if(document.selection&&document.selection.createRange){e.focus();g=document.selection.createRange();g.text=d+g.text+h;e.focus();}else{if(e.selectionStart||e.selectionStart===0){var c=e.selectionStart,b=e.selectionEnd,a=e.scrollTop;e.value=e.value.substring(0,c)+d+e.value.substring(c,b)+h+e.value.substring(b,e.value.length);if(d.charAt(d.length-2)==="="){e.selectionStart=(c+d.length-1);}else{if(c===b){e.selectionStart=b+d.length;}else{e.selectionStart=b+d.length+h.length;}}e.selectionEnd=e.selectionStart;e.scrollTop=a;e.focus();}else{e.value+=d+h;e.focus();}}}};}());PUNBB.common.addDOMReadyEvent(PUNBB.pun_bbcode.init);\', array(\'type\' => \'inline\'));

				($hook = get_hook(\'pun_bbcode_styles_loaded\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_end_validation' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && isset($_POST[\'update_poll\']) && empty($errors))	{
				$new_poll_ans_count = isset($_POST[\'poll_ans_count\']) && intval($_POST[\'poll_ans_count\']) > 0 ? intval($_POST[\'poll_ans_count\']) : FALSE;

				if (!$new_poll_ans_count)
					$errors[] = $lang_pun_poll[\'Empty option count\'];

				if ($new_poll_ans_count < 2)
				{
					$errors[] = $lang_pun_poll[\'Min cnt options\'];
					$new_poll_ans_count = 2;
				}

				if ($new_poll_ans_count > $forum_config[\'p_pun_poll_max_answers\'])
				{
					$errors[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
					$new_poll_ans_count = $forum_config[\'p_pun_poll_max_answers\'];
				}

				$_POST[\'preview\'] = \'pun_poll\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_split_posts_form_submitted' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'fn_add_topic_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $new_tags, $pun_tags, $forum_user;

			// Add tags to DB
			if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
				foreach ($new_tags as $pun_tag)
				{
					$tag_id = array_search($pun_tag, $search_arr);
					if ($tag_id !== FALSE)
						pun_tags_add_existing_tag($tag_id, $new_tid);
					else
						pun_tags_add_new($pun_tag, $new_tid);
				}
				pun_tags_generate_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_split_posts_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				foreach ($new_tags as $pun_tag)
					pun_tags_add_new($pun_tag, $new_tid);
				pun_tags_generate_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'fn_delete_topic_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Remove topic tags
			pun_tags_remove_topic_tags($topic_id);
			pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_pre_post_edited' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				//Parse the string
				if (isset($_POST[\'pun_tags\']))
					$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));
				if (empty($new_tags))
				{
					if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						pun_tags_remove_topic_tags($cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}
				else
				{
					//Determine old tags
					$old_tags = array();
					if (!empty($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $old_tagid)
							$old_tags[$old_tagid] = $pun_tags[\'index\'][$old_tagid];
					}

					//Tags for removing
					$remove_tags = array_diff($old_tags, $new_tags);
					if (!empty($remove_tags))
					{
						$pun_tags_query = array(
							\'DELETE\'	=>	\'topic_tags\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'].\' AND tag_id IN (\'.implode(\',\', array_keys($remove_tags)).\')\'
						);
						$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						$update_cache = TRUE;
					}

					$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
					foreach ($new_tags as $tag)
					{
						//Have we current tag?
						if (in_array($tag, $old_tags))
							continue;
						$tag_id = array_search($tag, $search_arr);
						if ($tag_id === FALSE)
							pun_tags_add_new($tag, $cur_post[\'tid\']);
						else
							pun_tags_add_existing_tag($tag_id, $cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}

				if (!empty($update_cache))
				{
					pun_tags_remove_orphans();
					pun_tags_generate_cache();
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ca_fn_prune_qr_prune_subscriptions' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.$topic_ids.\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'acg_del_cat_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_delete_topics_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'afo_del_forum_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();
			require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_move_topics_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_delete_topics_qr_delete_topics' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_merge_topics_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query = array(
				\'UPDATE\'	=>	\'topic_tags\',
				\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\') AND topic_id != \'.$merge_to_tid
			);
			$forum_db->query_build($query) or error(__FILE__, __LINE__);
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($question_id) && $question_id != $merge_to_tid)
			{
				$query_poll = array(
					\'UPDATE\'	=>	\'questions\',
					\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
					\'WHERE\'		=>	\'topic_id = \'.$question_id
				);
				$forum_db->query_build($query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_confirm_split_posts_pre_confirm_checkbox' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid)
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$tid]))
				{

					foreach ($pun_tags[\'topics\'][$tid] as $tag_id)
						foreach ($pun_tags[\'index\'] as $tag)
							if ($tag[\'tag_id\'] == $tag_id)
								$res_tags[] = $tag[\'tag\'];
				}

				?>
				<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="70" maxlength="100"/></span>
				</div>
			<?php

			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'se_post_results_fetched' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($search_set))
			{
				//Array with tags id
				$tags = array();
				//Array with processed topics
				$processed_topics = array();
				foreach ($search_set as $res)
				{
					if (!isset($pun_tags[\'topics\'][$res[\'tid\']]) || in_array($res[\'tid\'], $processed_topics))
						continue;

					$processed_topics[] = $res[\'tid\'];
					$tags = array_merge($tags, array_diff($pun_tags[\'topics\'][$res[\'tid\']], $tags));
				}
				//Array with tags and weights
				$tags_results = array();
				if (!empty($tags))
				{
					//Calculation of tags weight
					foreach ($pun_tags_groups_perms[$forum_user[\'group_id\']] as $forum_id)
					{
						if (!isset($pun_tags[\'forums\'][$forum_id]))
							continue;
						//Calcullate common keys in arrays
						$tmp = array_intersect($tags, array_keys($pun_tags[\'forums\'][$forum_id]));
						foreach ($tmp as $cur_tag)
						{
							if (!isset($tags_results[$cur_tag]))
								$tags_results[$cur_tag] = array(\'tag\' => $pun_tags[\'index\'][$cur_tag], \'weight\' => $pun_tags[\'forums\'][$forum_id][$cur_tag]);
							else
								$tags_results[$cur_tag][\'weight\'] += $pun_tags[\'forums\'][$forum_id][$cur_tag];
						}
					}
					unset($tmp);
				}
				unset($tags);
				if (!empty($tags_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($tags_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($tags_results, \'compare_tags\');
					$tags_results = array_tags_slice($tags_results);
					$ouput_results = array();
					foreach ($tags_results as $tag_id => $tag_info)
						$ouput_results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					unset($minfontsize, $maxfontsize, $step, $tags_results, $min_pop, $max_pop);
				}
				unset($tags_results);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'sf_fn_generate_action_search_query_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'tag\')
			{
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id < 1)
					message($lang_common[\'Bad request\']);
				global $pun_tags;
				if (isset($pun_tags[\'topics\']))
				{
					foreach ($pun_tags[\'topics\'] as $topic_id => $tags)
						if (in_array($tag_id, $tags))
							$search_ids[] = $topic_id;
					if (empty($search_ids))
						message($lang_common[\'Bad request\']);
				}
				$query = array(
					\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
					\'FROM\'		=> \'topics AS t\',
					\'JOINS\'		=> array(
						array(
							\'INNER JOIN\'	=> \'forums AS f\',
							\'ON\'			=> \'f.id=t.forum_id\'
						),
						array(
							\'LEFT JOIN\'		=> \'forum_perms AS fp\',
							\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND t.id IN(\'.implode(\',\', $search_ids).\')\',
					\'ORDER BY\'	=> \'t.last_post DESC\'
				);
				// With "has posted" indication
				if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\')
				{
					$subquery = array(
						\'SELECT\'	=> \'COUNT(p.id)\',
						\'FROM\'		=> \'posts AS p\',
						\'WHERE\'		=> \'p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id\'
					);

					$query[\'SELECT\'] .= \', (\'.$forum_db->query_build($subquery, true).\') AS has_posted\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ft_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_pun_tags_show\'] == 1)
			{
				if (!empty($ouput_results))
					$tpl_main = str_replace(\'<div id="brd-pun_tags"></div>\', \'<div id="brd-pun_tags"><ul>\'.implode($forum_config[\'o_pun_tags_separator\'], $ouput_results).\'</ul></div>\', $tpl_main);
				else
					$tpl_main = str_replace(\'<div id="brd-pun_tags"></div>\', \'\', $tpl_main);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'sf_fn_validate_actions_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$valid_actions[] = \'tag\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'afo_save_forum_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'afo_revert_perms_form_submitted' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_edit_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
				require $ext_info[\'path\'].\'/main.php\';
			}
			cache_pun_coloured_usergroups();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_del_group_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ca_fn_generate_admin_menu_new_sublink' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require $ext_info[\'path\'].\'/pun_tags_url.php\';

			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_tags_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-management-manage_tags\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($pun_tags_url[\'Section pun_tags\']).\'">\'.$lang_pun_tags[\'Section tags\'].\'</a></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'in_users_online_qr_get_online_info' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', u.group_id\';
			$query[\'JOINS\'][] = array(
				\'LEFT JOIN\'	=> \'users AS u\',
				\'ON\'		=> \'u.id=o.user_id\'
			);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_edit_group_pre_basic_details_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\';
			else
					include $ext_info[\'path\'].\'/lang/English/pun_colored_usergroups.php\';
			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'link\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="link_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'link_color\']) ?>" /></span>
					</div>
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'hover\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="hover_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'hover_color\']) ?>" /></span>
					</div>
				</div>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_edit_end_validation' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$link_color = forum_trim($_POST[\'link_color\']);
			$hover_color = forum_trim($_POST[\'hover_color\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_end_qr_add_group' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
			{
				$query[\'INSERT\'] .= \', link_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($link_color).\'\\\'\';
			}

			if (!empty($hover_color))
			{
				$query[\'INSERT\'] .= \', hover_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'in_users_online_pre_online_info_output' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$users = array();
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			while ($forum_user_online = $forum_db->fetch_assoc($result))
			{
				if ($forum_user_online[\'user_id\'] > 1)
				{
					$users[] = ($forum_user[\'g_view_users\'] == \'1\') ? \'<span class="group_color_\'.$forum_user_online[\'group_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $forum_user_online[\'user_id\']).\'">\'.forum_htmlencode($forum_user_online[\'ident\']).\'</a></span>\' : forum_htmlencode($forum_user_online[\'ident\']);
				};
			};

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'in_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ul_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
        1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_add_user\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_add_user\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_add_user\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN)
			{
				$errors_add_users = array();
				if (isset($_POST[\'add_user_form_sent\']) && $_POST[\'add_user_form_sent\'] == 1)
				{
					$forum_extension[\'admin_add_user\'][\'user_added\'] = false;

					require_once FORUM_ROOT.\'include/functions.php\';
					require_once FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/profile.php\';

					$username = trim($_POST[\'req_username\']);
					$email = strtolower(trim($_POST[\'req_email\']));

					// Validate the username
					$errors_add_users = validate_username($username);

					// ... and the e-mail address
					require_once FORUM_ROOT.\'include/email.php\';

					if (!is_valid_email($email))
					   $errors_add_users[] = $lang_common[\'Invalid e-mail\'];

					// Check if it\'s a banned e-mail address
					$banned_email = is_banned_email($email);
					if ($banned_email && $forum_config[\'p_allow_banned_email\'] == \'0\')
						$errors_add_users[] = $lang_profile[\'Banned e-mail\'];

					// Check if someone else already has registered with that e-mail address
					$q = array(
						\'SELECT\'	=> \'COUNT(u.username)\',
						\'FROM\'	  	=> \'users AS u\',
						\'WHERE\'		=> \'u.email=\\\'\'.$forum_db->escape($email).\'\\\'\'
					);

					$result = $forum_db->query_build( $q ) or error(__FILE__, __LINE__);

					if (($forum_config[\'p_allow_dupe_email\'] == \'0\') && ($forum_db->result($result) > 0))
						$errors_add_users[] = $lang_profile[\'Dupe e-mail\'];

					if (empty($errors_add_users))
					{
						$salt = random_key(12);
						$password = random_key(8, true);
						$password_hash = sha1($salt.sha1($password));

						$errors = add_user(
							array(
								\'username\'				=> $username,
								\'group_id\'				=> ($forum_config[\'o_regs_verify\'] == \'0\') ? $forum_config[\'o_default_user_group\'] : FORUM_UNVERIFIED,
								\'salt\'					=> $salt,
								\'password\'				=> $password,
								\'password_hash\'			=> $password_hash,
								\'email\'					=> $email,
								\'email_setting\'			=> 1,
								\'save_pass\'				=> 0,
								\'timezone\'				=> $forum_config[\'o_default_timezone\'],
								\'dst\'					=> 0,
								\'language\'				=> $forum_config[\'o_default_lang\'],
								\'style\'					=> $forum_config[\'o_default_style\'],
								\'registered\'			=> time(),
								\'registration_ip\'		=> get_remote_address(),
								\'activate_key\'			=> ($forum_config[\'o_regs_verify\'] == \'1\') ? \'\\\'\'.random_key(8, true).\'\\\'\' : \'NULL\',
								\'require_verification\'	=> ($forum_config[\'o_regs_verify\'] == \'1\'),
								\'notify_admins\'			=> ($forum_config[\'o_regs_report\'] == \'1\')
								),
								$new_uid
						);

						if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						else
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

						$forum_flash->add_info($lang_admin_add_user[\'User added successfully\']);

						if (isset($_POST[\'edit_identity\']) && $_POST[\'edit_identity\'] == 1)
							redirect(forum_link($forum_url[\'profile_identity\'], $new_uid), $lang_admin_add_user[\'User added successfully\']);

						$ext_admin_add_user_user_added = true;
					}
					else
						$ext_admin_add_user_user_added = false;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'pf_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_row_pre_post_ident_merge' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($cur_post[\'poster_id\'] > 1)
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), (($forum_user[\'g_view_users\'] == \'1\') ? \'<em class="group_color_\'.$cur_post[\'g_id\'].\'"><a title="\'.sprintf($lang_topic[\'Go to profile\'], forum_htmlencode($cur_post[\'username\'])).\'" href="\'.forum_link($forum_url[\'user\'], $cur_post[\'poster_id\']).\'">\'.forum_htmlencode($cur_post[\'username\']).\'</a></em>\' : \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\')).\'</span>\';
			else
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\').\'</span>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ul_results_row_pre_data_output' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'table_row\'][\'username\'] = \'<td class="tc\'.count($forum_page[\'table_row\']).\'"><span class="group_color_\'.$user_data[\'g_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $user_data[\'id\']).\'">\'.forum_htmlencode($user_data[\'username\']).\'</a></span></td>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'pf_change_details_about_output_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'user_ident\'][\'username\'] = \'<li class="username\'.(($user[\'realname\'] ==\'\') ? \' fn nickname\' :  \' nickname\').\'"><strong class="group_color_\'.$user[\'g_id\'].\'">\'.forum_htmlencode($user[\'username\']).\'</strong></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ul_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_add_user\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_add_user\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_add_user\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN)
			{
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						else
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

				$username = \'\';
				$email = \'\';
				$edit_identity = \'\';
				$result_message = \'\';

				if (isset($_POST[\'add_user_form_sent\']) && $_POST[\'add_user_form_sent\'] == 1)
				{
					if ($ext_admin_add_user_user_added === true)
						$result_message = \'<div class="frm-info"><p>\'.$lang_admin_add_user[\'User added successfully\'].\'/p></div>\';
					else
					{
						$username = $_POST[\'req_username\'];
						$email = $_POST[\'req_email\'];
						$edit_identity = isset($_POST[\'edit_identity\']);
					}
				}

				$buffer_old = ob_get_contents();

				ob_end_clean();

				ob_start();

				$pun_add_user_form_action = $base_url.\'/userlist.php\';

				// Get output buffer and insert form
				$pos = strpos($buffer_old, \'<div class="main-foot">\');
				echo substr($buffer_old, 0 , $pos);
				?>

				<div class="main-head">
					<h2 class="hn"><span><?php echo $lang_admin_add_user[\'Add user\'] ?></span></h2>
				</div>
				<div class="main-content main-frm">
				<?php

				if (!empty($errors_add_users))
				{
					$error_li = array();
					for ($err_num = 0; $err_num < count($errors_add_users); $err_num++)
						$error_li[] = \'<li class="warn"><span>\'.$errors_add_users[$err_num].\'</span></li>\';

				?>
					<div class="ct-box error-box">
						<h2 class="warn hn"><?php echo $lang_admin_add_user[\'There are some errors\']; ?></h2>
						<ul class="error-list">
						<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $error_li)."\\n" ?>
						</ul>
					</div>
				<?php } ?>
					<form class="frm-form" id="frm-adduser" action="<?php echo $pun_add_user_form_action ?>#adduser-content" method="post">
						<div class="hidden">
							<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($pun_add_user_form_action) ?>" />
							<input type="hidden" name="add_user_form_sent" value="1" />
						</div>

						<div class="frm-group group1">
							<div class="sf-set set1">
								<div class="sf-box text required">
									<label for="add_user_username">
										<span><?php echo $lang_admin_add_user[\'Username\'] ?></span>
										<small>
											<?php echo $lang_admin_add_user[\'Between 2 and 25 characters\'] ?>
										</small>
									</label>
									<span class="fld-input"><input type="text" id="add_user_username" name="req_username" size="35" value="<?php echo $username ?>" maxlength="25" required /></span>
								</div>
							</div>

							<div class="sf-set set2">
								<div class="sf-box text required">
									<label for="add_user_email">
										<span><?php echo $lang_admin_add_user[\'E-mail\'] ?></span>
										<small>
											<?php echo $lang_admin_add_user[\'Enter a current and valid e-mail address\'] ?>
										</small>
									</label>
									<span class="fld-input"><input type="text" id="add_user_email" name="req_email" size="35" value="<?php echo $email ?>" maxlength="80" required/></span>
								</div>
							</div>

							<div class="sf-set set3">
								<div class="sf-box checkbox">
									<span class="fld-input"><input type="checkbox" id="add_user_edit_user_identity" name="edit_identity" value="1"<?php echo $edit_identity ? \' checked="checked"\' : \'\' ?> /></span>
									<label for="add_user_edit_user_identity"><?php echo $lang_admin_add_user[\'Edit User Identity after adding User\'] ?></label>
								</div>
							</div>
						</div>

						<div class="frm-buttons">
							<span class="submit primary"><input type="submit" name="submit" value="<?php echo $lang_admin_add_user[\'Add user\'] ?>" /></span>
						</div>
					</form>
				</div>
				<?php

				echo substr($buffer_old, $pos, strlen($buffer_old) - $pos);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] !== \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			include $ext_info[\'path\'].\'/functions.php\';

			if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			else
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

			// No script CSS
			$forum_loader->add_css(\'#pun_poll_switcher_block, #pun_poll_add_options_link { display: none; } #pun_poll_form_block, #pun_poll_update_block { display: block !important; }\', array(\'type\' => \'inline\', \'noscript\' => true));

			// JS
			$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_start' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] !== \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			include $ext_info[\'path\'].\'/functions.php\';

			if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			else
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

			// No script CSS
			$forum_loader->add_css(\'#pun_poll_switcher_block, #pun_poll_add_options_link { display: none; } #pun_poll_form_block, #pun_poll_update_block { display: block !important; }\', array(\'type\' => \'inline\', \'noscript\' => true));

			// JS
			$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_post_selected' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$topic_poll = FALSE;
			if ($can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\'])) {
				$pun_poll_query = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
				);
				$pun_poll_results = $forum_db->query_build($pun_poll_query) or error(__FILE__, __LINE__);

				if ($row = $forum_db->fetch_row($pun_poll_results)) {
					list($poll_question, $poll_read_unvote_users, $poll_revote, $poll_created, $poll_days_count, $poll_votes_count) = $row;
					$topic_poll = TRUE;
				}

				if ($topic_poll) {
					$pun_poll_query = array(
						\'SELECT\'	=>	\'answer\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'],
						\'ORDER BY\'	=>	\'id ASC\'
					);
					$pun_poll_results = $forum_db->query_build($pun_poll_query) or error(__FILE__, __LINE__);

					$poll_answers = array();
					while ($cur_answer = $forum_db->fetch_assoc($pun_poll_results)) {
						$poll_answers[] = $cur_answer[\'answer\'];
					}

					if (empty($poll_answers)) {
						message($lang_common[\'Bad request\']);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//
			$forum_page[\'hidden_fields\'][\'pun_poll_block_status\'] = \'<input type="hidden" name="pun_poll_block_open" id="pun_poll_block_status" value="1" />\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_form_submitted' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($_POST[\'preview\']) && $can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\'])) {
				$reset_poll = (isset($_POST[\'reset_poll\']) && $_POST[\'reset_poll\'] == \'1\') ? true : false;
				$remove_poll = (isset($_POST[\'remove_poll\']) && $_POST[\'remove_poll\'] == \'1\') ? true : false;

				// We need to reset poll
				if ($reset_poll) {
					Pun_poll::reset_poll($cur_post[\'tid\']);
				}

				if ($remove_poll) {
					Pun_poll::remove_poll($cur_post[\'tid\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_end_validation' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($_POST[\'reset_poll\']) || $_POST[\'reset_poll\'] != \'1\') {

				if (($forum_user[\'group_id\'] == FORUM_ADMIN && $can_edit_subject) || ($can_edit_subject && !$topic_poll)) {
					// Get information about new poll.
					$new_poll_question = isset($_POST[\'question_of_poll\']) && !empty($_POST[\'question_of_poll\']) ? $_POST[\'question_of_poll\'] : FALSE;
					if (!empty($new_poll_question)) {
						$new_poll_answers = isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) ? $_POST[\'poll_answer\'] : FALSE;
						$new_poll_days = isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\']) ? $_POST[\'allow_poll_days\'] : FALSE;
						$new_poll_votes = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? $_POST[\'allow_poll_votes\'] : FALSE;
						$new_read_unvote_users = isset($_POST[\'read_unvote_users\']) && !empty($_POST[\'read_unvote_users\']) ? $_POST[\'read_unvote_users\'] : FALSE;
						$new_revote = isset($_POST[\'revouting\']) ? $_POST[\'revouting\'] : FALSE;

						Pun_poll::data_validation($new_poll_question, $new_poll_answers, $new_poll_days, $new_poll_votes, $new_read_unvote_users, $new_revote);
					}

					if (isset($_POST[\'update_poll\'])) {
						$new_poll_ans_count = isset($_POST[\'poll_ans_count\']) && intval($_POST[\'poll_ans_count\']) > 0 ? intval($_POST[\'poll_ans_count\']) : FALSE;

						if (!$new_poll_ans_count)
							$errors[] = $lang_pun_poll[\'Empty option count\'];
						if ($new_poll_ans_count < 2)
						{
							$errors[] = $lang_pun_poll[\'Min cnt options\'];
							$new_poll_ans_count = 2;
						}

						if ($new_poll_ans_count > $forum_config[\'p_pun_poll_max_answers\'])
						{
							$errors[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
							$new_poll_ans_count = $forum_config[\'p_pun_poll_max_answers\'];
						}

						$_POST[\'preview\'] = 1;
					} else if ($new_poll_question !== FALSE && empty($errors) && !isset($_POST[\'preview\'])) {
						if (!$topic_poll) {
							Pun_poll::add_poll($cur_post[\'tid\'], $new_poll_question, $new_poll_answers, $new_poll_days !== FALSE ? $new_poll_days : \'NULL\', $new_poll_votes !== FALSE ? $new_poll_votes : \'NULL\', $new_read_unvote_users !== FALSE ? $new_read_unvote_users : \'0\', $new_revote !== FALSE ? $new_revote : \'0\');
						} else {
							Pun_poll::update_poll($cur_post[\'tid\'], $new_poll_question, $new_poll_answers, $new_poll_days !== FALSE ? $new_poll_days : null, $new_poll_votes !== FALSE ? $new_poll_votes : null, $new_read_unvote_users !== FALSE ? $new_read_unvote_users : \'0\', $new_revote !== FALSE ? $new_revote : \'0\', $poll_question, $poll_answers, $poll_days_count, $poll_votes_count, $poll_read_unvote_users, $poll_revote);
						}
					}

				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_preview_pre_display' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ((($forum_user[\'group_id\'] == FORUM_ADMIN && $can_edit_subject) || ($can_edit_subject && !$topic_poll)) && empty($errors)) {
				if (!empty($new_poll_question) && !empty($new_poll_answers)) {
					$forum_page[\'preview_message\'] .= Pun_poll::poll_preview($new_poll_question, $new_poll_answers);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_main_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				//Is there something?
				if ($topic_poll) {
					if ($forum_user[\'group_id\'] == FORUM_ADMIN) {
						Pun_poll::show_form(isset($new_poll_question) ? $new_poll_question : $poll_question, isset($new_poll_answers) ? $new_poll_answers : $poll_answers, isset($new_poll_ans_count) ? $new_poll_ans_count : (isset($new_poll_answers) ? count($new_poll_answers) : count($poll_answers)), isset($new_poll_days) ? $new_poll_days : $poll_days_count, isset($new_poll_votes) ? $new_poll_votes : $poll_votes_count, isset($new_read_unvote_users) ? $new_read_unvote_users : $poll_read_unvote_users, isset($new_revote) ? $new_revote : $poll_revote, true);
					}
				} else {
					Pun_poll::show_form(isset($new_poll_question) ? $new_poll_question : \'\', isset($new_poll_answers) ? $new_poll_answers : \'\', isset($new_poll_ans_count) ? $new_poll_ans_count : (isset($new_poll_answers) ? (count($new_poll_answers) > 2 ? count($new_poll_answers) : 2) : 2), isset($new_poll_days) ? $new_poll_days : FALSE, isset($new_poll_votes) ? $new_poll_votes : FALSE, $forum_config[\'p_pun_poll_enable_read\'] ? (isset($new_read_unvote_users) ? $new_read_unvote_users : \'0\') : FALSE, $forum_config[\'p_pun_poll_enable_revote\'] ? (isset($new_revote) ? $new_revote : \'0\') : FALSE);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_form_submitted' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				$poll_question = isset($_POST[\'question_of_poll\']) && !empty($_POST[\'question_of_poll\']) ? $_POST[\'question_of_poll\'] : FALSE;
				if (!empty($poll_question))
				{
					$poll_answers = isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) ? $_POST[\'poll_answer\'] : FALSE;
					$poll_days = isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\']) ? $_POST[\'allow_poll_days\'] : FALSE;
					$poll_votes = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? $_POST[\'allow_poll_votes\'] : FALSE;
					$poll_read_unvote_users = isset($_POST[\'read_unvote_users\']) && !empty($_POST[\'read_unvote_users\']) ? $_POST[\'read_unvote_users\'] : FALSE;
					$poll_revote = isset($_POST[\'revouting\']) && !empty($_POST[\'revouting\']) ? $_POST[\'revouting\'] : FALSE;

					Pun_poll::data_validation($poll_question, $poll_answers, $poll_days, $poll_votes, $poll_read_unvote_users, $poll_revote);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && isset($_POST[\'update_poll\']) && isset($_POST[\'preview\']) && $_POST[\'preview\'] == \'pun_poll\') {
				unset($_POST[\'preview\']);
			}

			//
			$forum_page[\'hidden_fields\'][\'pun_poll_block_status\'] = \'<input type="hidden" name="pun_poll_block_open" id="pun_poll_block_status" value="0" />\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_pre_redirect' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']) && $poll_question !== FALSE && empty($errors))
			{
				Pun_poll::add_poll($new_tid, $poll_question, $poll_answers, $poll_days !== FALSE ? $poll_days : \'NULL\', $poll_votes !== FALSE ? $poll_votes : \'NULL\', $poll_read_unvote_users === FALSE  ? \'0\' : $poll_read_unvote_users, $poll_revote === FALSE ? \'0\' : $poll_revote);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_preview_pre_display' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']) && $poll_question !== FALSE && empty($errors)) {
				$forum_page[\'preview_message\'] .= Pun_poll::poll_preview($poll_question, $poll_answers);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_req_info_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_poll_add\']))
			{
				$_poll_question = isset($poll_question) ? $poll_question : \'\';
				$_poll_answers = isset($poll_answers) ? $poll_answers : array();
				$_poll_answers_num = isset($new_poll_ans_count) ? $new_poll_ans_count : ((isset($poll_answers) && count($poll_answers) > 1) ? count($poll_answers) : 2);

				Pun_poll::show_form($_poll_question, $_poll_answers, $_poll_answers_num, !empty($poll_days) ? $poll_days : \'\', !empty($poll_votes) ? $poll_votes : \'\', isset($poll_read_unvote_users) ? $poll_read_unvote_users : \'0\', isset($poll_revote) ? $poll_revote : \'0\');
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ca_fn_prune_qr_prune_topics' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'fn_delete_topic_qr_delete_topic' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include_once $ext_info[\'path\'].\'/functions.php\';

			Pun_poll::remove_poll($topic_id);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'mr_qr_get_forum_data' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_POST[\'merge_topics\']) || isset($_POST[\'merge_topics_comply\']))
			{
				$poll_topics = isset($_POST[\'topics\']) && !empty($_POST[\'topics\']) ? $_POST[\'topics\'] : array();
				$poll_topics = array_map(\'intval\', (is_array($poll_topics) ? $poll_topics : explode(\',\', $poll_topics)));

				if (empty($poll_topics))
					message($lang_misc[\'No topics selected\']);

				if (count($poll_topics) == 1)
					message($lang_misc[\'Merge error\']);

				$query_poll = array(
					\'SELECT\'	=>	\'topic_id\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $poll_topics).\')\'
				);
				$result_pun_poll = $forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

				$polls = array();
				while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
					$polls[] = $row[\'topic_id\'];
				}

				if (count($polls) > 1) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

					message($lang_pun_poll[\'Merge error\']);
				} else if (count($polls) === 1) {
					$question_id = $polls[0];
				}

				unset($num_polls, $polls);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_modify_topic_info' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_user[\'is_guest\']) {
				//Get info about poll
				$query_pun_poll = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count AS max_votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$id
				);
				$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
				$pun_poll = $forum_db->fetch_assoc($result_pun_poll);

				// Is there something?
				if (!is_null($pun_poll) && $pun_poll !== false) {
					if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\'))
						$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
					else
						$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_poll.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));

					// JS
					$forum_loader->add_js($ext_info[\'url\'].\'/js/pun_poll.min.js\', array(\'type\' => \'url\', \'async\' => true));

					$end_voting = false;
					$pun_poll[\'revote\'] = ($forum_config[\'p_pun_poll_enable_revote\'] == \'1\') ? $pun_poll[\'revote\'] : 0;
					$pun_poll[\'read_unvote_users\'] = ($forum_config[\'p_pun_poll_enable_read\'] == \'1\') ? $pun_poll[\'read_unvote_users\'] : 0;

					// Check up for condition of end poll
					if ($pun_poll[\'days_count\'] != 0 && time() > $pun_poll[\'created\'] + $pun_poll[\'days_count\'] * 86400) {
						$end_voting = true;
					} else if ($pun_poll[\'max_votes_count\'] != 0) {
						// Get count of votes
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(id) AS vote_count\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id=\'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$row = $forum_db->fetch_assoc($result_pun_poll);
						$vote_count = $row[\'vote_count\'];

						if ($vote_count >= $pun_poll[\'max_votes_count\']) {
							$end_voting = true;
						}
					}

					if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

					// Does user want to vote?
					if (isset($_POST[\'vote\'])) {
						if ($end_voting) {
							message($lang_pun_poll[\'End of vote\']);
						}

						$answer_id = isset($_POST[\'answer\']) ? intval($_POST[\'answer\']) : 0;
						if ($answer_id < 1) {
							message($lang_common[\'Bad request\']);
						}

						// Is there answer with this id?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(*)\',
							\'FROM\'		=>	\'answers\',
							\'WHERE\'		=>	\'topic_id=\'.$id.\' AND id=\'.$answer_id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						if ($forum_db->result($result_pun_poll) < 1) {
							message($lang_common[\'Bad request\']);
						}

						// Have user voted?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer_id\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id=\'.$id.\' AND user_id=\'.$forum_user[\'id\']
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$row = $forum_db->fetch_assoc($result_pun_poll);
						$old_answer_id = FALSE;
						if ($row) {
							$old_answer_id = $row[\'answer_id\'];
						}

						// CAN revote?
						if (!$pun_poll[\'revote\'] && $old_answer_id !== FALSE) {
							message($lang_pun_poll[\'User vote error\']);
						}

						// If user have voted we update table,
						// if not - insert new record
						if ($pun_poll[\'revote\'] && $old_answer_id !== FALSE) {
							// Do we needed to update DB?
							if ($old_answer_id != $answer_id) {
								$query_pun_poll = array(
									\'UPDATE\'	=>	\'voting\',
									\'SET\'		=>	\'answer_id=\'.$answer_id,
									\'WHERE\'		=>	\'topic_id=\'.$id.\' AND user_id=\'.$forum_user[\'id\']
								);
								$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

								// Replace old answer id with new for correct output
								$old_answer_id = $answer_id;
							}
						} else {
							// Add new record
							$query_pun_poll = array(
								\'INSERT\'	=>	\'topic_id, user_id, answer_id\',
								\'INTO\'		=>	\'voting\',
								\'VALUES\'	=>	$id.\', \'.$forum_user[\'id\'].\', \'.$answer_id
							);
							$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						}

						redirect(forum_link($forum_url[\'topic\'], array($id, sef_friendly($cur_topic[\'subject\']))), $lang_pun_poll[\'Poll redirect\']);
					} else {
						// Determine user have voted or not
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(*)\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'user_id=\'.$forum_user[\'id\'].\' AND topic_id=\'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						$is_voted_user = ($forum_db->result($result_pun_poll) > 0) ? true : false;
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Is there something to show?
			if (isset($pun_poll[\'read_unvote_users\']) && !$forum_user[\'is_guest\']) {
				// If we don\'t get count of votes
				if (!isset($vote_count)) {
					$query_pun_poll = array(
						\'SELECT\'	=>	\'COUNT(*) AS vote_count\',
						\'FROM\'		=>	\'voting\',
						\'WHERE\'		=>	\'topic_id=\'.$id
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					$row = $forum_db->fetch_assoc($result_pun_poll);
					$vote_count = $row[\'vote_count\'];
				}

				// Showing of vote-form if users can revote or user don\'t vote
				if (!$end_voting && (($is_voted_user && $pun_poll[\'revote\']) || $is_voted_user === false)) {
					$query_pun_poll = array(
						\'SELECT\'	=>	\'id, answer\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id=\'.$id,
						\'ORDER BY\'	=>	\'id ASC\'
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

					$pun_poll_answers = array();
					while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
						$pun_poll_answers[] = $row;
					}

					if (!empty($pun_poll_answers))
					{
						$vote_form = \'\';
						$link = forum_link($forum_url[\'topic\'], $id);

						$vote_form = \'
							<div class="pun_poll_item unvotted">
								<div class="pun_poll_header">\'.forum_htmlencode($pun_poll[\'question\']).\'</div>
								<div class="main-frm">
									<form class="frm-form" action="\'.$link.\'" accept-charset="utf-8" method="post">
										<fieldset class="frm-group group1">
											<div class="hidden">
												<input type="hidden" name="csrf_token" value="\'.generate_form_token($link).\'" />
											</div>
											<fieldset class="mf-set set1">
												<legend><span>\'.$lang_pun_poll[\'Options\'].\'</span></legend>
												<div class="mf-box">\';

						// Determine old answer of user
						if (!isset($old_answer_id)) {
							$query_pun_poll = array(
								\'SELECT\'	=>	\'answer_id\',
								\'FROM\'		=>	\'voting\',
								\'WHERE\'		=>	\'topic_id = \'.$id.\' AND user_id = \'.$forum_user[\'id\'],
								\'ORDER BY\'	=>	\'answer_id ASC\'
							);
							$result_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

							// If there is something?
							$row = $forum_db->fetch_assoc($result_poll);
							if ($row) {
								$old_answer_id = $row[\'answer_id\'];
							}
							unset($result_poll);
						}


						$num = 0;
						foreach ($pun_poll_answers as $answer) {
							$num++;
							$vote_form .= \'
								<div class="mf-item pun_poll_answer_block" data-num="\'.$num.\'">
									<span class="fld-input">
										<input id="fld\'.$num.\'" type="radio"\'.((isset($old_answer_id) && $old_answer_id == $answer[\'id\']) ? \' checked="checked"\' : \'\').\' value="\'.$answer[\'id\'].\'" name="answer" />
									</span>
									<label for="fld\'.$num.\'">\'.forum_htmlencode($answer[\'answer\']).\'</label>
								</div>\';
						}

						$vote_form .= \'
												</div>
											</fieldset>
										</fieldset>
										<div class="frm-buttons">
											<span class="submit">
												<input type="submit" value="\'.$lang_pun_poll[\'But note\'].\'" name="vote" />
											</span>
										</div>
									</form>
								</div>
							</div>\';
					}
				}

				// Showing voting results if user have voted or unread user can see voting results
				if ($end_voting || $is_voted_user || (!$is_voted_user && $pun_poll[\'read_unvote_users\'])) {
					if (isset($vote_count) && $vote_count > 0) {
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer, COUNT(v.id) as num_vote\',
							\'FROM\'		=>	\'answers as a\',
							\'JOINS\'		=>	array(
								array(
									\'LEFT JOIN\'	=>	\'voting AS v\',
									\'ON\'		=>	\'a.id=v.answer_id\'
								)
							),
							\'WHERE\'		=>	\'a.topic_id=\'.$id,
							\'GROUP BY\'	=>	\'a.id\',
							\'ORDER BY\'	=>	\'a.id\'
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

						$vote_results = \'<div class="pun_poll_item votted"><div class="pun_poll_header">\'.forum_htmlencode($pun_poll[\'question\']).\'</div>\';
						$vote_results_raw = array();
						$num = $winner_index = $cur_vote_index = 0;
						$max_vote = $num_winner = 0;

						while ($row = $forum_db->fetch_assoc($result_pun_poll)) {
							$vote_results_raw[] = $row;
							if ($row[\'num_vote\'] > $max_vote) {
								$max_vote = $row[\'num_vote\'];
								$winner_index = $cur_vote_index;
							}

							$cur_vote_index++;
						}

						// Case when winner is not one
						foreach ($vote_results_raw as $vote) {
							if ($vote[\'num_vote\'] == $max_vote) {
								$num_winner++;
							}
						}

						if ($num_winner !== 1) {
							// No winner
							$winner_index = -1;
						}

						foreach ($vote_results_raw as $vote) {
							$pollResultWidth = ((float)/**/$vote[\'num_vote\'] / $vote_count * 100);
							$vote_results .= \'
								<dl>
									<dt><strong>\'.forum_number_format((float)/**/$vote[\'num_vote\'] / $vote_count * 100).\'%</strong><br/>(\'.$vote[\'num_vote\'].\')</dt>
									<dd>\'.forum_htmlencode($vote[\'answer\'])
										.\'<div class="\'.(($winner_index == $num) ? \'winner\' : \'\').(($pollResultWidth > 0) ? \'\' : \' poll-empty\').\'" style="width: \'.$pollResultWidth.\'%;"></div>
									</dd>
								</dl>\';
							$num++;
						}

						$num++;
						$vote_results .= \'<p class="pun_poll_total">\'.$lang_pun_poll[\'Users count\'].$vote_count.\'</p>\';
						$vote_results .= \'</div>\';
					} else {
						$vote_results = \'<div class="ct-box info-box"><p>\'.$lang_pun_poll[\'No votes\'].\'</p></div>\';
					}
				} else {
					$vote_results = \' \';
				}

				unset($tmp_pagepost, $vote_count, $num, $result_pun_poll, $query_pun_poll, $count_v, $answer, $is_voted_user, $end_voting, $pun_poll);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'aop_features_pre_header_load' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'agr_add_edit_group_user_permissions_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			?>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend>
						<span><?php echo $lang_pun_poll[\'Permission\'] ?></span>
					</legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input">
								<input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="poll_add" value="1"<?php if ($group[\'g_poll_add\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_poll[\'Poll add\'] ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'po_pre_post_contents' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'vt_quickpost_pre_message_box' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'ed_pre_message_box' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'pun_pm_fn_send_form_pre_textarea_output' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'pf_change_details_settings_validation' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'pun_bbcode_enabled\'] = (!isset($_POST[\'form\'][\'pun_bbcode_enabled\']) || $_POST[\'form\'][\'pun_bbcode_enabled\'] != \'1\') ? \'0\' : \'1\';
			$form[\'pun_bbcode_use_buttons\'] = (!isset($_POST[\'form\'][\'pun_bbcode_use_buttons\']) || $_POST[\'form\'][\'pun_bbcode_use_buttons\'] != \'1\') ? \'0\' : \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
    'pf_change_details_settings_email_fieldset_end' =>
    array(
        0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include $ext_info[\'path\'].\'/lang/English/pun_bbcode.php\';

			$forum_page[\'item_count\'] = 0;
?>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_enabled]" value="1"<?php if ($user[\'pun_bbcode_enabled\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_bbcode[\'Pun BBCode Bar\'] ?></span> <?php echo $lang_pun_bbcode[\'Notice BBCode Bar\'] ?></label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_use_buttons]" value="1"<?php if ($user[\'pun_bbcode_use_buttons\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_bbcode[\'BBCode Graphical buttons\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    ),
);

?>
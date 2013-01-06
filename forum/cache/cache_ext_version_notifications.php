<?php

if (!defined('FORUM_EXT_VERSIONS_LOADED'))
    define('FORUM_EXT_VERSIONS_LOADED', 1);

$forum_ext_repos = array(
    'http://punbb.informer.com/extensions' =>
    array(
        'timestamp' => '1322555942',
        'extension_versions' =>
        array(
            'pun_admin_add_user' => '1.1.1',
            'pun_bbcode' => '1.3.6',
            'pun_colored_usergroups' => '1.0.4',
            'pun_poll' => '1.1.11',
            'pun_tags' => '1.5.1',
        ),
    ),
);

$forum_ext_last_versions = array(
    'pun_admin_add_user' =>
    array(
        'version' => '1.1.1',
        'repo_url' => 'http://punbb.informer.com/extensions',
        'changes' => 'Added missed subfolder "English".',
    ),
    'pun_bbcode' =>
    array(
        'version' => '1.3.6',
        'repo_url' => 'http://punbb.informer.com/extensions',
    ),
    'pun_colored_usergroups' =>
    array(
        'version' => '1.0.4',
        'repo_url' => 'http://punbb.informer.com/extensions',
        'changes' => 'Change span to em in username link',
    ),
    'pun_poll' =>
    array(
        'version' => '1.1.11',
        'repo_url' => 'http://punbb.informer.com/extensions',
        'changes' => 'Publication of pun_poll 1.1.11.',
    ),
    'pun_tags' =>
    array(
        'version' => '1.5.1',
        'repo_url' => 'http://punbb.informer.com/extensions',
        'changes' => 'Improved update cache mechanism.',
    ),
    'pun_jquery' =>
    array(
        'version' => '1.1.5',
        'repo_url' => '',
        'changes' => '',
    ),
    'pun_admin_manage_extensions_improved' =>
    array(
        'version' => '1.5.3',
        'repo_url' => '',
        'changes' => '',
    ),
    'pun_repository' =>
    array(
        'version' => '1.3.1',
        'repo_url' => '',
        'changes' => '',
    ),
);

$forum_ext_versions_update_cache = 1357417923;

?>
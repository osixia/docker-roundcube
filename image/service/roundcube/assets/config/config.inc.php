<?php

/* Local configuration for Roundcube Webmail */

// ----------------------------------
// SQL DATABASE
// ----------------------------------
// Database connection string (DSN) for read+write operations
// Format (compatible with PEAR MDB2): db_provider://user:password@host/database
// Currently supported db_providers: mysql, pgsql, sqlite, mssql or sqlsrv
// For examples see http://pear.php.net/manual/en/package.database.mdb2.intro-dsn.php
// NOTE: for SQLite use absolute path: 'sqlite:////full/path/to/sqlite.db?mode=0646'
$config['db_dsnw'] = 'mysql://roundcube:password@bdd.example.org/roundcubemail?key=/container/service/mariadb-client/assets/certs/cert.key&cert=/container/service/mariadb-client/assets/certs/cert.crt';

// log driver:  'syslog' or 'file'.
$config['log_driver'] = 'syslog';

// Log sent messages to <log_dir>/sendmail or to syslog
$config['smtp_log'] = false;

// ----------------------------------
// IMAP
// ----------------------------------
// The mail host chosen to perform the log-in.
// Leave blank to show a textbox at login, give a list of hosts
// to display a pulldown menu or set one host as string.
// To use SSL/TLS connection, enter hostname with prefix ssl:// or tls://
// Supported replacement variables:
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %s - domain name after the '@' from e-mail address provided at login screen
// For example %n = mail.domain.tld, %t = domain.tld
// WARNING: After hostname change update of mail_host column in users table is
//          required to match old user data records with the new host.
//$config['default_host'] = array('tls://mail.osixia.net' => 'Osixia', 'tls://mail.syndis.fr' => 'Syndis');
$config['default_host'] = 'tls://mail.example.org';

// ----------------------------------
// SMTP
// ----------------------------------
// SMTP server host (for sending mails).
// To use SSL/TLS connection, enter hostname with prefix ssl:// or tls://
// If left blank, the PHP mail() function is used
// Supported replacement variables:
// %h - user's IMAP hostname
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %z - IMAP domain (IMAP hostname without the first part)
// For example %n = mail.domain.tld, %t = domain.tld
$config['smtp_server'] = 'tls://%h';

// SMTP port (default is 25; use 587 for STARTTLS or 465 for the
// deprecated SSL over SMTP (aka SMTPS))
$config['smtp_port'] = 587;

// SMTP username (if required) if you use %u as the username Roundcube
// will use the current username for login
$config['smtp_user'] = '%u';

// SMTP password (if required) if you use %p as the password Roundcube
// will use the current user's password for login
$config['smtp_pass'] = '%p';

// provide an URL where a user can get support for this Roundcube installation
// PLEASE DO NOT LINK TO THE ROUNDCUBE.NET WEBSITE HERE!
$config['support_url'] = '';

// this key is used to encrypt the users imap password which is stored
// in the session record (and the client cookie if remember password is enabled).
// please provide a string of exactly 24 chars.
$config['des_key'] = 'b1e46cjpop78e6ce83e5e966';

// ----------------------------------
// PLUGINS
// ----------------------------------
// List of active plugins (in plugins/ directory)
$config['plugins'] = array('attachment_reminder', 'emoticons', 'hide_blockquote', 'managesieve', 'markasjunk', 'zipdownload', 'jqueryui', 'newmail_notifier', 'identity_select');

// Make use of the built-in spell checker. It is based on GoogieSpell.
// Since Google only accepts connections over https your PHP installatation
// requires to be compiled with Open SSL support
$config['enable_spellcheck'] = true;

// Set the spell checking engine. Possible values:
// - 'googie'  - the default (also used for connecting to Nox Spell Server, see 'spellcheck_uri' setting)
// - 'pspell'  - requires the PHP Pspell module and aspell installed
// - 'enchant' - requires the PHP Enchant module
// - 'atd'     - install your own After the Deadline server or check with the people at http://www.afterthedeadline.com before using their API
// Since Google shut down their public spell checking service, the default settings
// connect to http://spell.roundcube.net which is a hosted service provided by Roundcube.
// You can connect to any other googie-compliant service by setting 'spellcheck_uri' accordingly.
$config['spellcheck_engine'] = 'enchant';

// These languages can be selected for spell checking.
// Configure as a PHP style hash array: array('en'=>'English', 'de'=>'Deutsch');
// Leave empty for default set of available language.
$config['spellcheck_languages'] = array('fr','en');

/*
// Connection scket context options
// See http://php.net/manual/en/context.ssl.php
$config['smtp_conn_options'] = array(
   'ssl'         => array(
     'verify_peer'  => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true,
   ),
 );

// Connection scket context options
// See http://php.net/manual/en/context.ssl.php
 $config['imap_conn_options'] = array(
    'ssl'         => array(
      'verify_peer'  => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true,
    ),
  );
*/

// compose html formatted messages by default
// 0 - never, 1 - always, 2 - on reply to HTML message, 3 - on forward or reply to HTML message
$config['htmleditor'] = 3;

// save compose message every 300 seconds (5min)
$config['draft_autosave'] = 60;

// When replying:
// -1 - don't cite the original message
// 0  - place cursor below the original message
// 1  - place cursor above original message (top posting)
$config['reply_mode'] = 1;

// Enables display of email address with name instead of a name (and address in title)
$config['message_show_email'] = true;

// use this format for date display (date or strftime format)
//$config['date_format'] = 'd/m/Y';

// use this format for detailed date/time formatting (derived from date_format and time_format)
//$config['date_long'] = 'd/m/Y H:i';

// skin name: folder from skins/
//$config['skin'] = 'chameleon-blue';

// if in your system 0 quota means no limit set this option to true
//$config['quota_zero_as_unlimited'] = true;

// Enables files upload indicator. Requires APC installed and enabled apc.rfc1867 option.
// By default refresh time is set to 1 second. You can set this value to true
// or any integer value indicating number of seconds.
$config['upload_progress'] = true;

// This domain will be used to form e-mail addresses of new users
// Specify an array with 'host' => 'domain' values to support multiple hosts
// Supported replacement variables:
// %h - user's IMAP hostname
// %n - http hostname ($_SERVER['SERVER_NAME'])
// %d - domain (http hostname without the first part)
// %z - IMAP domain (IMAP hostname without the first part)
// For example %n = mail.domain.tld, %t = domain.tld
$config['mail_domain'] = '%z';

// Automatically add this domain to user names for login
// Only for IMAP servers that require full e-mail addresses for login
// Specify an array with 'host' => 'domain' values to support multiple hosts
// Supported replacement variables:
// %h - user's IMAP hostname
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %z - IMAP domain (IMAP hostname without the first part)
// For example %n = mail.domain.tld, %t = domain.tld
$config['username_domain'] = '%z';

// Force domain configured in username_domain to be used for login.
// Any domain in username will be replaced by username_domain.
$config['username_domain_forced'] = true;

// Default messages listing mode. One of 'threads' or 'list'.
$config['default_list_mode'] = 'threads';

// 0 - Do not expand threads
// 1 - Expand all threads automatically
// 2 - Expand only threads with unread messages
$config['autoexpand_threads'] = 2;


// Set identities access level:
// 0 - many identities with possibility to edit all params
// 1 - many identities with possibility to edit all params but not email address
// 2 - one identity with possibility to edit all params
// 3 - one identity with possibility to edit all params but not email address
// 4 - one identity with possibility to edit only signature
$config['identities_level'] = 0;

// show address fields in this order
// available placeholders: {street}, {locality}, {zipcode}, {country}, {region}
//$config['address_template'] = '{street}<br/>{zipcode} {locality}<br/>{region} {country}';

// Enables possibility to log in using email address from user identities
$config['user_aliases'] = false;

//
// Plugins config
//

// Enables basic attachment reminder
$config['attachment_reminder'] = true;

// Enables basic notification
$config['newmail_notifier_basic'] = true;

// Enables desktop notification
$config['newmail_notifier_desktop'] = true;

// managesieve server address, default is localhost.
// Replacement variables supported in host name:
// %h - user's IMAP hostname
// %n - http hostname ($_SERVER['SERVER_NAME'])
// %d - domain (http hostname without the first part)
// For example %n = mail.domain.tld, %d = domain.tld
$config['managesieve_host'] = 'tls://%h';

// managesieve server port. When empty the port will be determined automatically
// using getservbyname() function, with 4190 as a fallback.
$config['managesieve_port'] = 4190;

// Enables separate management interface for vacation responses (out-of-office)
// 0 - no separate section (default),
// 1 - add Vacation section,
// 2 - add Vacation section, but hide Filters section
$config['managesieve_vacation'] = 1;

/*
// Connection scket context options
// See http://php.net/manual/en/context.ssl.php
$config['managesieve_conn_options'] = array(
    'ssl'         => array(
      'verify_peer'  => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true,
    ),
  );
*/

$config['enable_installer'] = true;

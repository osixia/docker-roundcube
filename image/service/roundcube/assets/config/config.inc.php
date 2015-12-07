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
$config['db_dsnw'] = 'mysql://roundcube:password@172.17.0.4/roundcubemail?key=/container/service/mariadb-client/assets/certs/cert.key&cert=/container/service/mariadb-client/assets/certs/client-cert.pem';

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
$config['default_host'] = 'tls://mail.osixia.net';

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
$config['smtp_server'] = 'tls://mail.osixia.net';

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
$config['des_key'] = 'b1e46cbab378e6ce83e5e966';

// ----------------------------------
// PLUGINS
// ----------------------------------
// List of active plugins (in plugins/ directory)
$config['plugins'] = array('attachment_reminder', 'emoticons', 'hide_blockquote', 'managesieve', 'markasjunk', 'new_user_identity', 'zipdownload', 'jqueryui', 'newmail_notifier');

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

$config['smtp_conn_options'] = array(
   'ssl'         => array(
     'verify_peer'  => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true,
   ),
 );

 $config['imap_conn_options'] = array(
    'ssl'         => array(
      'verify_peer'  => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true,
    ),
  );

// default setting if preview pane is enabled
$config['preview_pane'] = true;

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
$config['date_format'] = 'd/m/Y';

// use this format for detailed date/time formatting (derived from date_format and time_format)
$config['date_long'] = 'd/m/Y H:i';

// skin name: folder from skins/
$config['skin'] = 'chameleon-blue';

// if in your system 0 quota means no limit set this option to true
$config['quota_zero_as_unlimited'] = true;

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
$config['mail_domain'] = 'osixia.net';

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
$config['identities_level'] = 1;

// This indicates which type of address book to use. Possible choises:
// 'sql' (default), 'ldap' and ''.
// If set to 'ldap' then it will look at using the first writable LDAP
// address book as the primary address book and it will not display the
// SQL address book in the 'Address Book' view.
// If set to '' then no address book will be displayed or only the
// addressbook which is created by a plugin (like CardDAV).
$config['address_book_type'] = 'sql';

$config['ldap_public']['ldap'] = array(
  'name'          => 'Annuaire global',
  // Replacement variables supported in host names:
  // %h - user's IMAP hostname
  // %n - hostname ($_SERVER['SERVER_NAME'])
  // %t - hostname without the first part
  // %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
  // %z - IMAP domain (IMAP hostname without the first part)
  // For example %n = mail.domain.tld, %t = domain.tld
  'hosts'         => array('172.17.0.6'),
  'port'          => 389,
  'use_tls'       => true,
  'ldap_version'  => 3,       // using LDAPv3
  'network_timeout' => 10,    // The timeout (in seconds) for connect + bind arrempts. This is only supported in PHP >= 5.3.0 with OpenLDAP 2.x
  'user_specific' => false,   // If true the base_dn, bind_dn and bind_pass default to the user's IMAP login.
  // When 'user_specific' is enabled following variables can be used in base_dn/bind_dn config:
  // %fu - The full username provided, assumes the username is an email
  //       address, uses the username_domain value if not an email address.
  // %u  - The username prior to the '@'.
  // %d  - The domain name after the '@'.
  // %dc - The domain name hierarchal string e.g. "dc=test,dc=domain,dc=com"
  // %dn - DN found by ldap search when search_filter/search_base_dn are used
  'base_dn'       => '',
  'bind_dn'       => '',
  'bind_pass'     => '',
  // It's possible to bind for an individual address book
  // The login name is used to search for the DN to bind with
  'search_base_dn' => '',
  'search_filter'  => '',   // e.g. '(&(objectClass=posixAccount)(uid=%u))'
  // DN and password to bind as before searching for bind DN, if anonymous search is not allowed
  'search_bind_dn' => '',
  'search_bind_pw' => '',
  // Optional map of replacement strings => attributes used when binding for an individual address book
  'search_bind_attrib' => array(),  // e.g. array('%udc' => 'ou')
  // Default for %dn variable if search doesn't return DN value
  'search_dn_default' => '',
  // Optional authentication identifier to be used as SASL authorization proxy
  // bind_dn need to be empty
  'auth_cid'       => '',
  // SASL authentication method (for proxy auth), e.g. DIGEST-MD5
  'auth_method'    => '',
  // Indicates if the addressbook shall be hidden from the list.
  // With this option enabled you can still search/view contacts.
  'hidden'        => false,
  // Indicates if the addressbook shall not list contacts but only allows searching.
  'searchonly'    => false,
  // Indicates if we can write to the LDAP directory or not.
  // If writable is true then these fields need to be populated:
  // LDAP_Object_Classes, required_fields, LDAP_rdn
  'writable'       => false,
  // To create a new contact these are the object classes to specify
  // (or any other classes you wish to use).
  'LDAP_Object_Classes' => array('top', 'inetOrgPerson'),
  // The RDN field that is used for new entries, this field needs
  // to be one of the search_fields, the base of base_dn is appended
  // to the RDN to insert into the LDAP directory.
  'LDAP_rdn'       => 'cn',
  // The required fields needed to build a new contact as required by
  // the object classes (can include additional fields not required by the object classes).
  'required_fields' => array('cn', 'sn', 'mail'),
  'search_fields'   => array('mail', 'cn'),  // fields to search in
  // mapping of contact fields to directory attributes
  //   for every attribute one can specify the number of values (limit) allowed.
  //   default is 1, a wildcard * means unlimited
  'fieldmap' => array(
    // Roundcube  => LDAP:limit
    'name'        => 'cn',
    'surname'     => 'sn',
    'firstname'   => 'givenName',
    'jobtitle'    => 'title',
    'email'       => 'mail:*',
    'phone:home'  => 'homePhone',
    'phone:work'  => 'telephoneNumber',
    'phone:mobile' => 'mobile',
    'phone:pager' => 'pager',
    'phone:workfax' => 'facsimileTelephoneNumber',
    'street'      => 'street',
    'zipcode'     => 'postalCode',
    'region'      => 'st',
    'locality'    => 'l',
    // if you country is a complex object, you need to configure 'sub_fields' below
    'country'      => 'c',
    'organization' => 'o',
    'department'   => 'ou',
    'jobtitle'     => 'title',
    'notes'        => 'description',
    'photo'        => 'jpegPhoto',
    // these currently don't work:
    // 'manager'       => 'manager',
    // 'assistant'     => 'secretary',
  ),
  // Map of contact sub-objects (attribute name => objectClass(es)), e.g. 'c' => 'country'
  'sub_fields' => array(),
  // Generate values for the following LDAP attributes automatically when creating a new record
  'autovalues' => array(
  // 'uid'  => 'md5(microtime())',               // You may specify PHP code snippets which are then eval'ed
  // 'mail' => '{givenname}.{sn}@mydomain.com',  // or composite strings with placeholders for existing attributes
  ),
  'sort'           => 'cn',         // The field to sort the listing by.
  'scope'          => 'sub',        // search mode: sub|base|list
  'filter'         => '(objectClass=inetOrgPerson)',      // used for basic listing (if not empty) and will be &'d with search queries. example: status=act
  'fuzzy_search'   => true,         // server allows wildcard search
  'vlv'            => false,        // Enable Virtual List View to more efficiently fetch paginated data (if server supports it)
  'vlv_search'     => false,        // Use Virtual List View functions for autocompletion searches (if server supports it)
  'numsub_filter'  => '(objectClass=organizationalUnit)',   // with VLV, we also use numSubOrdinates to query the total number of records. Set this filter to get all numSubOrdinates attributes for counting
  'config_root_dn' => 'cn=config',  // Root DN to search config entries (e.g. vlv indexes)
  'sizelimit'      => '0',          // Enables you to limit the count of entries fetched. Setting this to 0 means no limit.
  'timelimit'      => '0',          // Sets the number of seconds how long is spend on the search. Setting this to 0 means no limit.
  'referrals'      => false,        // Sets the LDAP_OPT_REFERRALS option. Mostly used in multi-domain Active Directory setups
  'dereference'    => 0,            // Sets the LDAP_OPT_DEREF option. One of: LDAP_DEREF_NEVER, LDAP_DEREF_SEARCHING, LDAP_DEREF_FINDING, LDAP_DEREF_ALWAYS
                                    // Used where addressbook contains aliases to objects elsewhere in the LDAP tree.

  // definition for contact groups (uncomment if no groups are supported)
  // for the groups base_dn, the user replacements %fu, %u, $d and %dc work as for base_dn (see above)
  // if the groups base_dn is empty, the contact base_dn is used for the groups as well
  // -> in this case, assure that groups and contacts are separated due to the concernig filters!
  'groups'  => array(
    'base_dn'           => '',
    'scope'             => 'sub',       // Search mode: sub|base|list
    'filter'            => '(objectClass=groupOfNames)',
    'object_classes'    => array('top', 'groupOfNames'),   // Object classes to be assigned to new groups
    'member_attr'       => 'member',   // Name of the default member attribute, e.g. uniqueMember
    'name_attr'         => 'cn',       // Attribute to be used as group name
    'email_attr'        => 'mail',     // Group email address attribute (e.g. for mailing lists)
    'member_filter'     => '(objectclass=*)',  // Optional filter to use when querying for group members
    'vlv'               => false,      // Use VLV controls to list groups
    'class_member_attr' => array(      // Mapping of group object class to member attribute used in these objects
      'groupofnames'       => 'member',
      'groupofuniquenames' => 'uniquemember'
    ),
  ),
  // this configuration replaces the regular groups listing in the directory tree with
  // a hard-coded list of groups, each listing entries with the configured base DN and filter.
  // if the 'groups' option from above is set, it'll be shown as the first entry with the name 'Groups'
  'group_filters' => array(
    'departments' => array(
      'name'    => 'Company Departments',
      'scope'   => 'list',
      'base_dn' => 'ou=Groups,dc=mydomain,dc=com',
      'filter'  => '(|(objectclass=groupofuniquenames)(objectclass=groupofurls))',
      'name_attr' => 'cn',
    ),
    'customers' => array(
      'name'    => 'Customers',
      'scope'   => 'sub',
      'base_dn' => 'ou=Customers,dc=mydomain,dc=com',
      'filter'  => '(objectClass=inetOrgPerson)',
      'name_attr' => 'sn',
    ),
  ),
);


// An ordered array of the ids of the addressbooks that should be searched
// when populating address autocomplete fields server-side. ex: array('sql','Verisign');
$config['autocomplete_addressbooks'] = array('sql', 'ldap');

// show address fields in this order
// available placeholders: {street}, {locality}, {zipcode}, {country}, {region}
$config['address_template'] = '{street}<br/>{zipcode} {locality}<br/>{region} {country}';

// Enables possibility to log in using email address from user identities
$config['user_aliases'] = true;

//
// Plugins config
//
$config['attachment_reminder'] = true;

$config['newmail_notifier_basic'] = true;
$config['newmail_notifier_desktop'] = true;

$config['managesieve_host'] = 'mail.osixia.net';
$config['managesieve_port'] = 4190;
$config['managesieve_usetls'] = true;

$config['managesieve_conn_options'] = array(
    'ssl'         => array(
      'verify_peer'  => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true,
    ),
  );

$config['enable_installer'] = true;

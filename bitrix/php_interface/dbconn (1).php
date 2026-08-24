<?
define("BX_USE_MYSQLI", true);
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "kii_main";
$DBPassword = "jkasdjWKdj212l21";
$DBName = "ucp_main";
$DBDebug = false;
$DBDebugToFile = false;


define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define('BX_UTF', true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~BX_DIR_PERMISSIONS);
define("BX_DISABLE_INDEX_PAGE", true);
ini_set("memory_limit", "512M"); 
//define('BX_CRONTAB_SUPPORT', true);

//2021.03.10
define("BX_TEMPORARY_FILES_DIRECTORY", "/var/www/ucp.by/data/www/tmp");

define("BX_CACHE_TYPE", "memcache");
define("BX_CACHE_SID", $_SERVER["DOCUMENT_ROOT"]."#01");
define("BX_MEMCACHE_HOST", "127.0.0.1");
define("BX_MEMCACHE_PORT", "11211");

date_default_timezone_set("Etc/GMT+3");

?>
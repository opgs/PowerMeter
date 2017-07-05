<?php
/*
OPGS Power v1 10/03/2017 L Bridges
*/

header("X-UA-Compatible: IE=edge");

$SITE = new stdClass();

session_start();

ob_start();

require('d:\dev\opgslib\opgslib.php');

$SETTINGS = new INI('settings.ini', 'powersettingsdat', false);
$SETTINGS->getSection('site', $SITE);

$AD = new ADFS($SITE->simplesamlpath, $SITE->adfsname, $SITE->adfsAdminGroup);
$AD->forceAuth();
if(!($AD->checkGroup('Teachers') || $AD->checkGroup('Support Staff')) && htmlspecialchars($_GET['page']) != 'accessdenied')
{
	header('Location: ' . $SITE->path . '/index.php?page=accessdenied');
	exit();
}

$LDAP = new LDAP($SITE->ldap, $SITE->ldapuser, $SITE->ldappass, $SITE->ldapDN);

/*$SQL = new SQL($SITE->sqlinstance, $SITE->sqldbname, $SITE->sqlusername, $SITE->sqlpassword);*/

/*$LOG = new LOG($AD, 'SQL', $SQL);*/

$debug = ob_get_clean();
ob_end_clean();
require('theme/header.php');
require('theme/footer.php');
require('lang/opgs.php');

if(isset($_GET['page']))
{
	if(htmlspecialchars($_GET['page']) == 'chart'){include('sys/chart.php');}else
	if(htmlspecialchars($_GET['page']) != 'home'){header('Location: ' . $SITE->path . '/index.php?page=home');exit();}
}else{
	header('Location: ' . $SITE->path . '/index.php?page=home');
	exit();
}

?>

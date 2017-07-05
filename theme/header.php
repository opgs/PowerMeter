<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=310, initial-scale=1">
<title><?php echo $SITE->title; ?></title>
<link rel="stylesheet" href="<?php echo $SITE->path ?>/theme/css/opgs.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<?php if($AD->isAdmin()){ ?><link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css"><?php } ?>
<?php echo '<link rel="stylesheet" href="' . $SITE->path . '/theme/css/' . htmlspecialchars($_GET['page']) . '.css" />'; ?>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/raphael-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/justgage.js"></script>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo $SITE->path; ?>/js/jquery.flot.navigate.min.js"></script>
</head>
<body>
<div id="container"><div id="topLinks">
<?php if($AD->isAdmin()){echo '<a href="' . $SITE->path . '/?page=admin-summary">Admin</a>';} ?>
</div><div id="content">
<?php
$header = ob_get_clean();
?>

<?php
require APPROOT.'/views/inc/header.php';
echo $data['title'];
?>
<p><?php echo $data['description']; ?></p>
<div><strong>Version: <?php echo VERSION; ?></strong></div>
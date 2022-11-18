<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Shwe Web Hosting">
<meta name="document-classification" content="">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="10 Days">
<meta name="optimised-by" content="Hein Soe www.heinsoe.pro">
<meta name="copyright" content="copyright (c) 20018-<?php echo date('Y');?> by Shwe Web Hosting">


						$connn->query("SELECT * FROM cart WHERE stock_id='$stock_id' AND order_id!!=0 ORDER BY id DESC");
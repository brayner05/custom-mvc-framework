<?php
/* Smarty version 5.5.1, created on 2025-06-12 16:38:32
  from 'file:foo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684b0288f2a832_91400505',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acc3584c5d20063119e3a7e53a6d601d45393914' => 
    array (
      0 => 'foo.tpl',
      1 => 1749746237,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684b0288f2a832_91400505 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/brayden/Projects/php/mvc-framework/app/Views';
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foo</title>
</head>

<body>
    <h1><?php echo $_smarty_tpl->getValue('message');?>
, <?php echo $_smarty_tpl->getValue('recipient');?>
!</h1>
</body>

</html><?php }
}

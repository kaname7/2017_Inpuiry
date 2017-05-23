<?php
/* Smarty version 3.1.30, created on 2017-05-23 18:25:12
  from "/home/yuukisora/Inquiry/smarty/templates/smarty_test.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5923fff8be81a3_49299388',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cd581f47cfc2a6c615e27a62ed7d8c37f7caeda' => 
    array (
      0 => '/home/yuukisora/Inquiry/smarty/templates/smarty_test.tpl',
      1 => 1495531507,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5923fff8be81a3_49299388 (Smarty_Internal_Template $_smarty_tpl) {
?>


Smartyテスト<br>
入力された文字は"<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"です。
連想配列の場合、<?php echo $_smarty_tpl->tpl_vars['ar']->value['a'];?>
や<?php echo $_smarty_tpl->tpl_vars['ar']->value['b'];?>
です。<?php }
}

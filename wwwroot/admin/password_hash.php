<pre>
<?php

/*
�p�X���[�h�̕ۑ��̎d��
�E�����i���̂܂܁j�F�ň��I
�Ehash�֐����g���F�_���I
�Esalt+hash�֐��F�_��
�E�i���[�U�ʂ�salt+hash�֐��j*��������i�X�g���b�`�j�FOK
�Epasword_hash���g���FOK
*/
// password_hash.php
//http://dev2.m-fr.net/yuukisora/Inquiry/wwwroot/admin/password_hash.php
$raw_pass = 'password';
$t_start = microtime(true);
$pass = password_hash($raw_pass, PASSWORD_DEFAULT);
$t_end = microtime(true);
//
var_dump($raw_pass, $pass);
var_dump($t_end - $t_start);

//�����p�R�[�h
$t_start = microtime(true);
$pass_md5 = md5($raw_pass);
$t_end = microtime(true);
var_dump($t_end - $t_start);

$t_start = microtime(true);
$pass_sha1 = sha1($raw_pass);
$t_end = microtime(true);
var_dump($t_end - $t_start);

var_dump($pass_md5, $pass_sha1);
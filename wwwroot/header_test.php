<?php
//header_test.php
//�w�b�_���o�͂���̂Ńo�b�t�@�����O
ob_start();

//�����҂�
sleep(5);

//�]�v�ȏo��
echo 'test';

//�ړ�������
header('Location: http://google.com');//location���ړ�������


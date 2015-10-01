<?php
include 'AccountFactory.php';
include 'AccountManager.php';

$accountManager = new AccountManager();

$account = AccountFactory::getAccount($accountManager, AccountFactory::ACCOUNT_TYPE_CURRENT);
$account->depositFounds(200);
$account->displayBalance();
$account->getOverdraft()->appliedAgreedOverdraft(500);

$account->displayBalance();

$account->withdrawFunds(300);
$account->displayBalance();

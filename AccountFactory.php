<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/09/15
 * Time: 09:44
 */

include 'CurrentAccount.php';

class AccountFactory {
    const ACCOUNT_TYPE_CURRENT = 1;



    public static function getAccount($accountManager, $accountType) {
        switch ($accountType) {
            case self::ACCOUNT_TYPE_CURRENT:
                $account = new CurrentAccount($accountManager);
                $account->openAccount();

                echo 'Current Account has been opened' . PHP_EOL;
                return $account;
                break;

            default:
                $account = new CurrentAccount($accountManager);
                $account->openAccount();

                echo 'Current Account has been closed' . PHP_EOL;
                return $account;
                break;
        }
    }
}
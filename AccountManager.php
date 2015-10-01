<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/09/15
 * Time: 09:30
 */

class AccountManager {
    const ACTION_OPEN = 1;
    const ACTION_CLOSE = 2;


    private $accounts = array();



    public function notify($account, $action) {
        switch ($action) {
            case self::ACTION_OPEN:
                $this->addAccount($account);
                break;

            case self::ACTION_CLOSE:
                $this->removeAccount($account);
                break;
        }
    }

    public function addAccount($account) {
        $this->accounts[] = $account;
    }

    public function removeAccount($account) {
        $this->accounts = array_diff($this->accounts, [$account]);
    }
}
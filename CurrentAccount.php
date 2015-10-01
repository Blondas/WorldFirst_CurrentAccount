<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/09/15
 * Time: 09:19
 */

include 'Account.php';
include 'Overdraft.php';

class CurrentAccount implements Account{
    private $accountManager;

    private $overdraft;
    private $accountBalance = 0;



    function __construct(AccountManager $accountManager)
    {
        $this->accountManager = $accountManager;
        $this->overdraft = new Overdraft();
    }



    public function openAccount()
    {
        $this->accountManager->notify($this, AccountManager::ACTION_OPEN);
    }

    public function closeAccount()
    {
        $this->accountManager->notify($this, AccountManager::ACTION_CLOSE);
    }

    public function depositFounds($funds)
    {
        if ( !is_numeric($funds) ) {
            throw new Exception('Funds have to be numeric. ');
        }
        if ( $funds <= 0 ) {
            throw new Exception('Funds have to be positive number. ');
        }


        $overdraftFunds = $this->getOverdraft()->getOverdraftFunds();
        if ( $overdraftFunds == 0 ) {
            $this->accountBalance += $funds;
        } else {
            if ( $overdraftFunds >= $funds) {
                $this->getOverdraft()->decreaseCurrentOverdraft($funds);
            } else {
                $this->getOverdraft()->decreaseCurrentOverdraft($overdraftFunds);
                $this->accountBalance += ( $funds - $overdraftFunds );
            }
        }

        echo 'Founds have been deposited' . PHP_EOL;
    }

    public function displayBalance()
    {
        echo '-------------------' . PHP_EOL;
        echo 'CURRENT ACCOUNT: ' . $this->accountBalance . PHP_EOL;
        echo 'MONEY AVAILABLE: ' . $this->getMoneyAvailable() . PHP_EOL;
        echo 'OVERDRAFT LIMIT: ' . $this->getOverdraft()->getOverdraftLimit() . PHP_EOL;
    }

    public function withdrawFunds($funds)
    {
        if ( !is_numeric($funds) ) {
            throw new Exception('Funds have to be numeric. ');
        }
        if ( $funds <= 0 ) {
            throw new Exception('Funds have to be positive number. ');
        }

        if ( $funds > $this->getMoneyAvailable() ) {
            echo 'You can\'t withdraw more then ' . $this->accountBalance. ' ' . PHP_EOL;
        } else {
            if ($this->accountBalance >= $funds) {
                $this->accountBalance -= $funds;
            } else {
                $funds -= $this->accountBalance;
                $this->accountBalance = 0;
                $this->getOverdraft()->increaseCurrentOverdraft($funds);
            }
        }

        echo 'Founds have been withdrawn' . PHP_EOL;
    }

    public function getOverdraft()
    {
        return $this->overdraft;
    }

    private function getMoneyAvailable() {
        $moneyAvailable = $this->accountBalance + $this->overdraft->getOverdraftFunds();

        return $moneyAvailable;
    }
}
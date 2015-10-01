<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/09/15
 * Time: 09:24
 */

class Overdraft {
    private $overdraftLimit = 0;
    private $currentOverdraft = 0;
    private $applied = false;

    public function appliedAgreedOverdraft($overdraftLimit) {
        $this->applied = true;

        if ( !is_numeric($overdraftLimit) ) {
            throw new Exception('Overdraft has to be numeric. ');
        }
        if ( $overdraftLimit <= 0 ) {
            throw new Exception('Overdraft has to be positive number. ');
        }

        $this->overdraftLimit = $overdraftLimit;
    }

    /**
     * @return int
     */
    public function getOverdraftLimit()
    {
        return $this->overdraftLimit;
    }

    /**
     * @param $overdraftLimit
     */
    public function setOverdraftLimit($overdraftLimit)
    {
        $this->overdraftLimit = $overdraftLimit;
    }

    /**
     * @return int
     */
    public function getCurrentOverdraft()
    {
        return $this->currentOverdraft;
    }

    /**
     * @param $funds
     */
    public function increaseCurrentOverdraft($funds)
    {
        $this->currentOverdraft += $funds;
    }

    public function decreaseCurrentOverdraft($funds) {
        $this->currentOverdraft -= $funds;
    }

    /**
     * @return boolean
     */
    public function isApplied()
    {
        return $this->applied;
    }

    /**
     * @param boolean $applied
     */
    public function setApplied($applied)
    {
        $this->applied = $applied;
    }

    public function getOverdraftFunds() {
        if ( $this->isApplied() ) {
            return $this->getOverdraftLimit() - $this->getCurrentOverdraft();
        } else {
            return 0;
        }
    }
}
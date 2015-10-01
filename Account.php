<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/09/15
 * Time: 09:21
 */

interface Account {
    public function openAccount();
    public function closeAccount();
    public function displayBalance();
    public function depositFounds($funds);
    public function withdrawFunds($funds);
    public function getOverdraft();

}
<?php
define('CANDIDATE_USE_SUBSCRIPTION', 1);
define('CANDIDATE_USE_SUBSCRIPTION_URL', 'candidate.php?action=home');
class RediectConfig{
    
    public static function getRedirectUrl($type){
        switch($type){
            case CANDIDATE_USE_SUBSCRIPTION:
                return CANDIDATE_USE_SUBSCRIPTION_URL;
                break;
        }
    }
}

 
?>
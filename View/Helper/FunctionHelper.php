<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppHelper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class FunctionHelper extends AppHelper {


    public function getActiveText($val=0){

        $val = ($val==null) ? 0 : $val;
        $Arr = array('Inactive','Active');
        return $Arr[$val];
    }

    public function getGoodFaultyText($val=0){

        $val = ($val==null) ? 0 : $val;
        $Arr = array('Faulty','Good');
        return $Arr[$val];
    }


    public function getUsersList($eventUsers){
        $users = '';
        if(!empty($eventUsers)){
            foreach($eventUsers as $idx=>$user){
                $users .= $user['User']['username'];
                if(isset($eventUsers[$idx+1])){
                    $users .= ", ";
                }
            }
        }

        return $users;
    }

    public function isLeadComplete($val = 0){
        $val = ($val==null) ? 0 : $val;
        $Arr = array('No','Yes');
        return $Arr[$val];
    }

    public function getYesNo($val = 0){
        $val = ($val==null) ? 0 : $val;
        $Arr = array('No','Yes');
        return $Arr[$val];
    }

    public function getFormatedDate($date){
        return date('j M Y',strtotime($date));
    }

    public function getFormatedDateTime($datetime){
        if($this->validateDate($datetime)){
            return date('j M, Y H:m:sA',strtotime($datetime));
        }else{
            return 'Not Available';
        }
    }


    function validateDate($date)
    {
        return ($date !='' || $date!= NULL);
    }


    function happendBefore($datetime){

        if($this->validateDate($datetime)){
            $time = strtotime($datetime);
            $time = time() - $time; // to get the time since that moment

            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
            }
        }else{
            return 'NA';
        }


    }

}

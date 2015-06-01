<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');
App::uses('AppModel', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array('Html', 'Form', 'Session');

    public $components = array(
        'Session','FileUpload','Paginator',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'homes', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),

            'authenticate'=>array(
                'Form'=>array(
                    //'fields' => array('username' => 'email_address'),
                     'scope' => array('User.status' =>true)
                )
            ),
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow( 'view');
    }


    /**
     * authenticate_webservice method
     *
     * @param array authenticate_webservice
     * @return boolean
     */
    function authenticate_webservice($webservice_array) {
        //echo '<pre>'; print_r($this->request);exit;
        $action = $this->action;
        $failure_flag = Configure::read('failure_flag');
        $api_key_missing = Configure::read('api_key_missing');
        $invalid_data = Configure::read('invalid_data');

        //echo '<pre>'; print_r(getallheaders());exit;
//      $this->identify_device($_SERVER['HTTP_USER_AGENT']);
        $apiKey  = isset(getallheaders()['Api_key']) ? getallheaders()['Api_key'] : '';

        if (in_array($action, $webservice_array)) {

            if(trim($apiKey)==''){
                $data = array('status' => $api_key_missing, 'message' => '401 unauthorized!, api key missing','user_msg'=>'Something went wrong, try again.');
                echo json_encode($data);
                exit();
            }

            if ($this->request->ext == 'json' && $this->_verify_token($apiKey)) {
                $saved_user_details = Configure::read('user_auth_data');
                $username = $saved_user_details['username'];
                $password = $saved_user_details['password'];

                if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
                    if ($_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $password) {
                        return true;
                    }
                    else {
                        $data = array('status' => $invalid_data, 'message' => '401 unauthorized!.Header auth failed.','user_msg'=>'Something went wrong, try again.');
                        echo json_encode($data);
                        exit();
                    }
                }
                else {
                    $data = array('status' => $invalid_data, 'message' => '401 unauthorized!.Header is not set.','user_msg'=>'Something went wrong, try again.');
                    echo json_encode($data);
                    exit();
                }
            }else {
                if ($this->request->ext == 'json') {
                    $data = array('status' => $invalid_data, 'message' => '401 unauthorized!.Invalid api key.','user_msg'=>'Something went wrong, try again.');
                    echo json_encode($data);
                    exit();
                }
                else {
                    $data = array('status' => $invalid_data, 'message' => '401 unauthorized!.Not json format.','user_msg'=>'Something went wrong, try again.');
                    echo json_encode($data);
                    exit();
                }
            }
        }
    }


    function _verify_token($apiKey) {//Assume that request will always be POST
        $private_key = Configure::read('private_key_hash');

        $return_flag = false;
//      $query_string = 'http://54.169.114.189'. $_SERVER['REQUEST_URI'];
        $query_string = 'http://' . $_SERVER['SERVER_ADDR'] . $_SERVER['REQUEST_URI'];

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $received_token = $apiKey;
            ksort($data);
            foreach ($data as $index => $info) {
                $query_string.=$index . $info;
            }

            //echo $query_string;exit;
            $computed_token = hash_hmac('sha1', $query_string, $private_key);
            //echo $computed_token; exit;
//            $computed_token = "master_token";
//             $abc = $this->request->ext == "json";
//
//            $token_verofication=  $computed_token == $received_token;
//            $test_array['test_response'] = array('query_string'=>$query_string,'verify_token_status'=>$token_verofication,'computed_token'=>$computed_token,'received_token'=>$received_token,'receved_data' => $this->request, 'json' => $abc, );
//            echo json_encode($test_array);
//            exit();
//           echo $computed_token = $received_token;
            if ($computed_token == $received_token) {
                $return_flag = true;
            }
            else {
                $return_flag = false;
            }
        }
        else {
            $return_flag = false;
        }
        return $return_flag;
    }
}

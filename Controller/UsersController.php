<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('login','logout'));
        $webservice_array = array('applogin','forgotPassword','resetPassword');
        if ($this->authenticate_webservice($webservice_array)) {
            $this->Auth->allow($webservice_array);
        }
    }


    public function login() {

        $this->layout ='login';
        if($this->Auth->loggedIn()){
            $this->redirect(array('controller'=>'homes','action'=>'index'));
        }
        if ($this->request->is('post')) {
            $useData['User']  = $this->request->data;
            unset( $this->request->data);
            $this->request->data = $useData;
           if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'), 'default', array(), 'error');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
        $this->Paginator->settings =array(
            'limit'=>1
        );
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array(), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array(), 'error');
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array(), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array(), 'error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'), 'default', array(), 'success');
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'default', array(), 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function applogin(){
        try {
            $failure_flag = Configure::read('failure_flag');
            $success_flag = Configure::read('success_flag');
            $data_missing = Configure::read('data_missing');
            $invalid_data = Configure::read('invalid_data');

            $return_data = array('status' => $failure_flag);
            $number_of_parameters = 2;
            //echo '<pre>'; print_r($this->request->data);exit;
            $received_num_paramenter = count($this->request->data);
            $data = array();
            if ($this->request->is('post') && $received_num_paramenter == $number_of_parameters) {
                $received_data = $this->request->data;
                if (isset($received_data['email']) && isset($received_data['password'])) {
                    $password = !empty($received_data['password']) ? trim($received_data['password']) : '';
                    $encrypted_password = AuthComponent::password($password);
                    $email = trim($received_data['email']);


                    if ($password != "" && !empty($email)) {

                        $user_exists = $this->User->api_login($email,$encrypted_password);
                        //echo '<pre>'; print_r($user_exists);exit;
                        if (empty($user_exists)) {
                            $return_data = array('status' => $invalid_data, 'message' => "Invalid login details.",'user_msg'=>'Invalid email or password');
                            //echo json_encode($return_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                            echo json_encode($return_data); exit();
                        } else {
                            $events = $events = $this->User->Event->getEventsWithAllAssignedUsers();
                            $this->loadModel('Lead');
                            $leads = $this->Lead->getAllLeadsAndUsers($user_exists['User']['id']);

                            $user_exists = array('user'=>$user_exists,'events'=>$events,'leads'=>$leads);
                            $return_data = array('status' => $success_flag, 'data' => $user_exists, 'message' => 'User login is successful.','user_msg'=>'Logged In successfully');
                        }
                    }
                    else {
                        if (empty($email)) {
                            $return_data = array('status' => $data_missing, 'message' => 'Please provide email.','user_msg'=>'Please provide email.');
                        }
                        else if (empty($password)) {
                            $return_data = array('status' => $data_missing, 'message' => 'Please provide password.','user_msg'=>'Please provide password.');
                        }
                    }
                }
                else {
                    $return_data = array('status' => $data_missing, 'message' => 'Some paramenters are missing.','user_msg'=>'Please enter email and password');
                }
            }
            else {
                if (!$this->request->is('post')) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Method has to be post.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter < $number_of_parameters) {

                    $return_data = array('status' => $failure_flag, 'message' => 'Some paramenter is missing.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter > $number_of_parameters) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Some extra parameter is entered.','user_msg'=>'Something went wrong, try again.');
                }
            }
//            echo json_encode($return_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            echo json_encode($return_data);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
        } catch (Exception $e) {
            $return_data = array('status' => $failure_flag, 'message' => "Error occured." . $e->getMessage(),'user_msg'=>'Something went wrong, try again.');
            echo json_encode($return_data);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
//            $this->write_to_log($e);
        }
    }



    public function forgotPassword(){
        try {
            $failure_flag = Configure::read('failure_flag');
            $success_flag = Configure::read('success_flag');
            $data_missing = Configure::read('data_missing');
            $invalid_data = Configure::read('invalid_data');

            $return_data = array('status' => $failure_flag);
            $number_of_parameters = 1;
            //echo '<pre>'; print_r($this->request->data);exit;
            $received_num_paramenter = count($this->request->data);
            $data = array();
            if ($this->request->is('post') && $received_num_paramenter == $number_of_parameters) {
                $received_data = $this->request->data;
                if (isset($received_data['email']) && !empty($received_data['email'])) {
                    $user = $this->User->getUserDetailsByEmail($received_data['email']);
                    if(!empty($user)){
                        $passwordToken = $this->User->generatePasswordToken($user['User']['id']);
                        if($passwordToken){
                            $responseData = array('forgotPasswordToken'=>$passwordToken);
                            $return_data = array('status' => $success_flag,'data'=>$responseData, 'message' => 'generated password token.','user_msg'=>'Please enter password token,new password and confirm password.');
                        }else{
                            $return_data = array('status' => $failure_flag, 'message' => 'Could not generate password token.','user_msg'=>'Something went wrong, please try again.');
                        }
                    }else{
                        $return_data = array('status' => $invalid_data, 'message' => 'No record found.','user_msg'=>'No account found with that email address.');
                    }
                }else {
                    $return_data = array('status' => $data_missing, 'message' => 'Email field is missing.','user_msg'=>'Please enter email address');
                }
            } else {
                if (!$this->request->is('post')) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Method has to be post.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter < $number_of_parameters) {

                    $return_data = array('status' => $failure_flag, 'message' => 'Some paramenter is missing.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter > $number_of_parameters) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Some extra parameter is entered.','user_msg'=>'Something went wrong, try again.');
                }
            }
//            echo json_encode($return_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            echo json_encode($return_data);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
        } catch (Exception $e) {
            $return_data = array('status' => $failure_flag, 'message' => "Error occured." . $e->getMessage(),'user_msg'=>'Something went wrong, try again.');
            echo json_encode($return_data);
            $this->write_to_log($e);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
//            $this->write_to_log($e);
        }
    }

    public function resetPassword(){
        try {
            $failure_flag = Configure::read('failure_flag');
            $success_flag = Configure::read('success_flag');
            $data_missing = Configure::read('data_missing');
            $invalid_data = Configure::read('invalid_data');

            $return_data = array('status' => $failure_flag);
            $number_of_parameters = 3;
            //echo '<pre>'; print_r($this->request->data);exit;
            $received_num_paramenter = count($this->request->data);
            $data = array();
            if ($this->request->is('post') && $received_num_paramenter == $number_of_parameters) {
                $received_data = $this->request->data;
                if (isset($received_data['password_token']) && isset($received_data['password']) && isset($received_data['confirm_password'])) {
                    if(!empty($received_data['password_token']) && !empty($received_data['password_token']) && !empty($received_data['password_token'])){
                        $resetPasswordResult = $this->User->resetPassword($received_data['password_token'],$received_data['password'],$received_data['confirm_password']);
                        if($resetPasswordResult === true){
                            $return_data = array('status' => $success_flag, 'message' => 'password updated successfully.','user_msg'=>'Password updated successfully');
                        }else{
                            if($resetPasswordResult=='invaliduser'){
                                $return_data = array('status' => $invalid_data, 'message' => 'Invalid password token.','user_msg'=>'Password token is invalid or expired.');
                            }else{
                                $return_data = array('status' => $failure_flag, 'message' => 'Could not reset pasword.','error'=>$this->User->validationErrors,'user_msg'=>'Cloud not reset password, please try again.');
                            }
                        }
                    }else{
                        $return_data = array('status' => $invalid_data, 'message' => 'Please enter password token, password or confirm password fields missing','user_msg'=>'Please enter password token, new password and confirm password ');
                    }

                }else {
                    $return_data = array('status' => $data_missing, 'message' => 'either password token, password or confirm password fields are missing','user_msg'=>'Something went wrong, please try again ');
                }
            } else {
                if (!$this->request->is('post')) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Method has to be post.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter < $number_of_parameters) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Some paramenter is missing.','user_msg'=>'Something went wrong, try again.');
                }
                else if ($received_num_paramenter > $number_of_parameters) {
                    $return_data = array('status' => $failure_flag, 'message' => 'Some extra parameter is entered.','user_msg'=>'Something went wrong, try again.');
                }
            }
//            echo json_encode($return_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            echo json_encode($return_data);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
        } catch (Exception $e) {
            $return_data = array('status' => $failure_flag, 'message' => "Error occured." . $e->getMessage(),'user_msg'=>'Something went wrong, try again.');
            echo json_encode($return_data);
            $this->write_to_log($e);
            exit();
//            $this->set(array(
//                'response' => $return_data,
//                '_serialize' => array('response')
//            ));
//            $this->write_to_log($e);
        }
    }
}

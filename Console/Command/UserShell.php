<?php

class UserShell extends AppShell {

    public $uses = array('User','Role');

    public function main() {

        $this->out('<info>Available commands : </info>');
        $this->out('2. Add user : user add');
    }


    public function add() {

        $roles = $this->Role->find('all');
        if(empty($roles)){
            $this->Role->save(array('role_name'=>'Admin'));
            $role = $this->Role->find('first');
            $role_id = $role['Role']['id'];
        }else{
            $role_id = $roles[0]['Role']['id'];
        }


        $emailAddress = $this->in('Enter email address');
        $username = $this->in('Enter Username');
        $password = $this->in('Enter password');

        $data = array(
            'role_id'=>$role_id,
            'email_address'=>$emailAddress,
            'username'=>$username,
            'password'=>$password
        );
        if($this->User->save($data)){
            $this->out('<comment>User added successfully</comment>');
        }else{
            $this->out('<error>Sorry, could not add role, please try again</error>');
        }
    }

}
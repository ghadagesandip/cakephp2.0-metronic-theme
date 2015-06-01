<?php

class RoleShell extends AppShell {

    public $uses = array('Role');

    public function main() {

        $this->out('<info>Available commands : </info>');
        $this->out('1. List roles use : role show ');
        $this->out('2. Add role : role add RoleName');
    }

    public function show() {
        $roles = $this->Role->find('all');
        if(!empty($roles)){
            $this->out('<info>Available roles are : </info>');
            foreach($roles as $role){
                $this->out($role['Role']['role_name']);
            }
        }else{
            $this->out('<info>No roles are not added yet</info>');
        }
    }

    public function add() {
        $this->out('add role ' . $this->args[0]);
        if(!empty($this->args[0])){
           if($this->Role->save(array('role_name'=>$this->args[0]))){
               $this->out('<comment>Role '.$this->args[0].'added successfully</comment>');
           }else{
               $this->out('<error>Sorry, could not add role, please try again</error>');
           }
        }
    }

}
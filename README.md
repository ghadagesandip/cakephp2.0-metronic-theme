# cakephp2.0-metronic-theme

## How to setup applications ?
  - clone code in apache webroot dir, using following command.
      > git clone https://github.com/ghadagesandip/cakephp2.0-metronic-theme

  -  create database and setup connection Config/database.php
  -  Run following command to install cakephp libraries using composer
    >  composer install

  -  run following command in project roor dir to create role and users table from schema file
    >  Console/cake schema update 
    
    This will create roles and users table
    
  -  now set write permissions to /tmp dir.   
  -  change values for Security.salt and Security.cipherSeed in Config/core.php (not mandatory)
   
  -  Now, application setup is done. We have to create user to login in to system.Use following commands to create user
  
     > Console/cake user add

    ### Other available shell commands 
    
    -  List roles :
        > Console/cake role show
      
    -  Add role : 
        > Console/cake role add 'Rolename'
        
    -  Add User : 
        > Console/cake user add
     
    



 


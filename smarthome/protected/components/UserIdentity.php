<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    public function authenticate() {
        
        $user =  User::model()->findByAttributes(array('username'=> $this->username));
        $realPassword = Util::encrypt($this->password);
        if (!isset($user->attributes['username'])){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif ($user->attributes['password'] != $realPassword){
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else{
            $this->errorCode = self::ERROR_NONE;
            
            Yii::app()->session['system_id'] = UserSystem::model()
                ->findByAttributes(array('user_id'=>$user->id))
                ->attributes['system_id'];
            
            Yii::app()->session['user_name'] = 
                    $user->attributes['name'];
            Yii::app()->session['user_id'] = 
                    $user->attributes['id'];
        }
        return !$this->errorCode;
    }

    public function create($username, $password, $name) {
        $userCreated = false;
        try {
            $userModel = new User();
            $userModel->name = $name;
            $userModel->username = $username;
            $userModel->password = Util::encrypt($password);
            $userCreated = $userModel->save();

            $system = new System();
            $system->name = $name.' - system';
            $system->sensor_count = 0;
            $system->key = 12345;
            $system->outer_key = 12345;
            $system->id = $name.' - system';
            $userCreated = $userCreated && $system->save();

            $userSystem = new UserSystem();
            $userSystem->user_id = $userModel->id;
            $userSystem->system_id = $system->primaryKey;
            $userCreated = $userCreated && $userSystem->save();
            
        }
        catch (Exception $e) {
            Yii::log("Can't create user : " . $username . ", reason - " . $e->getMessage());
        }
        return $userCreated;
    }
    
    
    private function encrypt($plainString){
        return   md5(sha1($plainString.$plainString));
    }

}

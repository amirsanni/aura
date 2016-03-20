<?php

/**
 * Description of Googleaccess
 *
 * @author Amir
 */
class Googleaccess extends CI_Controller{
    protected $client = "";
    protected $objOAuthService = "";


    public function __construct() {
        parent::__construct();
        
        require_once APPPATH . "libraries/google-api-php-client-master/src/Google/autoload.php";
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

        //Store values in variables from project created in Google Developer Console
        $client_id = '964473661972-pptgthihj9u4uhq71dkhf60k43h6a63n.apps.googleusercontent.com';
        $client_secret = '8GgUsoMGmDs6pzJ2dPTGpJGu';
        $redirect_uri = base_url()."googleaccess";
        $simple_api_key = 'AIzaSyBPAWPiLz_b5CjqH7XOBcBuaCbmR9cvufk';

        // Create Client Request to access Google API
        $this->client = new Google_Client();
        $this->client->setApplicationName("Smartag");
        $this->client->setClientId($client_id);
        $this->client->setClientSecret($client_secret);
        $this->client->setRedirectUri($redirect_uri);
        $this->client->setDeveloperKey($simple_api_key);
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.profile");
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.email");

        // Send Client Request
        $this->objOAuthService = new Google_Service_Oauth2($this->client);

        // Add Access Token to Session
        if(isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

        // Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
        }
    }
    
    
    
    public function index(){
        
        // Get User Data from Google and store them in $data
        if($this->client->getAccessToken()) {
            $this->googleVal();
        }
        
        else {//get URL
            $authUrl = $this->client->createAuthUrl();
            
            
            redirect($authUrl);
            
        }// GOOGLE ENDS HERE
    }
    
    
    
    /**
     * Validates user's details gotten from google
     * @param type $objOAuthService
     */
    private function googleVal() {
        $userData = $this->objOAuthService->userinfo->get();
        $data['userData'] = $userData;
        $_SESSION['access_token'] = $this->client->getAccessToken();

        //GET EMAIL FROM GOOGLE
        $email = $data['userData']['email']; //get email from GOOGLE
        $firstName = $data['userData']['givenName']; //get first name from fb
        $lastName = $data['userData']['familyName']; //get last name from fb
        $socialId = $data['userData']['id'];
        $gender = $data['userData']['gender'] ? strtoupper($data['userData']['gender']) : "";
        $socialPass = random_string('md5'); //set random password

        if(!$email || !$firstName || !$lastName) {
            //redirect to access/login
            $_SESSION['loginErr'] = "Unable to retrieve your details from Google. Check your google account settings to ensure your details are retrieved.";
            $this->session->mark_as_flash('loginErr');

            unset($_SESSION['access_token']); //unset google's session

            redirect('access/login');
        }

        //check if email exists in db.
        $userId = $this->users->getUserId($email); //function returns userid or false

        if($userId) {//i.e. email exists
            //set session and go to dashboard
            //create sessions:
            $_SESSION['userId'] = $userId;
            $_SESSION['userCode'] = $this->users->getusercode($userId);
            $_SESSION['profilePic'] = $this->users->getprofilepic($userId);
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $this->users->getusername($userId);


            //update log in status
            $this->users->updateUserStatus($userId);
            
            //get user's other details from Google
            //will be removed later. This is here to get these details for users that registered before this was implemented
            //update user's gender
            if($gender){
                //function header: updateTableCol($tableName, $colName, $colVal, $whereCol, $whereColVal) in globalmodel
                $this->globalmodel->updateTableCol('users', 'gender', $gender, 'userId', $userId);
            }
            
            //get user's google id
            if($socialId){
                //insert user's social details into table
                //function header: updateSocialDetails($userId, $socialId, $socialName) in model 'globalmodel'
                
                //start by checking if details exist in table
                //if yes, update
                //else, insert afresh
                
                $exist = $this->globalmodel->socialDetailsExist($userId, "Google");
                
                $exist ? $this->globalmodel->updateSocialDetails($userId, $socialId, "Google")
                        :
                    $this->globalmodel->insertSocialDetails($userId, $socialId, "Google");
            }
            

            /**
             * Check if user was redirected to this page from other controllers other than "Home"
             * if yes, redirect user back to that page
             * if no, set cookie of last activity user visited and redirect to the activity
             */
            if (!empty($_GET['red_uri']) && stripos($_GET['red_uri'], "home") == FALSE) {
                redirect(urldecode($this->input->get('red_uri', TRUE)));
            }

            else {
                //set cookie of last activity visited
                $this->gen->setLastActivityCookie($userId);
                
                //then rediret to activities
                redirect('dashboard/activities');
            }
        }
        
        else {//if email doesn't exist, meaning user is signing up for the first time.
            $this->gen->handleNewSocialSignUp($email, $socialPass, $firstName, $lastName, "Google", $gender, $socialId);
        }
    }
}

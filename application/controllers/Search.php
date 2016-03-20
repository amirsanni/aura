<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'functions.php';

/**
 * Description of Search
 *
 * @author Amir <amirsanni@gmail.com>
 * June 15th, 2015
 */

class Search extends CI_Controller{
    protected $value;
    
    public function __construct() {
        parent::__construct();
		
        //determine user's device and redirect if necessary
        $this->gen->determineDevice();
        
        $this->gen->checklogin();
        
        
        $this->load->model(['searches', 'pchats', 'taskchats']);
        $this->load->library('encryption');
        $this->load->helper('text');
        
        /**
         * add searched value to global variable
         * To be used across all functions
         * Replace spaces with underscore (spaces in file names are changed to underscore during upload) and remove apostrophe
         */
        $this->value = str_replace([" ", "'"], ["_", ""], htmlentities($this->input->get('v')));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function index(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        /**
         * function will call models to do all kinds of search just to check whether there is a match for the searched value
         * in the search criteria or not
         */
        
        /**
         * get name of the searched tab user is currently viewing from js
         * Result from that tab won't be returned
         */
        $cTab = $this->input->get('c', TRUE) ? $this->input->get('c', TRUE) : "";
        
        $data = [];
        
        if($this->searches->tasksearch($this->value) !== FALSE){
            $data[] = 'Activities';
        }
        
        if($this->searches->filesearch($this->value, "image") !== FALSE){
            $data[] = 'Images';
        }
        
        if($this->searches->filesearch($this->value, "video") !== FALSE){
            $data[] = 'Videos';
        }
        
        
        if($this->searches->filesearch($this->value, "doc") !== FALSE){
            $data[] = 'Documents';
        }
        
        
        if($this->searches->filesearch($this->value, "other") !== FALSE){
            $data[] = 'Others';
        }
        
        if($this->searches->filesearch($this->value, "audio") !== FALSE){
            $data[] = 'Audios';
        }
        
        if($this->searches->todosearch($this->value) !== FALSE){
            $data[] = 'Todo';
        }
        
        if($this->searches->urlsearch($this->value) !== FALSE){
            $data[] = 'Url';
        }
        
        if($this->searches->flagsearch($this->value) !== FALSE){
            $data[] = 'Flags';
        }
        
        
        if($this->searches->taskchatsearch($this->value) !== FALSE){
            $data[] = 'Chats';
        }
        
        
        /**
         * Then remove the search tab the user is currently viewing from the array result to be sent back.
         * array_diff() returns an array of values in param 1 without the values in param 2
         */
        
        if(in_array($cTab, $data)){
            $data = array_diff($data, [$cTab]);
        }
        
        //send all matches by returning the values in the $data array
        $json = ['matches'=>array_values($data)];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function imageSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        /*
         * search all image files related to current user
         * i.e. files he uploaded, those uploaded in tasks he was part of and those shared with him etc.
         */
        
        //set variables
        $data = [];
        $taskId = "";
        
        if($this->value){
            /*
             * Set the limit of rows to return if 'f'(from) is set and valid in POST
             * This is required for pagination of the search result i.e. results returned will be from $from
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";//set limit (start) based on the value of $from. if $from is not set, fetch from 0
            
            $result = $this->searches->filesearch($this->value, "image", $limit);
            

            if($result){
            
                foreach($result as $get){
                    $name = highlight_phrase($get->origName, $this->value);
                    $mime = $get->mime;
                    $taskId = $get->taskId;
                    $chatId = $get->chatId;
                    
                    /**
                     * if file was uploaded by current user, set $uploadedBy as "You"
                     */
                    if($get->uploadedBy == $_SESSION['userId']){
                        $uploadedBy = "You";
                    }
                    
                    else{//else, get the username of the uploader
                        $uploadedBy = $this->users->getusername($get->uploadedBy);
                    }
                    
                    /**
                     * to form link to image
                     * Check if it was shared in a task or in a personal chat
                     */
                    
                    if($taskId){//if it was shared in a task
                        //set chatType to 0 for taskChats
                        $chatType = 0;
                        
                        //get task name and use in "sharedIn" variable
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                        $sharedIn = "Activity '$taskName'";
                        
                        //get other task info to be used in taskLink
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                        $rand = random_string('alnum', 50);
                        $taskLink = "v=$rand&p=$taskId&c=$taskCode&s=$taskStatus&ci=$chatId";
                        
                        //link to be used src attribute of html img tag. Use downloadLink for images with no thumbnails
                        $src = $get->thumbnail ? base_url() . $get->thumbnail : base_url() . $get->downloadLink; 
                        $link = base_url() . $get->downloadLink;//link to show full image on click
                        
                    }
                    
                    else{//if it was shared in a personal chat
                        /**
                         * set chatType to 1 for personal chats
                         * Set the sharedwith based on the id of the sharer(uploadedBy).
                         * If the currrent user shared it with someone else in an individual chat,
                         * the sharedwith value will be used but if it was shared with the current user then the id of the uploader
                         * will be used i.e.(uploadedBy)
                         */
                        
                        $chatType = 1;
                        
                        if($get->sharedWith == $_SESSION['userId']){
                            $sharedWith = $this->users->getusername($get->uploadedBy);//used the id of the sharer
                        }
                        
                        else{//use the id in column "sharedWith"
                           $sharedWith = $this->users->getusername($get->sharedWith); 
                        }
                        
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        //link to be used src attribute of html img tag. Use downloadLink for images with no thumbnails
                        $src = $get->thumbnail ? base_url() . $get->thumbnail : base_url() . $get->downloadLink; 
                        $link = base_url() . $get->downloadLink;//link to show full image on click
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->uploadedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    
                    $size = round($get->size/1000000, 2)."MB";
                    $date = date('M jS, Y H:ia', strtotime($get->dateUploaded));


                    $data[] = [
                        'name'=>$name,
                        'mime'=>$mime,
                        'taskLink'=>$taskLink,
                        'uploadedBy'=>$uploadedBy,
                        'link'=>$link,
                        'src'=>$src,
                        '_ct'=>$chatType,
                        'sharedIn'=>$sharedIn,
                        'size'=>$size,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->filesearch($this->value, "image"));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function videoSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        /*
         * search all video files related to current user
         * i.e. files he uploaded, those uploaded in tasks he was part of and those shared with him etc.
         */
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->filesearch($this->value, "video", $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $name = highlight_phrase($get->origName, $this->value);
                    $mime = $get->mime;
                    $taskId = $get->taskId;
                    $chatId = $get->chatId;
                    
                    /**
                     * if file was uploaded by current user, set $uploaddBy as "You"
                     */
                    if($get->uploadedBy == $_SESSION['userId']){
                        $uploadedBy = "You";
                    }
                    
                    else{//else, get the username of the uploader
                        $uploadedBy = $this->users->getusername($get->uploadedBy);
                    }
                    
                    /**
                     * to form link to video
                     * Check if it was shared in a task or in a personal chat
                     */
                    
                    if(!empty($taskId)){//if it was shared in a task
                        //set chatType to 0 for taskchats
                        $chatType = 0;
                        
                        //get task name and use in "sharedIn" variable
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                        $sharedIn = "Activity '$taskName'";
                        
                        //get other task info to be used in taskLink
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                        $rand = random_string('alnum', 50);
                        $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                        
                        $src = base_url() . $get->downloadLink;
                        $link = base_url() . $get->downloadLink;//link to download file on click
                    }
                    
                    else{//if it was shared in a personal chat
                        /**
                         * Set the chatType to 1 for personal chats
                         * Set the sharedwith based on the id of the sharer(uploadedBy).
                         * If the currrent user shared it with someone else in an individual chat,
                         * the sharedwith value will be used but if it was shared with the current user then the id of the uploader
                         * will be used i.e.(uploadedBy)
                         */
                        
                        $chatType = 1;
                        
                        if($get->sharedWith == $_SESSION['userId']){
                            $sharedWith = $this->users->getusername($get->uploadedBy);//used the id of the sharer
                        }
                        
                        else{//use the id in column "sharedWith"
                           $sharedWith = $this->users->getusername($get->sharedWith); 
                        }
                        
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        $src = base_url() . $get->downloadLink;;
                        $link = base_url() . $get->downloadLink;//link to show full image on click
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->uploadedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    $size = round($get->size/1000000, 2)."MB";
                    $date = date('M jS, Y H:ia', strtotime($get->dateUploaded));


                    $data[] = [
                        'name'=>$name,
                        'mime'=>$mime,
                        'taskLink'=>$taskLink,
                        'uploadedBy'=>$uploadedBy,
                        'link'=>$link,
                        'src'=>$src,
                        '_ct'=>$chatType,
                        'sharedIn'=>$sharedIn,
                        'size'=>$size,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->filesearch($this->value, "video"));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];

        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function audioSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        /*
         * search all audio files related to current user
         * i.e. files he uploaded, those uploaded in tasks he was part of and those shared with him etc.
         */
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->filesearch($this->value, "audio", $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $name = highlight_phrase($get->origName, $this->value);
                    $mime = $get->mime;
                    $taskId = $get->taskId;
                    $chatId = $get->chatId;
                    
                    /**
                     * if file was uploaded by current user, set $uploaddBy as "You"
                     */
                    if($get->uploadedBy == $_SESSION['userId']){
                        $uploadedBy = "You";
                    }
                    
                    else{//else, get the username of the uploader
                        $uploadedBy = $this->users->getusername($get->uploadedBy);
                    }
                    
                    /**
                     * to form link to audio
                     * Check if it was shared in a task or in a personal chat
                     */
                    
                    if(!empty($taskId)){//if it was shared in a task
                        //set chatType to 0 for taskchats
                        $chatType = 0;
                        
                        //get task name and use in "sharedIn" variable
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                        $sharedIn = "Activity '$taskName'";
                        
                        //get other task info to be used in taskLink
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                        $rand = random_string('alnum', 50);
                        $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                        
                        $src = base_url() . $get->downloadLink;
                        $link = base_url() . $get->downloadLink;//link to show full image on click
                    }
                    
                    else{//if it was shared in a personal chat
                        /**
                         * Set chatType to 1 for personal chats
                         * Set the sharedwith based on the id of the sharer(uploadedBy).
                         * If the currrent user shared it with someone else in an individual chat,
                         * the sharedwith value will be used but if it was shared with the current user then the id of the uploader
                         * will be used i.e.(uploadedBy)
                         */
                        
                        $chatType = 1;
                        
                        if($get->sharedWith == $_SESSION['userId']){
                            $sharedWith = $this->users->getusername($get->uploadedBy);//used the id of the sharer
                        }
                        
                        else{//use the id in column "sharedWith"
                           $sharedWith = $this->users->getusername($get->sharedWith); 
                        }
                        
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        $src = base_url() . $get->downloadLink;
                        $link = base_url() . $get->downloadLink;//link to download file on click
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->uploadedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    $size = round($get->size/1000000, 2)."MB";
                    $date = date('M jS, Y H:ia', strtotime($get->dateUploaded));


                    $data[] = [
                        'name'=>$name,
                        'mime'=>$mime,
                        'taskLink'=>$taskLink,
                        'uploadedBy'=>$uploadedBy,
                        'link'=>$link,
                        'src'=>$src,
                        '_ct'=>$chatType,
                        'sharedIn'=>$sharedIn,
                        'size'=>$size,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->filesearch($this->value, "audio"));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    
    public function docSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        /*
         * search all other files related to current user
         * i.e. files he uploaded, those uploaded in tasks he was part of and those shared with him etc.
         */
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->filesearch($this->value, "doc", $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $name = highlight_phrase($get->origName, $this->value);
                    $mime = $get->mime;
                    $taskId = $get->taskId;
                    $chatId = $get->chatId;
                    
                    /**
                     * if file was uploaded by current user, set $uploaddBy as "You"
                     */
                    if($get->uploadedBy == $_SESSION['userId']){
                        $uploadedBy = "You";
                    }
                    
                    else{//else, get the username of the uploader
                        $uploadedBy = $this->users->getusername($get->uploadedBy);
                    }
                    
                    /**
                     * to form link to file
                     * Check if it was shared in a task or in a personal chat
                     */
                    
                    if(!empty($taskId)){//if it was shared in a task
                        //set chatType to 0 for taskchats
                        $chatType = 0;
                        
                        //get task name and use in "sharedIn" variable
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                        $sharedIn = "Activity '$taskName'";
                        
                        
                        //get other task info to be used in taskLink
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                        $rand = random_string('alnum', 50);
                        $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                        
                        $link = base_url() . $get->downloadLink;//link to download file on click
                    }
                    
                    else{//if it was shared in a personal chat
                        /**
                         * Set chatType to 1 for personal chats
                         * Set the sharedwith based on the id of the sharer(uploadedBy).
                         * If the currrent user shared it with someone else in an individual chat,
                         * the sharedwith value will be used but if it was shared with the current user then the id of the uploader
                         * will be used i.e.(uploadedBy)
                         */
                        
                        $chatType = 1;
                        
                        if($get->sharedWith == $_SESSION['userId']){
                            $sharedWith = $this->users->getusername($get->uploadedBy);//used the id of the sharer
                        }
                        
                        else{//use the id in column "sharedWith"
                           $sharedWith = $this->users->getusername($get->sharedWith); 
                        }
                        
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        $link = base_url() . $get->downloadLink;//link to download file on click
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->uploadedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    $size = round($get->size/1000000, 2)."MB";
                    $date = date('M jS, Y H:ia', strtotime($get->dateUploaded));


                    $data[] = [
                        'name'=>$name,
                        'mime'=>$mime,
                        'taskLink'=>$taskLink,
                        'uploadedBy'=>$uploadedBy,
                        'link'=>$link,
                        '_ct'=>$chatType,
                        'sharedIn'=>$sharedIn,
                        'size'=>$size,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->filesearch($this->value, "doc"));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function otherSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        /*
         * search all other files related to current user
         * i.e. files he uploaded, those uploaded in tasks he was part of and those shared with him etc.
         */
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->filesearch($this->value, "other", $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $name = highlight_phrase($get->origName, $this->value);
                    $mime = $get->mime;
                    $taskId = $get->taskId;
                    $chatId = $get->chatId;
                    
                    /**
                     * if file was uploaded by current user, set $uploaddBy as "You"
                     */
                    if($get->uploadedBy == $_SESSION['userId']){
                        $uploadedBy = "You";
                    }
                    
                    else{//else, get the username of the uploader
                        $uploadedBy = $this->users->getusername($get->uploadedBy);
                    }
                    
                    /**
                     * to form link to file
                     * Check if it was shared in a task or in a personal chat
                     */
                    
                    if($taskId){//if it was shared in a task
                        //set chatType to 0 for taskchats
                        $chatType = 0;
                        
                        //get task name and use in "sharedIn" variable
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                        $sharedIn = "Activity '$taskName'";
                        
                        //get other task info to be used in taskLink
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                        $rand = random_string('alnum', 50);
                        $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                        
                        $link = base_url() . $get->downloadLink;//link to download file on click
                    }
                    
                    else{//if it was shared in a personal chat
                        /**
                         * Yes, now getting annoying. Sorry.
                         * Set the sharedwith based on the id of the sharer(uploadedBy).
                         * If the currrent user shared it with someone else in an individual chat,
                         * the sharedwith value will be used but if it was shared with the current user then the id of the uploader
                         * will be used i.e.(uploadedBy)
                         */
                        
                        //set chatType to 1 for personal chats
                        $chatType = 1;
                        
                        if($get->sharedWith == $_SESSION['userId']){
                            $sharedWith = $this->users->getusername($get->uploadedBy);//used the id of the sharer
                        }
                        
                        else{//use the id in column "sharedWith"
                           $sharedWith = $this->users->getusername($get->sharedWith); 
                        }
                        
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        $link = base_url() . $get->downloadLink;//link to download file on click
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->uploadedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    $size = round($get->size/1000000, 2)."MB";
                    $date = date('M jS, Y H:ia', strtotime($get->dateUploaded));


                    $data[] = [
                        'name'=>$name,
                        'mime'=>$mime,
                        'taskLink'=>$taskLink,
                        'uploadedBy'=>$uploadedBy,
                        'link'=>$link,
                        '_ct'=>$chatType,
                        'sharedIn'=>$sharedIn,
                        'size'=>$size,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->filesearch($this->value, "other"));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function flagSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        
        //set variables
        $data = [];
  
        
        if($this->value){
            //search for items flagged by user that matched the searched value
            //$taskchatIds = $this->searches->flagsearch('taskchat');//returns an array of ids or false
            
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            //search for the searched value in all taskchat
            $match = $this->searches->flagsearch($this->value, $limit);

            if($match){
                foreach($match as $get){
                    $msg = $get->flaggedItem;
                    $chatId = $get->chatId;
                    $chatType = $get->chatType;
                    $chatTypeNum = "";
                    $dateFlagged = $get->dateFlagged;
                    $flaggedItemType = (int)$get->flaggedItemType;
                    
                    /**
                     * get info on the flagged item based on where it was shared
                     */
                    if($chatType == "taskchat"){
                        //set value of chatType. To be used by JavaScript to differentiate between the chats the flagged item is
                        $chatTypeNum = 0;
                        
                        //set variables
                        $taskName = "";
                        $taskLink = "";
                        $taskCreator = "";
                        $sharedIn = "";
                        $sharedBy = "";
                        $dateShared = "";
        
                        /**
                         * get info on the chat using the chatId
                         * function header: getChatInfo($chatId)
                         */
                        $info = $this->taskchats->getchatinfo($chatId);
                        
                        if($info){
                            foreach($info as $a){
                                $taskId = $a->taskId;
                                $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);
                                $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);
                                $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);
                                
                                $taskCreator = $this->users->getusername($this->tasks->getcreatorId($taskId));
                                
                                /**
                                * if flagged item was shared by current user, set $sharedBy as "You"
                                */
                                if($a->senderId == $_SESSION['userId']){
                                    $sharedBy = "You";
                                }

                                else{//else, get the username of the sharer
                                    $sharedBy = $this->users->getusername($a->senderId);
                                }
                    
                                $dateShared = $a->dateSent;
                                $sharedIn = "Activity '$taskName'";
                                
                                //formulate task link
                                $rand = random_string('alnum', 150);
                                $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                            }
                        }
                    }
                    
                    else if($chatType == "pchat"){
                        //set value of chatType. To be used by JavaScript to differentiate between the chats the flagged item is
                        $chatTypeNum = 1;
                        
                        /**
                         * get info on the chat using the chatId
                         * function header: getChatInfo($chatId)
                         */
                        $info = $this->pchats->getchatinfo($chatId);
                        
                        if($info){
                            foreach($info as $a){
                                $sender = $this->users->getusername($a->senderId);//get sender's name
                                $recipient = $this->users->getusername($a->recipientId);//get recipient's name
                                $dateShared = $a->dateSent;
                                
                                //set sharedIn and sharedBy based on the sender/recipient
                                if($a->senderId == $_SESSION['userId']){//if shared by current user
                                    $sharedIn = "A chat with $recipient";
                                    $sharedBy = "You";
                                }
                                
                                else{
                                    $sharedIn = "A chat with $sender";
                                    $sharedBy = $sender;
                                }
                                
                                //generate "taskLink". Details in link will be used to redirect user to the chat history page
                                //'p' in the link here will be the id of the two participants separated with an underscore
                                $rand = random_string('alnum', 50);
                                $participants = $get->uploadedBy."_".$get->sharedWith;

                                $taskLink = "v=$rand&p=$participants&ci=$chatId";
                            }
                        }
                    }
                    

                    $data[] = [
                        'msg'=>$msg,
                        'dateFlagged'=>$dateFlagged,
                        'sharedIn'=>$sharedIn,
                        'sharedBy'=>$sharedBy,
                        'dateShared'=>$dateShared,
                        'taskName'=>$taskName,
                        'taskLink'=>$taskLink,
                        'taskCreator'=>$taskCreator,
                        'type'=>$flaggedItemType,
                        '_ct'=>$chatTypeNum
                    ];
                }
            }

            else{
                $data = [];
            }
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->flagsearch($this->value));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function userSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->usersearch($this->value, $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $name = highlight_phrase($get->firstName . " " . $get->lastName, $this->value);
                    $email = highlight_phrase($get->email, $this->value);
                    $interests = $get->interests;
                    $linkedIn = $get->linkedIn;
                    $profilePic = $get->profilePic;

                    $data[] = ['name'=>$name, 
                        'email'=>$email, 
                        'interests'=>$interests, 
                        'linkedIn'=>$linkedIn, 
                        'profilePic'=>$profilePic
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value if $limit is empty
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = !$limit ? count($result) : 0;//set $numberOfMatchesFound to total count($result) if $limit is not set
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function taskSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->tasksearch($this->value, $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $taskName = highlight_phrase($get->taskName, $this->value);
                    $taskId = $get->taskId;
                    $taskCode = $get->taskCode;
                    $taskStatus = $get->status;
                    
                    //formulate task link
                    $rand = random_string('alnum', 150);
                    $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand";//link to go to task page
                    
                    if($get->description == NULL){//if task has no description
                        $description = "No description";
                    }
                    
                    else{
                        $description = $get->description;
                    }
                    
                    
                    /**
                     * Set creator name
                     * Use "You" if current user is the creator
                     */
                    if($get->createdBy == $_SESSION['userId']){
                        $creatorName = "You";
                    }
                    
                    else{
                        $creatorName = $this->users->getusername($get->createdBy);
                    }
                    
                    
                    $dateCreated = date('M jS, Y H:ia', strtotime($get->dateCreated));
                    $startDate = date('M jS, Y H:ia', strtotime($get->startDate));
                    $dueDate = date('M jS, Y H:ia', strtotime($get->dueDate));


                    $data[] = [
                        'name'=>$taskName,
                        'link'=>$taskLink,
                        'description'=>$description,
                        'creatorName'=>$creatorName,
                        'dateCreated'=>$dateCreated,
                        'startDate'=>$startDate,
                        'dueDate'=>$dueDate
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = $this->searches->tasksearch($this->value);
        
        //include 'nor' in json if number of matches found is greater than zero
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    
    public function todoSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        
        //set variables
        $data = [];
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->todosearch($this->value, $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $item = highlight_phrase($get->todoName, $this->value);
                    $date = date('M jS, Y H:ia', strtotime($get->dateAdded));


                    $data[] = [
                        'item'=>$item,
                        'date'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value if $limit is empty
         * and include it in the json array only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = $this->searches->todosearch($this->value);
        
        //include 'nor' in json if number of matches found is greater than zero
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    public function urlSearch(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        
        //set variables
        $data = [];
        $taskLink = "";
        $taskCreator = "";
        
        if($this->value){
            /*
             * Set the limit of rows to return if both 'f'(from) and 't'(to) are set and valid in POST
             */
            $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";
            
            $limit = $from ? "$from, 10" : "0, 10";
            
            $result = $this->searches->urlsearch($this->value, $limit);

            if($result !== FALSE){
                foreach($result as $get){
                    $url = $get->link;
                    $chatId = $get->chatId;
                    
                    /**
                    * if link was shared by current user, set $sharedBy as "You"
                    */
                    if($get->addedBy == $_SESSION['userId']){
                        $sharedBy = "You";
                    }

                    else{//else, get the username of the sharer
                        $sharedBy = $this->users->getusername($get->addedBy);//user that shared the link
                    }
                    
                    
                    $sharedIn = $get->sharedIn;//where it was shared. In a task or personally
                    
                    //set task name if the url was shared in a task
                    if($sharedIn == "Task"){
                        //set chatType to 0 for taskchats
                        $chatType = 0;
                        $taskId = $get->taskId;
                        $taskCode = $this->tasks->getTaskCol("taskCode", "taskId", $taskId);//task code
                        $taskName = $this->tasks->getTaskCol("taskName", "taskId", $taskId);//name of the task it was shared in
                        $creatorId = $this->tasks->getTaskCol("createdBy", "taskId", $taskId);//id of the task creator
                        $taskStatus = $this->tasks->getTaskCol("status", "taskId", $taskId);//status of the task
                        
                        /**
                         * Set taskCreator as "You" if it was created by current user
                         */
                        if($creatorId == $_SESSION['userId']){
                            $taskCreator = "You";
                        }
                        
                        else{
                            $taskCreator = $this->users->getusername($creatorId);
                        }
                        
                        
                        $sharedIn = "Activity '$taskName'";
                        
                        //formulate task link
                        $rand = random_string('alnum', 50);
                        $taskLink = "t=$rand&p=$taskId&c=$taskCode&s=$taskStatus&v=$rand&ci=$chatId";//link to go to task page
                    }
                    
                    else{
                        //set chatType to 1 for personal chats
                        $chatType = 1;
                        
                        $sharedWith = $this->users->getusername($get->sharedWith);
                        
                        $sharedIn = "A chat with $sharedWith";
                        
                        //generate "taskLink". Details in link will be used to redirect user to the chat history page
                        //'p' in the link here will be the id of the two participants separated with an underscore
                        $rand = random_string('alnum', 50);
                        $participants = $get->addedBy."_".$get->sharedWith;
                        
                        $taskLink = "v=$rand&p=$participants&ci=$chatId";
                    }
                    
                    $date = date('M jS, Y H:ia', strtotime($get->dateAdded));


                    $data[] = [
                        'url'=>$url, 
                        'sharedBy'=>$sharedBy,
                        'sharedIn'=>$sharedIn,
                        'taskCreator'=>$taskCreator,
                        'taskLink'=>$taskLink,
                        '_ct'=>$chatType,
                        'dateShared'=>$date
                        ];
                }
            }

            else{
                $data = [];//no match found
            }
        }
        
        /*
         * count the number of rows that matches the searched value
         * and include it in the json array only if the count is greater than 0
         */
        $numberOfMatchesFound = $this->searches->urlsearch($this->value);
        
        //include 'nor' in json if number of matches found is greater than zero
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    
    /**
     * 'tcs_' = taskChatSearch
     * @return type
     */
    public function tcs_(){
        //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        
        /*
        * Set the limit of rows to return if 'f'(from) is set and valid in POST
        * This is required for pagination of the search result i.e. results returned will be from $from
        */
        $from = only_int($this->input->get('f', TRUE)) ? $this->input->get('f', TRUE) : "";

        $limit = $from ? "$from, 10" : "0, 10";//set limit (start) based on the value of $from. if $from is not set, fetch from 0

        $result = $this->searches->taskchatsearch($this->value, $limit);


        if($result){

            foreach($result as $get){
                $chatId = $get->id;
                $msg = $get->msg;
                $taskId = $get->taskId;
                $taskCode = $this->globalmodel->getTableCol('tasks', 'taskCode', 'taskId', $taskId);
                $taskCreator = $this->users->getusername($this->globalmodel->getTableCol('tasks', 'createdBy', 'taskId', $taskId));
                $sharedBy = $this->users->getusername($get->senderId);
                $dateSent = $get->dateSent;
                $sharedIn = "Activity " . $this->globalmodel->getTableCol('tasks', 'taskName', 'taskId', $taskId);
                $rand = generateRandomCode(50, 60, "");//to be used in taskLink
                $taskLink = "v=$rand&p=$taskId&c=$taskCode&ci=$chatId";

                $data[] = [
                    'msg'=>$msg,
                    '_ti'=>$taskId,
                    'sharedBy'=>$sharedBy,
                    'sharedIn'=>$sharedIn,
                    'taskLink'=>$taskLink,
                    'taskCreator'=>$taskCreator,
                    'dateShared'=>$dateSent,
                    '_ct'=>0
                    ];
            }
        }

        else{
            $data = [];//no match found
        }
        
        /*
         * count the number of rows that matches the searched value to use as number of matces found
         * and include it in the json array but only if the count is greater than 0 OR if $from is not set
         * 'nor' = "Number of Results"
         */
        $numberOfMatchesFound = count($this->searches->taskchatsearch($this->value));
        
        //include 'nor' in json if number of matches found is greater than zero and $from is not set.
        $json = $numberOfMatchesFound == 0 || $from ? ['result'=>$data] : ['result'=>$data, 'nor'=>$numberOfMatchesFound];
        
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    
    /**
     * To load the chat history page
     */
    public function result(){
        
        $this->load->model(['contacts']);
        
        //get and convert totalSpace to MB since it is in bytes
        //1MB = 1,000,000 bytes
        $totalSpace = $this->globalmodel->getTableCol('users', 'totalDiskSpace', 'userId', $_SESSION['userId']);
        
        //get total disk space available for user
        $used = $this->globalmodel->getTableCol('users', 'spaceUsed', 'userId', $_SESSION['userId']);
        
        //now convert it to MB
        $spaceUsed = round($used/1000000);

        //then subtract space used from total space to get space left
        $spaceLeft = round($totalSpace - $spaceUsed, 0);//round the result to decimal places


        $values['pageTitle'] = "Search Result";
        $values['pageContent'] = $this->load->view('wordsearch', '', TRUE);
        $values['totalTasks'] = $this->taskmembers->gettotaltasks();//get total tasks user is a member of
        $values['totalContacts'] = $this->contacts->gettotalcontacts(); //get total contacts user has
        $values['spaceUsed'] = $spaceUsed . "MB";
        $values['spaceLeft'] = $spaceLeft . "MB";

        $this->load->view('inc/main', $values);
    }
}

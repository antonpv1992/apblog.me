<?php

namespace app\controllers;

use app\models\Contact;
use app\models\User;
use tools\core\base\Controller;
use tools\core\Db;
use tools\core\mappers\ActivityMapper;
use tools\core\mappers\ContactMapper;
use tools\core\mappers\PostMapper;
use tools\core\mappers\UserMapper;

class AppController extends Controller
{

    /**
     * method for determining whether a post is liked or not
     * @param array $method an array containing keys
     * @param bool|string $str a string of keys to be checked in the array
     * @return bool returns true if all keys contain valid data
     */
    protected function isLike(array $method, $str = false): bool
    {
        $arr = ($str !== false) ? explode(',', $str) : [];
        foreach($arr as $value) {
            if(!isset($method[trim($value)]) || !is_numeric($method[trim($value)])) {
                return false;
            }
        }
        return true;
    }

    /**
     * method for writing like in the author db and post db
     * @param UserMapper $users user model mapper
     * @param PostMapper $posts post model mapper
     */
    protected function likeClick(UserMapper $users, PostMapper $posts): void
    {
        $_POST['user'] = $_SESSION['user']['id'];
        if($users->isExists("id='" . $_POST['user'] . "'") && $posts->isExists("id='" . $_POST['post'] . "'") && $users->isExists("id='" . $_POST['author'] . "'")){
            $amapper = new ActivityMapper(Db::instance());
            $like = 0;
            if($_POST['res'] === '1'){
                $like = 1;
                $users->update("likes = likes + 1", "id=" .  $_POST['author']);
                $posts->update("likes = likes + 1", "id=" .  $_POST['post']);
            } else {
                $users->update("likes = likes - 1", "id=" .  $_POST['author']);
                $posts->update("likes = likes - 1", "id=" .  $_POST['post']);
            }
            if($amapper->isExists("post=" . $_POST['post'] . " AND user=" . $_POST['user'] . "")){
                $amapper->setActivity("liked=$like", "post=" . $_POST['post'] . " AND user=" . $_POST['user']);
            } else {
                $amapper->addActivity(["post" => $_POST['post'],"user" => $_POST['user'] ,"liked" => 1]);
            }
        }
    }

    /**
     * method for searching articles by title in the database
     * @param array $query query string split into an array
     * @return bool|string correct request or false
     */
    protected function searchTheme(array $query): bool|string
    {
        if(isset($_POST['query'])){
            setcookie("SearchQuery", $_POST['query'], time()+120);
        }
        if(isset($_POST['query'])){
            return "post.title LIKE '%". hsc($_POST['query']) . "%'";
        } else if(isset($_COOKIE["SearchQuery"]) && end($query) === 'search') {
            return "post.title LIKE '%". hsc($_COOKIE["SearchQuery"]) . "%'";
        } else if(end($query) !== 'posts' && end($query) !== ''){
            return "post.theme='" . end($query) . "'";
        } else {
            return false;
        }
    }

    /**
     * method for changing profile data in db
     * @param UserMapper $users user model mapper
     * @param ContactMapper $contacts contact model mapper
     */
    protected function changeUserData(UserMapper $users, ContactMapper $contacts): void
    {
        if(isset($_FILES['avatar'])){
            $blob = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
            echo file_get_contents($_FILES['avatar']['tmp_name']);
            $users->updateUserField("avatar='$blob'", "id=" . $_SESSION['user']['id']);
            exit();
        }
        $ukey = '';
        $uvalue = '';
        foreach($_POST as $key => $value){
            $ukey = $key;
            $uvalue = hsc($value);
        }
        if($users->isCol($ukey) === '1'){
            $users->updateUserField("$ukey='$uvalue'", "id=" . $_SESSION['user']['id']);
        } else if($contacts->isCol($ukey) === '1'){
            $contacts->updateContactField("$ukey='$uvalue'", "user=" . $_SESSION['user']['id']);
        }
        exit();
    }

    /**
     * method for outputting existing users by ajax
     */
    protected function dataExists(): void
    {
        $umapper = new UserMapper(DB::instance());
        $users = $umapper->getUsers("login, email");
        $array = [];
        foreach($users as $user){
            array_push($array, $user->getAllFields());
        }
        $array = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        echo $array;
        exit();
    }

    /**
     * method for user registration
     * @param array $data registration data array
     */
    protected function registrationUser(array $data): void
    {
        $umapper = new UserMapper(DB::instance());
        $cmapper = new ContactMapper(DB::instance());
        $user = new User($data, false);
        $umapper->save($user->getAllFields());
        $seance = $umapper->getUser("id, login, email, password", "login='" . $user->getLogin() . "'");
        $contact = new Contact(['user' => $seance->getID()]);
        $cmapper->save($contact->getAllFields());
        $_SESSION['user'] = $seance->getAllFields();
        setcookie("user", json_encode($seance->getAllFields(), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK), time() + (86400 * 7));
    }
}
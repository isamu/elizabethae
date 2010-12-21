<?PHP
namespace elizabethae\controller;

require_once("Services/Foursquare.php");

use velociraptor\model\user;
use velociraptor\model\OauthSession;

class userController extends \elizabethae\controller\ApplicationController{
    function loginAction(){
        $oauth = new \OAuth(ConsumerKey, ConsumerKeySecret,
                           OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_URI);
        
        $o_sess = new OauthSession();

        if(empty($_GET['oauth_token'])){
            $request_token_info = $oauth->getRequestToken("http://foursquare.com/oauth/request_token");
            $session_key = $this->generateRandomString();
            setcookie("user_sess",  $session_key, time() + 180 * 86400, '/');
            $o_sess->put($session_key, $request_token_info);
            header("Location: " . "http://foursquare.com/oauth/authorize?oauth_token=". $request_token_info["oauth_token"]);
        }else{
            $session_key = $_COOKIE["user_sess"];
            $request_token_info = $o_sess->get($session_key);
            $oauth->setToken($request_token_info["oauth_token"],$request_token_info["oauth_token_secret"]);
            $access_token_info = $oauth->getAccessToken("http://foursquare.com/oauth/access_token");
            $o_sess->put($session_key, $access_token_info);

            $oauth->setToken($access_token_info["oauth_token"],$access_token_info["oauth_token_secret"]);
            $forsq = new \Services_Foursquare($oauth);
            $res = $forsq->user();
            $xml = simplexml_load_string($res);
            $user = new User();
            if($user->find_by_4sqid((string) $xml->id)){
                $o_sess->put($session_key, array("id" => strtolower($user->id)));
            }else{
                $user->create(array("4sqid" => $xml->id,
                                    "data" => json_encode($xml)));
                $o_sess->put($session_key, array("id" => $user->id));

            }
            header("Location: http://4sq.to-kyo.to/user/mypage");
        }
    }

    function mypageAction(){
        $o_sess = new OauthSession();
        $session_key = $_COOKIE["user_sess"];
        $key = $o_sess->get($session_key);
        $user = new User();
        if(isset($key['id']) && $user->find_by_id((string) $key['id'])){
            $user_data = json_decode($user->data, true);
            $this->data['user'] = $user_data;
        }
    }

    function generateRandomString($length = 128){
        $hash = hash('sha512', microtime().mt_rand());
        for($i = 0; $i < $length/2; $i++){
            $hash_bin = sprintf("%12s",decbin(hexdec(substr($hash, ($i % 43)*3, 3))));
            $str .= substr(HASH_STR_BASE, bindec(substr($hash_bin, 0, 6)), 1);
            $str .= substr(HASH_STR_BASE, bindec(substr($hash_bin, 6, 6)), 1);
            if($i != 0 && $i % 43 == 0){
                $hash = hash('sha512', microtime().mt_rand());
            }
        }
        return $str;
    }
}
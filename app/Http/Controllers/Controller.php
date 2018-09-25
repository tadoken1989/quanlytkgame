<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Image;
use File;
use DB;

class Controller extends BaseController
{
    protected $isAdminField = 'is_admin';
    protected $redirectToAdmin = '/admin';
    protected $limit;
    protected $avatarWith;
    protected $avatarHeight;
    protected $sqlSrv;
    protected $postImage = [
        'small' => [
            'width' => 200,
            'height' => 200
        ],
        'normal' => [
            'width' => 600,
            'height' => 600
        ],
    ];
    protected $providerCard = [
        'VNP', 'VMS', 'VTT', 'MGC'
    ];
    protected $bankSupport = [
        '99001',
        '99002',
        '99003',
        '99004',
        '99005',
        '99006',
        '99007',
        '99008',
        '99009',
        '99010',
        '99011',
        '99012',
        '99013',
        '99014',
        '99015',
        '99016',
        '99017',
        '99018',
        '99019',
        '99020',
        '99021',
        '99022',
        '99023',
        '99026',
        '99027',
        '99029',
        '99030',
        '99031',
        '99032',
        '99033',
        '99034',
        '99035',
        '99036',
        '99037',
        '99038',
        '99039',

    ];

    protected $supportTxnAmount =
        [
            '20000' => '20000',
            '50000' => '50000',
            '100000' => '100000',
            '200000' => '200000',
            '500000' => '500000',
            '1000000' => '1000000',
            '2000000' => '2000000',
            '5000000' => '5000000',
        ];

    protected $fee = 0;

    protected $prefixImagePost = '/images/posts/';
    protected $apiKeySms = '3B274CD48BAA1B23CC7BB1017B3610';
    protected $secretKeySms = 'E5F58177F134B8442D2265ECAA0D76';
    protected $baseUrlApi = 'http://api.vltranhba.com/api';
    protected $apiLogin = '/user/login';
    protected $apiPayment = '/user/payment';
    protected $apiPaymentAtm = '/user/atm/payment';
    protected $apiPaymentAtmHandle = '/user/atm/payment/handle';
    protected $apiRegister = '/user/register';
    protected $apiForgot = '/user/forgot';
    protected $apiChangePass = '/user/change-pass';

    public function __construct()
    {
        $this->sqlSrv = DB::connection('sqlsrv');
        $this->limit = 20;
        $this->avatarWith = !is_null(siteSettings('avatarWith')) ? siteSettings('avatarWith') : 200;
        $this->avatarHeight = !is_null(siteSettings('avatarHeight')) ? siteSettings('avatarHeight') : 200;
        $this->userActive = !is_null(siteSettings('userActive')) ? siteSettings('userActive') : 1;
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function createSlug($text)
    {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), str_replace($a, $b, $text)));
    }

    protected function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function handleUploadAvatar($request, $user)
    {
        $img = Image::make($request->getRealPath());
        $img->resize($this->avatarWith, $this->avatarHeight);
        if (!is_dir(public_path('images/users'))) {
            File::makeDirectory(public_path('images/users'), $mode = 0777, true, true);
        }
        $filename = $user->getAttribute('id') . '_' . $this->avatarWith . '_' . $this->avatarHeight . '_' . strtotime('now') . '.jpg';
        if ($img->save(public_path('images/users/' . $filename))) {
            $user->setAttribute('avatar', '/images/users/' . $filename);
            return $user->save();
        }
        return false;
    }

    protected function handlePostImage($request, $post)
    {
        if (!is_dir(public_path($this->prefixImagePost))) {
            File::makeDirectory(public_path($this->prefixImagePost), $mode = 0777, true, true);
        }
        $image = Image::make($request->getRealPath());
        foreach ($this->postImage as $key => $value) {
            $img[$key] = clone $image;
            $img[$key]->resize($value['width'], $value['height']);
            $name = $post->getAttribute('id') . '_' . $value['width'] . '_' . $value['height'] . '_' . strtotime('now') . '.jpg';
            $img[$key]->save(public_path($this->prefixImagePost . $name));
        }
        $fileName = $post->getAttribute('id') . '_' . $this->postImage['small']['width'] . '_' . $this->postImage['small']['height'] . '_' . strtotime('now') . '.jpg';
        $post->setAttribute('image', $this->prefixImagePost . $fileName);
        return $post->save();
    }

    protected function remoteCheckLogin($username, $password)
    {
        $account = $this->sqlSrv->select("SELECT cAccName FROM Account_Info WHERE cAccName = '" . $username . "'");
        if (count($account) > 0) {
            $row = $this->sqlSrv->select("SELECT cAccName FROM Account_Info WHERE cAccName = '" . $username . "' AND cPassWord = '" . strtoupper(md5($password)) . "'");
            if (count($row) > 0) {
                return $row;
            }
        }
        return false;
    }

    protected function remoteRegisterUser($username, $pass1, $pass2)
    {
        if (!$this->checkAccountExits($username)) {
            $loginGame = $this->sqlSrv->insert("INSERT INTO Account_Info (cAccName,cPassWord,cSecPassWord,nExtPoint,nExtPoint1,nExtPoint2,nExtPoint3,nExtPoint4,nExtPoint5,nExtPoint6,nExtPoint7,iOTPSessionLifeTime,iServiceFlag) VALUES ('" . $username . "','" . strtoupper(md5($pass1)) . "','" . strtoupper(md5($pass2)) . "','1','0','0','0','0','0','0','0','0','0')");
            if ($loginGame) {
                $check = $this->sqlSrv->insert("INSERT INTO Account_Habitus(cAccName,dEndDate) VALUES('$username','" . date("Y-m-d h:s:i", (time() + 3650 * (86400))) . "')");
                if (count($check) > 0) {
                    return $loginGame;
                }
            }
        }
        return false;
    }

    protected function checkAccountExits($username)
    {

        $account = $this->sqlSrv->select("SELECT cAccName FROM Account_Info WHERE cAccName = '" . $username . "'");
        if (count($account) > 0) {
            return $account;
        }
        return false;
    }

    // update pass level 1
    protected function updatePass($username, $newPass)
    {
        $account = $this->sqlSrv->update("UPDATE Account_Info SET cPassWord = '" . strtoupper(md5($newPass)) . "' WHERE cAccName = '" . $username . "'");
        if (count($account) > 0) {
            return $account;
        }
        return false;

    }

    // update pass level 2
    protected function updatePass2($username, $newPass2)
    {
        $account = $this->sqlSrv->update("UPDATE Account_Info SET cSecPassWord = '" . strtoupper(md5($newPass2)) . "' WHERE cAccName = '" . $username . "'");
        if (count($account) > 0) {
            return $account;
        }
        return false;

    }

    public function sendSmsCode($content, $toPhone)
    {
        $sendContent = urlencode($content);
        $data = "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=" . $toPhone . "&ApiKey=" . $this->apiKeySms . "&SecretKey=" . $this->secretKeySms . "&Content=" . $sendContent . "&SmsType=4";
        $curl = curl_init($data);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);

        $obj = json_decode($result, true);
        if ($obj['CodeResult'] == 100) {
            return $obj;
        }
        return false;
    }

    public function contentMgs($code)
    {
        $mess = 'Mã xác nhận của bạn là ';
        return $mess . $code;
    }

    public function callApi($method, $url, $data = false)
    {
        $curl = curl_init();

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "app-key:base64:9UQQwPIffRI+Tvuviqq9DqKZ6UoQAoodMZG8CO1Z+ms=",
        ));

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}

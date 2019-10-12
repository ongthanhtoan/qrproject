<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
Use Session;
use DB;
class DangNhapController extends Controller
{
	public function getDangNhap(){
		return view('backend.dangnhap.dangnhap');
	}
	public function postDangNhap(Request $request){
            // Tạm thời login cán bộ sử dụng bản cán bộ để login
            $username = $request->txtUser;
            $password = $request->txtPass;
            $login = DB::table('canbo')->select('cb_TenDangNhap','cb_HoTen')->where('cb_TenDangNhap',$username)->get();
            if(count($login) > 0 && $password == $username){
                    $userInfo = array(
                        'username' => $login[0]->cb_TenDangNhap,
                        'name' => $login[0]->cb_HoTen
                    );
                    Session::put('user',$userInfo);
                    return response()->json([
                            $data = 1
                    ],200);
            }else{
                    return response()->json([
                            $data = 0
                    ],200);
            }
            //Pass máy ảo Cusc@123
//            $host = "cusc.edu.vn";
//            $port = "389";
//            $user = $request->txtUser.'@cusc.edu.vn';
//            $pass = $request->txtPass;
//            $connect = ldap_connect($host,$port);
//            ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
//            ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
//            if ($connect) {
//                    $res = @ldap_bind($connect, $user, $pass);
//                    if($res){
//            $User = ldap_search($connect,"CN=Users,DC=cusc,DC=edu,DC=vn","(SAMAccountName=$request->txtUser)");
//            $data = ldap_search($connect, "CN=Users,DC=cusc,DC=edu,DC=vn", "(&(objectClass=user)(
//             objectCategory=person))");
//            $info  = ldap_get_entries($connect, $data);
//            $entriesUser  = ldap_get_entries($connect, $User);
//            $a = explode(",", $entriesUser[0]["dn"]);
//            $b = explode("=", $a[0]);    
//            $arrayNameLogin = array();
//            $arrayNameDisplay = array();
//            for ($i=0; $i<$info["count"]; $i++)
//            {
//                $nameLogin = $info[$i]["samaccountname"][0]; // Lấy ra tên đăng nhập
//                $nameDisplay = $info[$i]['cn'][0]; // Lấy ra họ tên
//                $Checks = DB::table('canbo')->where('cb_TenDangNhap',$info[$i]["samaccountname"][0])->count();
//                if($Checks==0){
//                    $arrayNameLogin[] = $nameLogin;
//                    $arrayNameDisplay[] = $nameDisplay;
//                }
//            }
//            for($i = 0;$i < count($arrayNameLogin);$i++ ){
//                    DB::table('canbo')->insert([
//                            'cb_TenDangNhap' => $arrayNameLogin[$i],
//                            'cb_HoTen' => $arrayNameDisplay[$i],
//                            'cb_KiemKe' => 0
//                    ]);
//            }
//            $userInfo = array(
//                'username' => $request->txtUser,
//                'name' => $b[1]
//            );
//            Session::put('user',$userInfo);
//            return response()->json([
//                $data = 1
//            ],200);
//            @ldap_close($connect);
//            } else {
//            	return response()->json([
//            		$data = 0
//            	],200);
//            }
//        }
    }
    public function postDangNhapAdmin(Request $request){
    	$username = $request->txtUserA;
    	$password = $request->txtPassA;
    	$login = ['username'=>$username,'password'=>$password];
    	if(Auth::attempt($login)){
    		Session::put('admin',$username);
    		return response()->json([
    			$data = 1
    		],200);
    	}else{
    		return response()->json([
    			$data = 0
    		],200);
    	}
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LdapController extends Controller
{
    public function showLoginForm()
    {
        $title = "Login";
        return view('ldap.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $uid        = trim($request->username);
        $ldapserver = config('ldap.server', '10.1.1.2');
        $ldapuser   = config('ldap.user_domain', 'bsn.local\\') . $uid;
        $ldappass   = $request->password;
        $ldaptree   = config('ldap.tree', 'DC=BSN,DC=local');
        // dd([
        //     'uid' => $uid,
        //     'ldapserver' => $ldapserver,
        //     'ldapuser' => $ldapuser,
        //     'ldappass' => $ldappass,
        //     'ldaptree' => $ldaptree,
        // ]);
        try {
            $ldapconn = ldap_connect($ldapserver);
            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

            try {
                ldap_bind($ldapconn, $ldapuser, $ldappass);
                $filter = "(sAMAccountName=$uid)";
                $attr = array("cn", "mail", "l", "userPrincipalName");
                $result = ldap_search($ldapconn, $ldaptree, $filter, $attr) or die("Error in search query: " . ldap_error($ldapconn));
                $data = ldap_get_entries($ldapconn, $result);
                ldap_close($ldapconn);

                if ($data['count'] > 0) {
                    // cek username di sparta
                    $user = User::where('username', $uid)
                        ->where('is_active', 1)
                        ->first();

                    if ($user != NULL) {
                        Auth::login($user);
                        $request->session()->regenerate();

                        return response()->json(['success' => ['url' => route('dashboard')]]);
                        // return redirect()->route('pegawai.index');
                    } else {
                        return response()->json(['errors' => trans('auth.ldap_no_account')]);
                        // return redirect()
                        //     ->back()
                        //     ->withInput($request->only('username', 'remember'))
                        //     ->with('error', trans('auth.ldap_no_account'));
                    }
                } else {
                    return response()->json(['errors' => trans('auth.failed')]);

                    // return redirect()
                    //     ->back()
                    //     ->withInput($request->only('username', 'remember'))
                    //     ->with('error', trans('auth.failed'));
                }
            } catch (Exception $e) {
                return response()->json(['errors' => trans('auth.failed')]);

                // return redirect()
                //     ->back()
                //     ->withInput($request->only('username', 'remember'))
                //     ->with('error', trans('auth.failed'));
            }
        } catch (Exception $e) {
            return response()->json(['errors' => trans('auth.ldap_server_fail')]);

            // return redirect()
            //     ->back()
            //     ->withInput($request->only('username', 'remember'))
            //     ->with('error', trans('auth.ldap_server_fail'));
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}

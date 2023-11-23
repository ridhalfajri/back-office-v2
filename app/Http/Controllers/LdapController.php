<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
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
        // $ldapconn = ldap_connect($ldapserver);
        // ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        // ldap_bind($ldapconn, $ldapuser, $ldappass);
        // $filter = "(sAMAccountName=$uid)";
        // $attr = array("cn", "mail", "l", "userPrincipalName");
        // $result = ldap_search($ldapconn, $ldaptree, $filter, $attr) or die("Error in search query: " . ldap_error($ldapconn));
        // $data = ldap_get_entries($ldapconn, $result);
        // ldap_close($ldapconn);
        // if ($data['count'] > 0) {
        //     // cek username di backoffice
        //     $user = User::where('username', $uid)
        //         ->where('is_active', 1)
        //         ->first();

        //     if ($user != NULL) {
        //         Auth::login($user);
        //         $jabatan_definitif = PegawaiRiwayatJabatan::select('jabatan_unit_kerja_id', 'tx_tipe_jabatan_id')->where('is_now', 1)->where('is_plt', 0)->where('pegawai_id', $user->pegawai_id)->first();
        //         $jabatan_plt = PegawaiRiwayatJabatan::select('jabatan_unit_kerja_id', 'tx_tipe_jabatan_id')->where('is_now', 1)->where('is_plt', 1)->where('pegawai_id', $user->pegawai_id)->first();
        //         $request->session()->put('jabatan_definitif', $jabatan_definitif);
        //         $request->session()->put('jabatan_plt', $jabatan_plt);
        //         $request->session()->regenerate();
        //         return response()->json(['success' => ['url' => route('dashboard')]]);
        //     } else {
        //         try {
        //             $pegawai = Pegawai::where('email_kantor', $request->username . "@bsn.go.id")->first();
        //             if ($pegawai != NULL) {
        //                 $user = new User();
        //                 $user->username = $request->username;
        //                 $user->pegawai_id = $pegawai->id;
        //                 $user->is_active = 1;
        //                 $user->save();
        //             }
        //             return response()->json(['success' => ['create' => 'akun anda diaktifkan, silahkan login']]);
        //         } catch (QueryException $e) {
        //             return response()->json(['errors' => 'terjadi kesalahan koneksi']);
        //         }
        //     }
        // } else {
        //     return response()->json(['errors' => trans('auth.failed')]);
        // }
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
                var_dump($data['count'] > 0);
                var_dump($uid);
                if ($data['count'] > 0) {
                    // cek username di backoffice
                    $user = User::where('username', $uid)
                        ->where('is_active', 1)
                        ->first();

                        var_dump($user);

                    if ($user != NULL) {
                        Auth::login($user);
                        $jabatan_definitif = PegawaiRiwayatJabatan::select('jabatan_unit_kerja_id', 'tx_tipe_jabatan_id')->where('is_now', 1)->where('is_plt', 0)->where('pegawai_id', $user->pegawai_id)->first();
                        $jabatan_plt = PegawaiRiwayatJabatan::select('jabatan_unit_kerja_id', 'tx_tipe_jabatan_id')->where('is_now', 1)->where('is_plt', 1)->where('pegawai_id', $user->pegawai_id)->first();
                        $request->session()->put('jabatan_definitif', $jabatan_definitif);
                        $request->session()->put('jabatan_plt', $jabatan_plt);
                        $request->session()->regenerate();
                        return response()->json(['success' => ['url' => route('dashboard')]]);
                    } else {
                        try {
                            $pegawai = Pegawai::where('email_kantor', $request->username . "@bsn.go.id")->first();
                            if ($pegawai != NULL) {
                                $user = new User();
                                $user->username = $request->username;
                                $user->pegawai_id = $pegawai->id;
                                $user->is_active = 1;
                                $user->save();
                            }
                            return response()->json(['success' => ['create' => 'akun anda diaktifkan, silahkan login']]);
                        } catch (QueryException $e) {
                            return response()->json(['errors' => 'terjadi kesalahan koneksi']);
                        }
                    }
                } else {
                    return response()->json(['errors' => trans('auth.failed')]);
                }
            } catch (Exception $e) {
                return response()->json(['errors' => trans('auth.failed')]);
            }
        } catch (Exception $e) {
            return response()->json(['errors' => trans('auth.ldap_server_fail')]);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

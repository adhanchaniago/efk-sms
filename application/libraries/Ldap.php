<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Ldap {
	protected $_ci;

	function __construct(){
		$CI =& get_instance();

	}

	function check(){
		$headers = apache_request_headers();
if (!isset($headers['Authorization'])){
  header('HTTP/1.1 401 Unauthorized');
  header('WWW-Authenticate: NTLM');
  exit;
}
$auth = $headers['Authorization'];
if (substr($auth,0,5) == 'NTLM ') {
  $msg = base64_decode(substr($auth, 5));
  if (substr($msg, 0, 8) != "NTLMSSP\x00")
    die('error header not recognised');
if ($msg[8] == "\x01") {
    $msg2 = "NTLMSSP\x00\x02"."\x00\x00\x00\x00". // target name len/alloc
      "\x00\x00\x00\x00". // target name offset
      "\x01\x02\x81\x01". // flags
      "\x00\x00\x00\x00\x00\x00\x00\x00". // challenge
      "\x00\x00\x00\x00\x00\x00\x00\x00". // context
      "\x00\x00\x00\x00\x30\x00\x00\x00"; // target info len/alloc/offset
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: NTLM '.trim(base64_encode($msg2)));
  exit;
  }
  else if ($msg[8] == "\x03") {
    function get_msg_str($msg, $start, $unicode = true) {
      $len = (ord($msg[$start+1]) * 256) + ord($msg[$start]);
      $off = (ord($msg[$start+5]) * 256) + ord($msg[$start+4]);
      if ($unicode)
        return str_replace("\0", '', substr($msg, $off, $len));
      else
        return substr($msg, $off, $len);
    }
    $user = get_msg_str($msg, 36);
    $domain = get_msg_str($msg, 28);
    $workstation = get_msg_str($msg, 44);
    //print "You are $user from $workstation.$domain";
  }
}

return $user;
	}

	function ldap_login($id){
		$ds = "hqdom7.bussan.co.id";
	$ldap_domain = 'bussan.co.id'; // LDAP Domain
	$ldap_dn = 'dc=bussan,dc=co, dc=id'; // Domain Component
	// Jika $ldap_domain = 'mazhters.co.id'; 
	// maka $ldap_dn = 'dc=mazhters,dc=co,dc=id';
    $ldaprdn  = "CN=eyasrvc,OU=Services,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id";    
	//$ldaprdn  = "CN=itode,OU=Users,OU=IT-DataCenter & Infrastructure,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id";  
    $ldappass = 'Bussan100';
    $user = $id;
    $ou2 = "Headquarter";
    $ou3 = "Cabang";
$u1 = "OU=".$ou2.",DC=bussan,DC=co,DC=id";
$cb = "OU=".$ou3.",DC=bussan,DC=co,DC=id";
   // $pass = $_POST['pass'];
	// connect to ldap server
    $ldapconn = ldap_connect("hqdom7.bussan.co.id")
    or die("Could not connect to LDAP server.");

    if ($ldapconn) {

    // binding to ldap server
  $bind=@ldap_bind($ldapconn, $ldaprdn, $ldappass);
				if ($bind==1){
					//echo "Connected to LDAP";
					//echo "<br></br>";
					//$filter="(&(objectClass=user)(objectCategory='CN=Person,CN=Schema,CN=Configuration,DC=bussan,DC=co,DC=id')(|(mail=*)(cn=*))((userAccountControl:512)))";
					//$filter="(|(samaccountname=".$usertextbox.")(cn=".$usertextbox.")(mail=".$usertextbox."))";
					$filter="(|(samaccountname=".$user."))";
					$justthese = array("cn", "dn", "memberof", "mail",  "department", "title", "samaccountname", "sn", "displayName", "givenname");
					//$r=@ldap_search($ldapconn, $u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
					//$info=@ldap_get_entries($ldapconn, $r);
					$getUserHQ = @ldap_search($ldapconn,$u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
			$info = @ldap_get_entries($ldapconn, $getUserHQ);
			$user = array_filter($info);
			$_SESSION['user'] = $user;
			$_SESSION['cek'] = "Headquarter";
			if (empty($user)){
				$getUserCabang = @ldap_search($ldapconn, $cb, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
				$info = @ldap_get_entries($ldapconn, $getUserCabang);
			$user = array_filter($info);
			$_SESSION['cek'] = "Cabang";
			$_SESSION['user'] = $user;
			}
		//$sr=ldap_search($ldapconn, $ldap_dn, "(&(objectClass=top)(objectCategory=CN=Person,CN=Schema, CN=Configuration,DC=bussan,DC=co,DC=id)(|(mail=*@bussan.co.id)(sn=*)))", array("cn", "dn", "memberof", "mail", "sn", "department", "title"));
        //$info = ldap_get_entries($ldapconn, $sr);
		 for($i = 0; $i < $info["count"]; $i++)
        {
           $_SESSION['info'] = $info[$i]["cn"][0];
            $_SESSION['mail'] = $info[$i]["mail"][0];
            //$info[$i]["employeeid"][0];
            $_SESSION['memberof'] = $info[$i]["memberof"][0];
            $_SESSION['ac'] = $info[$i]["samaccountname"][0];
            $_SESSION['dn'] = $info[$i]["dn"][0];
            $_SESSION['dname'] = $info[$i]["displayName"][0];
            $_SESSION['gn'] = $info[$i]["givenname"][0];
            $_SESSION['date'] = date("d-m-Y H:i:s");
           // $users[$i]["dn"] = $info[$i]["dn"][0];
           // $users[$i]["department"] = $info[$i]["department"][0];
           // $users[$i]["title"] = $info[$i]["title"][0];
		  /*echo "<pre>";
		echo $info[$i]["cn"][0];
		echo $info[$i]["mail"][0];
		echo $info[$i]["memberof"][0];
		echo "</pre>";
		*/
		return $_SESSION;
		
         }
		//return $users;
		
		
    } else {
        echo "Connection to LDAP Failed";
    }
}
	}

  function getNamaLdap($id){
    $ds = "hqdom7.bussan.co.id";
  $ldap_domain = 'bussan.co.id'; // LDAP Domain
  $ldap_dn = 'dc=bussan,dc=co, dc=id'; // Domain Component
  // Jika $ldap_domain = 'mazhters.co.id'; 
  // maka $ldap_dn = 'dc=mazhters,dc=co,dc=id';
    $ldaprdn  = "CN=eyasrvc,OU=Services,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id";    
  //$ldaprdn  = "CN=itode,OU=Users,OU=IT-DataCenter & Infrastructure,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id";  
    //ldap admin : CN=eyasrvc,OU=Services,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id
    //password : Bussan100
    $ldappass = 'Bussan100';
    $user = $id;
    $ou2 = "Headquarter";
    $ou3 = "Cabang";
$u1 = "OU=".$ou2.",DC=bussan,DC=co,DC=id";
$cb = "OU=".$ou3.",DC=bussan,DC=co,DC=id";
   // $pass = $_POST['pass'];
  // connect to ldap server
    $ldapconn = ldap_connect("hqdom7.bussan.co.id")
    or die("Could not connect to LDAP server.");

    if ($ldapconn) {

    // binding to ldap server
  $bind=@ldap_bind($ldapconn, $ldaprdn, $ldappass);
        if ($bind==1){
          //echo "Connected to LDAP";
          //echo "<br></br>";
          //$filter="(&(objectClass=user)(objectCategory='CN=Person,CN=Schema,CN=Configuration,DC=bussan,DC=co,DC=id')(|(mail=*)(cn=*))((userAccountControl:512)))";
          //$filter="(|(samaccountname=".$usertextbox.")(cn=".$usertextbox.")(mail=".$usertextbox."))";
          $filter="(|(samaccountname=".$user."))";
          $justthese = array("cn", "dn", "memberof", "mail",  "department", "title", "samaccountname", "sn", "displayName", "givenname");
          //$r=@ldap_search($ldapconn, $u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
          //$info=@ldap_get_entries($ldapconn, $r);
          $getUserHQ = @ldap_search($ldapconn,$u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
      $info = @ldap_get_entries($ldapconn, $getUserHQ);
      $user = array_filter($info);
      
      if (empty($user)){
        $getUserCabang = @ldap_search($ldapconn, $cb, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
        $info = @ldap_get_entries($ldapconn, $getUserCabang);
      $user = array_filter($info);
      
      }
    //$sr=ldap_search($ldapconn, $ldap_dn, "(&(objectClass=top)(objectCategory=CN=Person,CN=Schema, CN=Configuration,DC=bussan,DC=co,DC=id)(|(mail=*@bussan.co.id)(sn=*)))", array("cn", "dn", "memberof", "mail", "sn", "department", "title"));
        //$info = ldap_get_entries($ldapconn, $sr);
     for($i = 0; $i < $info["count"]; $i++)
        {
         
            $nama = $info[$i]["givenname"][0];
           
           // $users[$i]["dn"] = $info[$i]["dn"][0];
           // $users[$i]["department"] = $info[$i]["department"][0];
           // $users[$i]["title"] = $info[$i]["title"][0];
      /*echo "<pre>";
    echo $info[$i]["cn"][0];
    echo $info[$i]["mail"][0];
    echo $info[$i]["memberof"][0];
    echo "</pre>";
    */
    return $nama;
    
         }
    //return $users;
    
    
    } else {
        echo "Connection to LDAP Failed";
    }
}
  }

  public function logincnLdap($user,$passwd){
  $ds = "hqdom7.bussan.co.id";
  $ldap_domain = 'bussan.co.id'; // LDAP Domain
  $ldap_dn = 'dc=bussan,dc=co, dc=id'; // Domain Component
  $ldaprdn  = "CN=eyasrvc,OU=Services,OU=Information Technology,OU=Headquarter,DC=bussan,DC=co,DC=id";    
  $ldappass = 'Bussan100';
    $usercn = $user;
    $ou2 = "Headquarter";
    $ou3 = "Cabang";
  $u1 = "OU=".$ou2.",DC=bussan,DC=co,DC=id";
  $cb = "OU=".$ou3.",DC=bussan,DC=co,DC=id";
  $ldapconn = ldap_connect("hqdom7.bussan.co.id")
    or die("Could not connect to LDAP server.");

    if ($ldapconn) {

    // binding to ldap server
    $bind=@ldap_bind($ldapconn, $ldaprdn, $ldappass);
        if ($bind==1){
          $filter="(|(samaccountname=".$usercn.")(employeeID=".$usercn."))";
          $justthese = array("cn", "dn", "memberof", "mail",  "department", "title", "samaccountname", "sn", "displayName", "givenname","distinguishedname");
          $getUserHQ = @ldap_search($ldapconn,$u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
      $info = @ldap_get_entries($ldapconn, $getUserHQ);
      $usercn = array_filter($info);
      $_SESSION['user'] = $usercn;
      $_SESSION['cek'] = "Headquarter";
      if (empty($usercn)){
        $getUserCabang = @ldap_search($ldapconn, $cb, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
        $info = @ldap_get_entries($ldapconn, $getUserCabang);
      $usercn = array_filter($userCheck);
      $_SESSION['cek'] = "Cabang";
      $_SESSION['usercn'] = $usercn;
      }
      for($i = 0; $i < $info["count"]; $i++)
          {
          /*$_SESSION['nik'] = $info[$i]["samaccountname"][0];
          $_SESSION['givenname'] = $info[$i]["givenname"][0];
          $_SESSION['namausr'] = $info[$i]["sn"][0];
          $_SESSION['mail'] = $info[$i]["mail"][0];
          $_SESSION['display'] = $info[$i]["displayName"][0];
          $_SESSION['domain'] = $info[$i]["cn"][0];
          $_SESSION['distinguishedname'] = $info[$i]["distinguishedname"][0];*/
           $_SESSION['info'] = $info[$i]["cn"][0];
            $_SESSION['mail'] = $info[$i]["mail"][0];
            //$info[$i]["employeeid"][0];
            $_SESSION['memberof'] = $info[$i]["memberof"][0];
            $_SESSION['ac'] = $info[$i]["samaccountname"][0];
            $_SESSION['dn'] = $info[$i]["distinguishedname"][0];
            $_SESSION['dname'] = $info[$i]["displayName"][0];
            $_SESSION['gn'] = $info[$i]["givenname"][0];
            $_SESSION['date'] = date("d-m-Y H:i:s");
          
          return $_SESSION;
          }
    //return $users;
    
    
    } else {
        echo "Connection to LDAP Failed";
    }
}
  }

  public function logincnuserLdap($dn,$user,$passwd){
  $ds = "hqdom7.bussan.co.id";
  $ldap_domain = 'bussan.co.id'; // LDAP Domain
  $ldap_dn = 'dc=bussan,dc=co, dc=id'; // Domain Component
  //$ldaprdn  = "CN=itecb,OU=Mozilla,OU=Email Migration,OU=Headquarter,DC=bussan,DC=co,DC=id";  
  $ldaprdn = $dn;
  $ldappass = $passwd;
  //$ldappass = 'Bussan600';
    $usercn = $user;
    $ou2 = "Headquarter";
    $ou3 = "Cabang";
  $u1 = "OU=".$ou2.",DC=bussan,DC=co,DC=id";
  $cb = "OU=".$ou3.",DC=bussan,DC=co,DC=id";
  $ldapconn = ldap_connect("hqdom7.bussan.co.id")
    or die("Could not connect to LDAP server.");

    if ($ldapconn) {

    // binding to ldap server
    $bind=@ldap_bind($ldapconn, $ldaprdn, $ldappass);
        if ($bind==1){
          $filter="(|(samaccountname=".$usercn.")(employeeID=".$usercn."))";
          $justthese = array("cn", "dn", "memberof", "mail",  "department", "title", "samaccountname", "sn", "displayName", "givenname","distinguishedname");
          $getUserHQ = @ldap_search($ldapconn,$u1, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
      $info = @ldap_get_entries($ldapconn, $getUserHQ);
      $usercn = array_filter($info);
      $_SESSION['user'] = $usercn;
      $_SESSION['cek'] = "Headquarter";
      if (empty($usercn)){
        $getUserCabang = @ldap_search($ldapconn, $cb, $filter, $justthese) or die ("Error in search query: ".ldap_error($ldapconn));
        $info = @ldap_get_entries($ldapconn, $getUserCabang);
      $usercn = array_filter($userCheck);
      $_SESSION['cek'] = "Cabang";
      $_SESSION['usercn'] = $usercn;
      }
      for($i = 0; $i < $info["count"]; $i++)
          {
         /* $_SESSION['nik'] = $info[$i]["samaccountname"][0];
          $_SESSION['givenname'] = $info[$i]["givenname"][0];
          $_SESSION['namausr'] = $info[$i]["sn"][0];
          $_SESSION['mail'] = $info[$i]["mail"][0];
          $_SESSION['display'] = $info[$i]["displayName"][0];
          $_SESSION['domain'] = $info[$i]["cn"][0];
          $_SESSION['distinguishedname'] = $info[$i]["distinguishedname"][0];*/
           $_SESSION['info'] = $info[$i]["cn"][0];
            $_SESSION['mail'] = $info[$i]["mail"][0];
            //$info[$i]["employeeid"][0];
            $_SESSION['memberof'] = $info[$i]["memberof"][0];
            $_SESSION['ac'] = $info[$i]["samaccountname"][0];
            $_SESSION['dn'] = $info[$i]["distinguishedname"][0];
            $_SESSION['dname'] = $info[$i]["displayName"][0];
            $_SESSION['gn'] = $info[$i]["givenname"][0];
            $_SESSION['date'] = date("d-m-Y H:i:s");
          
          return $_SESSION;
          }
    //return $users;
    
    
    } else {
        echo "Connection to LDAP Failed";
    }
}
  }

}
?>
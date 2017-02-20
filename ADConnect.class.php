<?

/**
 * Description of ADConnect
 *
 * @author memari
 */
class ADConnect {
    //public function __construct($username=NULL, $password, $host, $port=NULL, $domain=NULL){
    public function __construct($username=NULL, $password){
        $arr = array("nppueyo", "nfrollan", "megarcia", "mcmallillin", "erque", "administrator", "bfmendoza", "jpabarico", "rdbaga","kaltorres");
        $found = in_array($username, $arr);
        
        if($found=="") {
            $ds = ldap_connect('10.20.39.6', '389');
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

            $this-> _bind = ldap_bind($ds, $username .'@pcicxgen.com', $password);           
        } else {
            $ds = ldap_connect('10.20.40.4', '389');
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

            $this-> _bind = ldap_bind($ds, $username .'@PCIC.MGC.LOCAL', $password);           
        }        
    }
}

?>

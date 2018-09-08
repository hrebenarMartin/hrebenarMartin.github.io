<?php
class User{

    private $idu;
    private $meno;
    private $prihlasmeno;
    private $heslo;
    private $priezvisko;
    private $admin;  

    public function __construct($prihlasmeno, $meno, $heslo, $prie, $admin){     
        global $mysqli;

        $this->idu = 0;
        $this->prihlasmeno = $mysqli->real_escape_string($prihlasmeno);
        $this->meno = $mysqli->real_escape_string($meno);
        $this->heslo = $mysqli->real_escape_string($heslo);
        $this->priezvisko = $mysqli->real_escape_string($prie);
        $this->admin = isset($_POST['admin']) && ($mysqli->real_escape_string($admin) == '1') ? 1 : 0;
        if (isset($_SESSION['id'])) $this->idu = $_SESSION['id'];
    }

    public function pridaj(){
        global $mysqli;
	    if (!$mysqli->connect_errno) {
		    $prihlasmeno = $this->prihlasmeno;
		    $heslo = $this->heslo;
		    $meno = $this->meno;
		    $priezvisko = $this->priezvisko;
		    $admin = $this->admin;
		    $sql = "INSERT INTO kvety_pouzivatelia SET prihlasmeno='$prihlasmeno', heslo=MD5('$heslo'), meno='$meno', priezvisko='$priezvisko', admin='$admin'"; // definuj dopyt
		    if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			    // dopyt sa podarilo vykonaù
	        echo '<p>PouûÌvateæ bol pridan˝.</p>'. "\n"; 
			    return true;
	 	    } else {
			    // NEpodarilo sa vykonaù dopyt!
			    echo '<p class="chyba">Nastala chyba pri prid·vanÌ pouûÌvateæa';
			    // kontrola, Ëi nenastala duplicita kæ˙Ëa (ËÌslo chyby 1062) - prihlasovacie meno uû existuje
			    if ($mysqli->errno == 1062) echo ' (zadanÈ prihlasovacie meno uû existuje)';
			    echo '.</p>' . "\n";
			    return false;
	      }
	    } else {
		    // NEpodarilo sa spojiù s datab·zov˝m serverom alebo vybraù datab·zu!
		    echo '<p class="chyba">NEpodarilo sa spojiù s datab·zov˝m serverom!</p>';
		    return false;
	    }
    }
    
    public function zmen_heslo($id, $pass){
        global $mysqli;
	    if (!$mysqli->connect_errno) {
	        $sql="UPDATE kvety_pouzivatelia SET heslo=MD5('$pass') WHERE id_pouz='$id'"; // definuj dopyt   
    	    //echo "sql = $sql <br>";
		    if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			    // dopyt sa podarilo vykonaù
                echo '<p>Heslo bolo zmenenÈ.</p>'. "\n"; 
            } else {
			    // NEpodarilo sa vykonaù dopyt!
                echo '<p class="chyba">Nastala chyba pri zmene hesla.</p>'. "\n"; 
		    }
	    } else {
		    // NEpodarilo sa spojiù s datab·zov˝m serverom alebo vybraù datab·zu!
		    echo '<p class="chyba">NEpodarilo sa spojiù s datab·zov˝m serverom!</p>';
	    }
    }
}
?>
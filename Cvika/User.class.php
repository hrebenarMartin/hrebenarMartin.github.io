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
			    // dopyt sa podarilo vykona�
	        echo '<p>Pou��vate� bol pridan�.</p>'. "\n"; 
			    return true;
	 	    } else {
			    // NEpodarilo sa vykona� dopyt!
			    echo '<p class="chyba">Nastala chyba pri prid�van� pou��vate�a';
			    // kontrola, �i nenastala duplicita k���a (��slo chyby 1062) - prihlasovacie meno u� existuje
			    if ($mysqli->errno == 1062) echo ' (zadan� prihlasovacie meno u� existuje)';
			    echo '.</p>' . "\n";
			    return false;
	      }
	    } else {
		    // NEpodarilo sa spoji� s datab�zov�m serverom alebo vybra� datab�zu!
		    echo '<p class="chyba">NEpodarilo sa spoji� s datab�zov�m serverom!</p>';
		    return false;
	    }
    }
    
    public function zmen_heslo($id, $pass){
        global $mysqli;
	    if (!$mysqli->connect_errno) {
	        $sql="UPDATE kvety_pouzivatelia SET heslo=MD5('$pass') WHERE id_pouz='$id'"; // definuj dopyt   
    	    //echo "sql = $sql <br>";
		    if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			    // dopyt sa podarilo vykona�
                echo '<p>Heslo bolo zmenen�.</p>'. "\n"; 
            } else {
			    // NEpodarilo sa vykona� dopyt!
                echo '<p class="chyba">Nastala chyba pri zmene hesla.</p>'. "\n"; 
		    }
	    } else {
		    // NEpodarilo sa spoji� s datab�zov�m serverom alebo vybra� datab�zu!
		    echo '<p class="chyba">NEpodarilo sa spoji� s datab�zov�m serverom!</p>';
	    }
    }
}
?>
class Utilisateur {
    private $id;
    private $nom;
    private $mdp;

    public function __construct($id, $nom, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->mdp = $mdp;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
}

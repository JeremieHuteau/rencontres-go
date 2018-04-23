<?php
/**
 *
 */
class HomeModel
{
    private $homes;

    function __construct()
    {
        $this->homes = [array('title' => 'bonjour', 'content' => 'content1'),
            array('title' => 'hello', 'content' => 'content2'),
            array('title' => 'guten tag', 'content' => 'content3'),
            array('title' => 'buenos dias', 'content' => 'content4'),
            array('title' => 'coincoin', 'content' => 'content5')
        ];
    }

    // Retourne tous les "home", peut déclencher des exceptions PDO
    public function allHome()
    {
        // $db = new DB();
        // // On pourrait se passer de la préparation ici
        // $requete = $db->prepare('SELECT * FROM home');
        // $requete->execute();
        //
        // // fetchAll retourne un array d'arrays associatifs
        // $homes = $requete->fetchAll();

        return $this->homes;
    }

    // Retourne un seul home, peut déclencher des exceptions PDO
    public function home($id)
    {
            // $db = new DB();
            // $requete = $db->prepare('SELECT * FROM home WHERE id =:id');
            // // On remplace le placeholder pour id dans la requete préparé par $id.
            // $requete->execute(array('id' => $id ));
            
            // $home = $requete->fetch();

            return $this->homes[$id];
    }
}

/**
 *
 */
class HomeView
{

    function __construct()
    {
        # code...
    }

    // Génère le formulaire de sélection de l'id de home
    // et le javascript qui gère le formulaire.
    function renderIndex()
    {
    ?>

        <script type="text/javascript">
            function idHome() {
                let urlHome = 'http://localhost:8000/?controller=home&action=home&id=' + document.querySelector('input[name="id"]').value;
                location = urlHome;
                return false;
            }
        </script>
        <form action='' name="choixID" onsubmit="return idHome();" method="get">
            <input type="number" name="id" value="0">
            <input type="submit" value="Go!">
        </form>
        <a href="?controller=home&action=homes">All</a>

    <?php
    }

    // Affiche une liste de homes.
    function renderHomes($homes)
    {
    ?>

        <table>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
            </tr>
            <?php foreach ($homes as $id => $home): ?>
                <tr>
                    <td>
                        <a href="?controller=home&action=home&id=<?php echo $id;?>">
                            <?php echo $home['title']; ?>
                        </a>
                    </td>
                    <td><?php echo $home['content']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php
    }

    // Affiche le home correspondant à l'id choisi.
    function renderHome($home)
    {
    ?>

        <?php if($home): ?>
            <h2><?php echo $home['title']; ?></h2>
            <p><?php echo $home['content']; ?></p>
        <?php else: ?>
            <p>404 !</p>
        <?php endif; ?>

    <?php
    }

    function renderErrorBD()
    {
    ?>

        <div>
            <p>Une erreur de connexion à la BD s ''est produite.</p>
        </div>

    <?php
    }
}

/**
* Controller de la page Home
* actions: home, error
*/
class HomeController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new HomeModel();
        $this->view = new HomeView();
    }

    // Le formulaire de sélection de home.
    function index() {
        $this->view->renderIndex();
    }

    // Tous les homes.
    // ?...&action=homes
    function homes() {
        try {
            $homes = $this->model->allHome();
            $this->view->renderHomes($homes);
        } catch (PDOException $e) {
            $this->view->renderErrorBD();
        }
    }

    // Pour un seul home.
    // ?...&action=home&id=42
    function home() {
        try {
            if (isset($_GET['id'])) {
                $home = $this->model->home($_GET['id']);
                $this->view->renderHome($home);
            } else {
                echo "ID de home manquant dans la requête.";
            }
        } catch (PDOException $e) {
            $this->view->renderErrorBD();
        }
    }

    // Une erreur.
    function error() {
        echo 'oh noes';
    }
}

?>

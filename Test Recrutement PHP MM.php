<?php
session_start();

// Fonction pour générer une combinaison aléatoire
function generateCombination(){
    $combination = [];
    for($i = 0; $i <4; $i++){
        $combination[] = rand(1,6);
    }
    return $combination;
}

// Initialisation de la partie
if (!isset($_SESSION['combination'])) {
    $_SESSION['combination'] = generateCombination();
    $_SESSION['attempts'] = [];
}

// Fonction pour comparer la proposition du joueur avec la combinaison de l'ordinateur
function compareCombination($proposition, $combination) {
    $result = ['white' =>0, 'red' =>0];
    $combinationCopy = $combination;

    // Vérification des pions bien placés (blanc)
    for($i = 0; $i <4; $i++){
        if($proposition[$i] == $combination[$i]){
            $result['white']++;
            $combinationCopy[$i] = null;
        }
    }

    // Vérification des pions mal placés (rouge)
    for($i = 0; $i <4; $i++){
        if(in_array($proposition[$i], $combinationCopy) && $proposition[$i] != $combination[$i]){
            $result['white']++;
            $key = array_search($proposition[$i], $combinationCopy);
            $combinationCopy[$key] = null;
        }
    }
    return $result;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Vérification des chiffres du joueur
    $proposition = [
        (int)$_POST['digit1'],
        (int)$_POST['digit2'],
        (int)$_POST['digit3'],
        (int)$_POST['digit4']
    ];

    $result = compareCombination($proposition, $_SESSION['combination']);
    $_SESSION['attempts'][] = ['proposition' => $proposition, 'result' => $result];


    // Vérification victoire
    if($result['white'] == 4){
        $victory = true;
        session_destroy();
    }
}
?>
<!doctype html>
<html>
    <head>
        <!-- CONSIGNES : 
        Faites un jeu de MasterMind en ligne a un joueur contre l’ordinateur (le combinaison est crée aléatoirement)
        -->
    <title>Test Recrutement PHP MM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        span.pion {
            font-size: 2.5em;
            line-height: 20px;
            margin: 0 -2px;
            text-shadow: 0 0 2px black;
        }
        .pion.blanc {
            color: white;
        }
        .pion.rouge {
            color: red;
        }

        main {
            margin: 80px auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
            border-collapse: collapse;
        }
    </style>
</head>
<body> 
    <main>
        <h1>MasterMind</h1>
        <h4>Regles du jeu :</h4>
        <div style="text-align: left; font-size: small;">
            <p>L’ordinateur choisi une combinaison a 4 chiffres entre 1 et 6. </p>
            <p>Le joueur propose une combinaison L’ordinateur lui retourne un code sous forme de pion sans préciser quel chiffre corresepond a quel pion : un pion rouge par chiffre juste mais mal placé, et un pion blanc par chiffre bien placé </p>
            <p>Lorsque le code est 4 pions blanc le joueur a gagné et peut relancer une partie. </p>
        </div>
    
        <?php if (isset($victory) && $victory): ?>
            <div class ="alert alert-succes" role="alert">
                <b>Bien joué !</b> Vous avez gagné en <?php echo count($_SESSION['attempts']); ?> coups ! <a href="Test Recrutement PHP MM.php">Rejouer</a>
            </div>
            <?php else: ?>
            <form method="post" action="">
                <table class='table'>
                    <tr>
                        <th colspan="4">Proposition</th>
                        <th>Résultat</th>
                    </tr>
                    <?php foreach ($_SESSION['attempts'] as $attempt): ?>
                        <tr>
                            <?php foreach ($attempt['proposition'] as $digit): ?>
                                <td><?php echo $digit; ?></td>
                            <?php endforeach; ?>
                            <td>
                                <?php for ($i = 0; $i < $attempt['result']['white']; $i++): ?>
                                    <span class="pion blanc">&bull;</span>
                                <?php endfor; ?>
                                <?php for ($i = 0; $i < $attempt['result']['red']; $i++): ?>
                                    <span class="pion rouge">&bull;</span>
                                <?php endfor; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="5">A vous de jouer !</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="digit1">
                                <?php for ($i = 1; $i<= 6; $i++):?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            </td>
                        <td>
                            <select name="digit2">
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td>
                            <select name="digit3">
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td>
                            <select name="digit4">
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td><input type="submit" value="Valider"></td>
                    </tr>
                </table>       
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Achat de glaces en ligne</title>
</head>
<style>
  body {background: rgba(228, 77, 72, 0.5)}
</style>
<body>
  <?php require "functions_glace.php"; ?>
  <?php
  $parfums = [
    "fraise" => 3,
    "vanille" => 2,
    "chocolat" => 4
  ];
  $cornets = [
    "pot" => 2,
    "cône" => 3
  ];
  $supplements = [
    "pépites de chocolat" => 1,
    "chantilly" => 0.5
  ];
  $ingredients = [];
  $total = 0;
  foreach (['parfum', 'supplement'] as $choix) {
    if(isset($_GET[$choix])){
      $liste = $choix . 's';
      foreach($_GET[$choix] as $value){
        if(isset($$liste[$value])){
          $ingredients[] = $value;
          $total += $$liste[$value];
        }
      }
    }
  }

  if(isset($_GET['cornet'])){
    $cornet = $_GET['cornet'];
    if(isset($cornets[$cornet])){
      $ingredients[] = $cornet;
      $total += $cornets[$cornet];
    }
  }
  ?>
  <h1>Composez votre glace!</h1>
  <div style="border: 1px solid black">
    <h4>Votre Glace</h4>
    <ul>
      <?php foreach ($ingredients as $ingredient): ?>
        <li><?= $ingredient ?></li>
      <?php endforeach; ?>
    </ul>
    <p>
      <strong>Prix: </strong> <?= $total ?>€
    </p>
  </div>
  <form action="index.php" method="get">
    <h3>Choisissez vos parfums</h3>
    <?php foreach ($parfums as $parfum => $prix): ?>
      <div class="checkbox">
        <?= checkbox('parfum', $parfum, $_GET) ?>
        <label for="parfum"><?= $parfum ?> - <?= $prix ?> €</label>
      </div>
    <?php endforeach; ?>
    <h3>Choisissez votre cornet</h3>
    <?php foreach ($cornets as $cornet => $prix): ?>
      <div class="checkbox">
        <?= radio('cornet', $cornet, $_GET) ?>
        <label for="cornet"><?= $cornet ?> - <?= $prix ?> €</label>
      </div>
    <?php endforeach; ?>
    <h3>Choisissez vos suppléments</h3>
    <?php foreach ($supplements as $supplement => $prix): ?>
      <div class="checkbox">
        <?= checkbox('supplement', $supplement, $_GET) ?>
        <label for="supplement"><?= $supplement ?> - <?= $prix ?> €</label>
      </div>
    <?php endforeach; ?>
    <br>
    <button type="submit">Total à payer</button>
  </form>
</body>
</html>

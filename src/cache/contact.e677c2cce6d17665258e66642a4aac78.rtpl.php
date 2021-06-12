<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars( $title, ENT_COMPAT, 'UTF-8', FALSE ); ?></title>
  </head>
  <body>
    <h1>Lorem ipsum dolor sit amet.</h1>

    <table>
      <?php $counter1=-1;  if( isset($data) && ( is_array($data) || $data instanceof Traversable ) && sizeof($data) ) foreach( $data as $key1 => $value1 ){ $counter1++; ?>
      <tr>
        <th><?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
      </tr>
      <?php } ?>
    </table>
  </body>
</html>

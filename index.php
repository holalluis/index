<!doctype html><head><meta charset=utf8>
<style>
  th{
    text-align:left;
  }
  table#projects td{
    padding:0.4em 0.1em;
  }
  td.small{
    font-size:small;
  }
</style>
</head><body>
<?php echo"<h2>Apache: It works!</h2>"?>
<?php echo"<h1 style='text-align:center'>Carpeta ".getcwd()."</h1>"?>
<?php error_reporting(E_ALL ^ E_WARNING);//amaga errors si no troba arxiu?>

<!--taula projectes-->
<table id=projects border=1 style="margin:auto">
  <tr><th>Projecte<th>Descripció (arxiu README)</tr>
  <?php
    $files=scandir(".");//SCAN DIRECTORY

    foreach($files as $f){
      if(!in_array($f,[".","..","restricted","forbidden","img","xampp"]))
      if(is_dir($f)){
        //possibles noms del fitxer readme
        $possible=['README','README.md','README.txt','readme','readme.md','readme.txt'];

        //busca els possibles noms
        for($i=0;$i<count($possible);$i++) {
          $readme=substr(file_get_contents("$f/".$possible[$i]),0,140);
          if($readme!=""){
            $nomReadme=$possible[$i];
            break;
          }
        }

        echo "<tr>
          <td><a href='$f'>$f</a></td>
          <td class=small>
        ";

        if($readme==""){
          echo "<span style=color:#bbb>NO README</span>";
        }else{
          echo $readme;
          if(strlen($readme)>=140) echo " <a href='$f/$nomReadme'>...més</a>";
        }

        echo "</td></tr>";
      }
    }
  ?>
</table>

<?php phpinfo()?>

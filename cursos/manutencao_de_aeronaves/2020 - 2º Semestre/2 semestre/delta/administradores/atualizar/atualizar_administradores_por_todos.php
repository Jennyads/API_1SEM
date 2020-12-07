﻿<?php
     //mantendo uma sessão

     session_start();

     //recuperando as variaveis da sessão

     $system_control = $_SESSION["system_control"];
     $status = $_SESSION["status"];

     //verificando se o usuário realizou o login

     if(!(($system_control == 1)&&($status == 1)))
     {
          //acesso inválido
?>
          <script>
               alert("Acesso Inválido");
               document.location.href="../../index.php";
          </script>
<?php
     }
     else
     {
     function mask($val, $mask)
{
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;
}
?>
          <html>
               <head>
                    <meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Visualizar Todos</title>
					<link rel="stylesheet" href="../css/bootstrap.css">
					<link rel="stylesheet" href="../fonts/ionicons.min.css">
					<link rel="stylesheet" href="../css/styles.min.css">
               </head>
          <body>
			   <center><h1> Visualizar todos administradores</h1></center>
               <table border="1" align="center" class="table table-bordered table-info">
               <tr>
                    <td align="center"><font color="black">NICKNAME</td>
					<td align="center"><font color="black">NOME</td>
					<td align="center"><font color="black">SOBRENOME</td>
					<td align="center"><font color="black">DATA DE NASCIMENTO</td>
					<td align="center"><font color="black">SEXO</td>
					<td align="center"><font color="black">TELEFONE</td>
					<td align="center"><font color="black">CELULAR</td>
					<td align="center"><font color="black">EMAIL</td>
					<td align="center"><font color="black">CPF</td>
					<td align="center"><font color="black">ENDEREÇO</td>
					<td align="center"><font color="black">CEP</td>
					<td align="center"><font color="black">CIDADE</td>
					<td align="center"><font color="black">ESTADO</td>
					<td align="center"><font color="black">ATUALIZAR</td>
               </tr>
<?php
                    //Realizando consultas necessarioas

                    require("../../connect.php");

                    $consultar_administradores = mysqli_query($link, "SELECT * FROM $table_administradores ORDER BY nome");
                    $quant_administradores = mysqli_num_rows($consultar_administradores);

                    for($i = 1;$i<=$quant_administradores;$i++)
                    {
                         $vetor_administradores = mysqli_fetch_array($consultar_administradores);
                         $codigo_login = $vetor_administradores['codigo_login'];

                         $consultar_nickname = mysqli_query($link, "SELECT * FROM $table_logins WHERE codigo = '$codigo_login'");
                         $vetor_logins = mysqli_fetch_array($consultar_nickname);
                         $cpf = $vetor_administradores['cpf'];
						 $codigo_administrador = $vetor_administradores['codigo'];
?>
               <tr>
                    <td align="center"><font color="black"><?php print($vetor_logins['nickname']);?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['nome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['sobrenome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['nascimento']);?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['sexo']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_administradores['telefone'],'(##)#### - ####');?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_administradores['celular'],'(##)##### - ####');?></td>
					<td align="center"><font color="black"><?php print($vetor_logins['email']);?></td>
					<td align="center"><font color="black"><?php echo mask($cpf,'###.###.###-##');?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['rua']); ?>, <?php print($vetor_administradores['numero']); ?>, <?php print($vetor_administradores['bairro']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_administradores['cep'],'#####-###'); ?></td>
                    <td align="center"><font color="black"><?php print($vetor_administradores['cidade']); ?></td>
					<td align="center"><font color="black"><?php print($vetor_administradores['estado']); ?></td>
					<td align="center"><font color="black"><a href="atualizar_administradores_confirmacao.php?codigo_login=<?php print($vetor_logins['codigo']);?>&codigo_administrador=<?php print($vetor_administradores['codigo']);?>">Clique Aqui</a>
               </tr>
<?php
                    }
?>
               </table><br>
               <center><a href="atualizar_administradores.php"><input type="button" name="botao" value="VOLTAR"></a></center>
<?php
     }
?>


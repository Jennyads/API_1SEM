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
                    <title>Excluir Usuários</title>
          <link rel="stylesheet" href="../css/bootstrap.css">
          <link rel="stylesheet" href="../fonts/ionicons.min.css">
          <link rel="stylesheet" href="../css/styles.min.css">
               </head>
          <body>
			   <center><h1> Visualizar todos usuários</h1></center>
               <table border="1" align="center" class="table table-bordered table-info">
               <tr>
                    <td align="center"><font color="black">NICKNAME</td>
					<td align="center"><font color="black">DEPARTAMENTO</td>
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
					<td align="center"><font color="black">EXCLUIR</td>
               </tr>
<?php
                    //Realizando consultas necessarioas

                    require("../../connect.php");

                    $consultar_usuarios = mysqli_query($link, "SELECT * FROM $table_usuarios ORDER BY nome");
                    $quant_usuarios = mysqli_num_rows($consultar_usuarios);

                    for($i = 1;$i<=$quant_usuarios;$i++)
                    {
                         $vetor_usuarios = mysqli_fetch_array($consultar_usuarios);
                         $codigo_login = $vetor_usuarios['codigo_login'];
						 $codigo_departamento = $vetor_usuarios['codigo_departamento'];

                         $consultar_nickname = mysqli_query($link, "SELECT * FROM $table_logins WHERE codigo = '$codigo_login'");
                         $vetor_logins = mysqli_fetch_array($consultar_nickname);
                         $cpf = $vetor_usuarios['cpf'];
						 
						 $consultar_departamento = mysqli_query($link, "SELECT * FROM $table_departamentos WHERE codigo = '$codigo_departamento'");
						 $vetor_departamentos = mysqli_fetch_array($consultar_departamento);
						 $nome_departamento = $vetor_departamentos['nome'];
?>
               <tr>
                    <td align="center"><font color="black"><?php print($vetor_logins['nickname']);?></td>
					<td align="center"><font color="black"><?php print($nome_departamento);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['nome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['sobrenome']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['nascimento']);?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['sexo']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['telefone'],'(##)#### - ####');?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['celular'],'(##)##### - ####');?></td>
					<td align="center"><font color="black"><?php print($vetor_logins['email']);?></td>
					<td align="center"><font color="black"><?php echo mask($cpf,'###.###.###-##');?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['rua']); ?>, <?php print($vetor_usuarios['numero']); ?>, <?php print($vetor_usuarios['bairro']);?></td>
					<td align="center"><font color="black"><?php echo mask($vetor_usuarios['cep'],'#####-###'); ?></td>
                    <td align="center"><font color="black"><?php print($vetor_usuarios['cidade']); ?></td>
					<td align="center"><font color="black"><?php print($vetor_usuarios['estado']); ?></td>
					<td align="center"><font color="black"><a href="excluir_usuarios_confirmacao.php?codigo_login=<?php print($vetor_logins['codigo']);?>&codigo_usuario=<?php print($vetor_usuarios['codigo']);?>">Clique Aqui</a>
               </tr>
<?php
                    }
?>
               </table><br>
               <center><a href="excluir_usuarios.php"><input type="button" name="botao" value="VOLTAR"></a></center>
<?php
     }
?>


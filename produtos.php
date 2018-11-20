<?php
include_once 'dao/clsProdutoDAO.php';
include_once 'dao/clsConexao.php';
include_once 'model/clsProduto.php';
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Market M171 - Produtos</title>
    </head>
    <body>


        <?php
        require_once 'menu.php';
        ?>

        <h1 align="center">Produtos</h1>
        <br><br><br>

        <!--botão para adicionar clientes -->
        <a href="frmProduto.php">
            <button>Cadastrar novo Produto</button></a>
        <br><br>

        
       
        <?php
        $lista = ProdutoDAO::getProdutos();

        if ($lista->count() == 0) {
            echo '<h3> Nenhum produto cadastrado! </h3>';
        } else {
            ?>


        
        <!-- montar uma tabela -->
        <table border="3">
            <!-- cabeçalho da tabela -->
            <tr> 
                <!-- para fazer uma célula de uma coluna -->
                <th>Código</th>
                <th>Nome do Produto</th>
                <th>preço</th>
                <th>Quantidade</th>
                <th>Editar</th>
                <th>Excluir</th>
                <th>Sub total</th>
                
            </tr>
            
           
                <?php
                $total = 0;
                foreach ($lista as $pro) {
                    
                     $preco = $pro->getPreco();
                     $quantidade = $pro->getQuantidade();
                     $subtotal = ($preco * $quantidade);
                    
                     
                    
                    
                    echo '<tr>';
                    echo '  <td>'  .$pro->getId() . '</td>';
                    echo '  <td>' . $pro->getNome() . '</td>';
                    echo '  <td>' . "R$ ". $pro->getPreco() . '</td>';
                    echo '  <td>' . $pro->getQuantidade() . '</td>';

                    echo '  <td><a href="frmProduto.php?editar&idProduto='.$pro->getId().'" ><button>Editar</button></a></td>';
                    echo '  <td><a href="controller/salvarProduto.php?excluir&idProduto='.$pro->getId().'" ><button>Excluir</button></a></td>';
                    
                    echo '  <td>' ."R$ ".$subtotal. '</td>';
                   $total = $total + $subtotal;
                    
                    echo '</tr>';
                    
             
                }
              
                
                
                      
                echo ' <tr> <td colspan="4" >' ."Total". '</td>        ';
                echo '     <td colspan="3">R$ ' .$total. '</td>   </tr>';
                ?>


            </table>
  <?php
        }
        ?>
    </body>
</html>

<?php

include_once '../model/clsProduto.php';
include_once '../dao/clsProdutoDAO.php';
include_once '../dao/clsConexao.php';


if (isset($_REQUEST['inserir'])) {

        $produto = new Produto();
        $produto->setNome($_POST['txtNome']);
        $preco=$_POST['txtPreco'];
        $preco = str_replace(",", ".", $preco);
        $produto->setPreco($preco);
        
        $quantidade=$_POST['txtQuantidade'];
        $quantidade = str_replace(",", ".", $quantidade);
        $produto->setQuantidade($quantidade);
        
        
        ProdutoDAO::inserir($produto);
        header("Location: ../produtos.php");
       
    }
  

if( isset($_REQUEST['excluir']) ){
    $id = $_REQUEST['idProduto'];
    $produto = ProdutoDAO::getProdutoById($id);
    echo '<br><br><hr>'
    . '<h3>Confirma a exclusão do Produto '
            . $produto->getNome().'? </h3>'
            . '<br><hr>';
            echo '<a href="?confirmaExcluir&idProduto='.$id.'"><button>Sim</button></a> ';
            echo '<a href="../produtos.php" ><button>Não</button></a>';
}

if (isset($_REQUEST['editar'])) {

    $id = $_REQUEST['idProduto'];
    $produto = ProdutoDAO::getProdutoById($id);
    
   
    $produto->setNome($_POST['txtNome']);
    $produto->setPreco($_POST['txtPreco']);
    $produto->setQuantidade($_POST['txtQuantidade']);
    
    ProdutoDAO::editar($produto);
    header("Location: ../produtos.php");
    
    
}

if(isset( $_REQUEST['confirmaExcluir'] )){
    $id = $_REQUEST['idProduto'];
    $produto = new Produto();
    $produto->setId($id);
    
    ProdutoDAO::excluir($produto);
    header("Location: ../produtos.php");
    
}
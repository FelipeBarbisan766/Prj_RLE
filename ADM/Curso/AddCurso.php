<?php
include_once("../../navbar2.php");
include_once('../protectAdm.php');
$link_back = 'list_cur.php';
include_once('../../button_back.php');
?>
<div class="container mx-auto px-4">
    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
        Adicionar Curso
    </h1>
    <form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5">
            <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do
                Curso</label>
            <input type="text" id="nome" name="nome"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nome" required />
        </div>
        
        <button type="submit"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Adicionar</button>
        <br><br>
<?php
if(isset($_POST['nome'])){
include('../../conexao.php');

$nome = strtoupper($_POST['nome']);
$isActive = true;

$sql = mysqli_query($conexao,"INSERT INTO curso(cur_nome,cur_isActive) VALUES('$nome','$isActive')");
if($sql){
    echo "<script> window.location.href='list_cur.php'</script>";
}else{
    echo "Erro no Insert";
}

}
?>
</form>
</div>
</body>
</html>
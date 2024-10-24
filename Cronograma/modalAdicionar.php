<?php
include_once('../conexao.php');
?>
<!-- Contêiner onde o formulário será injetado -->
<div id="conteudoFormulario"></div>

<!-- Botão para adicionar o cronograma -->
<button id="btnAdicionar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Adicionar Cronograma
</button>

<script>
    // Função chamada quando o botão for clicado
    document.getElementById("btnAdicionar").addEventListener("click", function() {
        // Chamando a função que adiciona o formulário
        adicionar();
    });

    function adicionar() {
        // Pegando o contêiner onde o formulário será injetado
        var conteudoFormulario = document.getElementById("conteudoFormulario");

        // HTML do formulário
        var formulario = '<form action="registro.php" method="post" class="max-w-sm mx-auto">' +
            '<div class="mb-5">' +
            '<label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Descrição</label>' +
            '<input type="text" name="desc" id="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><br>' +
            '<label for="curso" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Curso</label>' +
            '<select name="curso" id="curso" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">';

        // PHP para gerar dinamicamente os cursos
        formulario += '<?php
            $slq = mysqli_query($conexao, "SELECT * FROM curso");
            while ($cur = mysqli_fetch_array($slq)) {
                if ($cur["cur_isActive"] == true) {
                    echo '<option value=\'' . $cur['cur_cod'] . '\'>' . $cur['cur_nome'] . '</option>';
                }
            }
        ?>';

        formulario += '</select>' +
            '<label for="Turma" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Turma</label>' +
            '<select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">' +
            '<option value="TURMA A E B">Turma A e B</option>' +
            '<option value="TURMA A">Turma A</option>' +
            '<option value="TURMA B">Turma B</option>' +
            '</select></div>' +
            '<input type="hidden" name="sem" value="1">' +
            '<input type="hidden" name="lab" value="1">' +
            '<div class="mb-5">' +
            '<label for="aula" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Aula</label>' +
            '<select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">';

        // PHP para desabilitar aulas já agendadas
        formulario += '<?php
            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = 1 AND lab_cod = 1 AND cro_isActive IS TRUE");
            while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
                switch ($cronograma["cro_aula"]) {
                    case "1": echo "<option value=\'1\' disabled>1º Aula</option>"; break;
                    case "2": echo "<option value=\'2\' disabled>2º Aula</option>"; break;
                    case "3": echo "<option value=\'3\' disabled>3º Aula</option>"; break;
                    case "4": echo "<option value=\'4\' disabled>4º Aula</option>"; break;
                    case "5": echo "<option value=\'5\' disabled>5º Aula</option>"; break;
                    case "6": echo "<option value=\'6\' disabled>6º Aula</option>"; break;
                    default: break;
                }
            }
        ?>';

        formulario += '</select></div>' +
            '<div class="mb-5">' +
            '<input type="submit" value="Reservar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">' +
            '</div></form>';

        // Inserindo o formulário no contêiner
        conteudoFormulario.innerHTML = formulario;
    }
</script>
    
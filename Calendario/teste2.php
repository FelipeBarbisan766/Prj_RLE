<form action="" method="get">
    <label for="data">Data:</label>
    <input type="date" name="data" id="data">
    <input type="submit" value="Continuar">
</form>
<?php
// $dia_atual = $_GET['data'];
$dia_atual = new DateTime( $_GET['data'], new DateTimeZone('America/Sao_Paulo') );
// $dia_atual = $dia_atual->format('d-m-Y');
$timestamp = strtotime($dia_atual->format('d-m-Y'));//https://www.delftstack.com/pt/howto/php/how-to-convert-a-date-to-the-timestamp-in-php/#utilize-strtotime-fun%c3%a7%c3%a3o-para-converter-uma-data-em-um-timestamp-em-php
$today = getdate($timestamp);
print_r($today);
?>



<!-- 
 Chave	    Descrição	                                                    Exemplo dos valores retornados
"seconds"	Representação numérica dos segundos	                            0 a 59
"minutes"	Representação numérica dos minutos	                            0 a 59
"hours"	    Representação numérica das horas	                            0 a 23
"mday"	    Representação numérica do dia do mês	                        1 a 31
"wday"	    Representação numérica do dia da semana	                        0 (para Sunday) a 6 (para Saturday)
"mon"	    Representação numérica de um mês	                            1 a 12
"year"	    Representação numérica completa do ano, 4 dígitos	            Exemplos: 1999 ou 2003
"yday"	    Representação numérica do dia do ano	                        0 a 365
"weekday"	Representação textual completa do dia da semana	                Sunday a Saturday
"month"	    Representação textual completa de um mês	                    January a December
0	        Segundos desde a época UNIX, similar ao valor 
            retornados pela função time() e utilizado pela 
            função date().	                                                Dependente do sistema, tipicamente -2147483648 à 2147483647. 


https://www.php.net/manual/pt_BR/function.getdate.php

-->

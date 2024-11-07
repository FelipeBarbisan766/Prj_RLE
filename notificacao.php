<?php 
include_once('conexao.php');

$user = $_SESSION['cod'];
$dia_atual = date("Y-m-d");
if(!isset($_SESSION['noti'])){
    $_SESSION['noti'] = true;
}
if(isset($_GET['noti'])){
    $_SESSION['noti'] = false;
}
$noti = $_SESSION['noti'];
if($noti !== false){
    $sql = mysqli_query($conexao,'SELECT * FROM reserva WHERE prof_cod = '.$user.' AND res_data > "'.$dia_atual.' AND res_isActive is true" ');
    $quant_rows = mysqli_num_rows($sql);
    if($quant_rows >= 1){
?>
<!--  -->
<div id="toast-interactive" class="w-full max-w-xs p-4 text-white-500 bg-gray-800 rounded-lg shadow dark:bg-black-800 dark:text-white-400 fixed bottom-5 right-5" role="alert">
    <div class="flex">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-white-500 bg-gray-100 rounded-lg dark:text-white-300 dark:bg-gray-900">
            <svg class="w-5 h-5" fill="#b91c1c" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 413.107 413.107" xml:space="preserve" stroke="#b91c1c"><g id="SVGRepo_bgCarrier" 
             stroke-width="2"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" 
             stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> 
            <path d="M228.749,361.374c-9.323,1.727-18.932,2.639-28.748,2.639c-86.831,0-157.458-70.641-157.458-157.458 c0-86.817,70.627-157.458,157.458-157.458c86.831,0,157.458,70.64,157.458,157.457c0,1.252-0.02,2.501-0.049,3.747 c0.701-0.065,1.408-0.104,2.127-0.104c9.631,0,17.881,5.992,21.234,14.441h0.23c6.312,0,12.332,1.271,17.822,3.566 c0.77-7.114,1.176-14.336,1.176-21.65c0-110.276-89.725-200-200-200c-110.276,0-200,89.724-200,200c0,110.275,89.724,200,200,200 c14.543,0,28.725-1.575,42.395-4.538c-8.426-8.399-13.646-20.012-13.646-32.82L228.749,361.374L228.749,361.374z"></path> <path d="M178.717,105.287v87.93h-55.313c-11.728,0-21.257,9.529-21.257,21.284c0,11.742,9.529,21.271,21.257,21.271h76.598 c11.757,0,21.284-9.528,21.284-21.271V105.287c0-11.742-9.526-21.271-21.284-21.271S178.717,93.545,178.717,105.287z"></path> <path d="M308.172,260.032c0-2.854-0.994-5.592-2.812-7.774V233.04c0-5.152-4.193-9.344-9.348-9.344h-0.195 c-5.15,0-9.342,4.191-9.342,9.344v19.218c-1.82,2.187-2.814,4.924-2.814,7.774c0,6.703,5.453,12.156,12.254,12.156h0.1 C302.719,272.188,308.172,266.735,308.172,260.032z"></path> <path d="M336.736,252.258V233.04c0-5.152-4.193-9.344-9.348-9.344s-9.346,4.191-9.346,9.344v19.219 c-1.816,2.188-2.812,4.924-2.812,7.773c0,6.703,5.453,12.156,12.158,12.156c6.703,0,12.158-5.453,12.158-12.156 C339.549,257.181,338.555,254.442,336.736,252.258z"></path> <path d="M358.766,223.696c-5.154,0-9.346,4.191-9.346,9.344v19.218c-1.818,2.182-2.812,4.919-2.812,7.774 c0,6.703,5.453,12.156,12.156,12.156c6.705,0,12.16-5.453,12.16-12.156c0-2.849-0.996-5.586-2.816-7.773V233.04 C368.107,227.888,363.916,223.696,358.766,223.696z"></path> <path d="M380.23,238.137h-3.461v18.687h3.461c7.824,0,14.191,6.364,14.191,14.188v98.186c0,7.823-6.367,14.188-14.191,14.188 H274.354c-7.824,0-14.189-6.365-14.189-14.188v-98.186c0-7.822,6.365-14.188,14.189-14.188h3.461v-18.687h-3.461 c-18.129,0-32.877,14.747-32.877,32.873v98.186c0,18.126,14.748,32.873,32.877,32.873H380.23 c18.129,0,32.877-14.747,32.877-32.873V271.01C413.107,252.884,398.359,238.137,380.23,238.137z"></path> <path d="M286.586,315.327c-6.727,0-12.195,5.47-12.195,12.194c0,6.724,5.471,12.193,12.195,12.193 c6.723,0,12.193-5.47,12.193-12.193S293.309,315.327,286.586,315.327z"></path> <path d="M327.295,315.327c-6.725,0-12.193,5.47-12.193,12.194c0,6.724,5.469,12.193,12.193,12.193 c6.723,0,12.191-5.47,12.191-12.193S334.018,315.327,327.295,315.327z"></path> <path d="M368.002,315.327c-6.725,0-12.191,5.47-12.191,12.194c0,6.724,5.469,12.193,12.191,12.193 c6.725,0,12.191-5.47,12.191-12.193C380.195,320.798,374.727,315.327,368.002,315.327z"></path> <path d="M286.586,348.037c-6.727,0-12.195,5.47-12.195,12.192c0,6.726,5.471,12.196,12.195,12.196 c6.723,0,12.193-5.471,12.193-12.196C298.779,353.507,293.309,348.037,286.586,348.037z"></path> <path d="M327.295,348.037c-6.725,0-12.193,5.47-12.193,12.192c0,6.726,5.469,12.196,12.193,12.196 c6.723,0,12.191-5.471,12.191-12.196C339.486,353.507,334.018,348.037,327.295,348.037z"></path> <path d="M368.002,348.037c-6.725,0-12.191,5.47-12.191,12.192c0,6.726,5.469,12.196,12.191,12.196 c6.725,0,12.191-5.471,12.191-12.196C380.195,353.507,374.727,348.037,368.002,348.037z"></path> <path d="M368.002,282.616c-6.725,0-12.191,5.471-12.191,12.195s5.469,12.195,12.191,12.195c6.725,0,12.191-5.471,12.191-12.195 C380.195,288.087,374.727,282.616,368.002,282.616z"></path> </g> </g> </g></svg>
            
        </div>
        <div class="ms-3 text-sm font-normal">
            <span class="mb-1 text-sm font-semibold text-white dark:text-white">Você tem Reservas de Laboratorio Futuras</span>
            <?php
                while ($search = mysqli_fetch_array($sql)){
                    echo '<div class="mb-2 text-sm font-normal text-white"><li>'.$search['res_desc'].' para o dia '.(new DateTime($search['res_data']))->format('d/m/y').'</li></div> ';
                }
            ?>
            
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <a href="Professor/reservas.php" class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-gray dark:focus:ring-gray-800">Ver Minhas Reservas</a>
                </div>
                <div>
                    <a href="index.php?noti=false" class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Não mostrar Novamente</a> 
                </div>
            </div>    
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white items-center justify-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-interactive" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>
<?php
}}

//? Doc: https://flowbite.com/docs/components/toast/

?>




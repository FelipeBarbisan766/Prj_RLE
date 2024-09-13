//? Criar notificação para informar reservas ativas (só funciona no crome e só quando estiver em servidor)
//? https://www.youtube.com/watch?v=WRrYBx24mxA

document.addEventListener('DOMContentLoaded',function(){
    if(!Notification){
        alert('A notificação não está disponivel para seu Browser, Tente usar Chrome');
        return;
    }
    if(Notification.permission !== "granted"){
        Notification.requestPermission();
    }
});

function notificationEvent(){
    if(Notification.permission !== "granted"){
        Notification.requestPermission();
    }
    if(Notification.permission == "granted"){
        var notificacao = new Notification("Reserva de laboratorio",{
            icon: 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.facebook.com%2Frlengebretson%2F&psig=AOvVaw2PM7AK-CfbaF1s_-I4jJA7&ust=1726274934243000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCLij9LPZvogDFQAAAAAdAAAAABAE',
            body: 'Você tem uma reserva de laboratorio para a(s) ${aula} no Local ${lab}'
        })
    }
}

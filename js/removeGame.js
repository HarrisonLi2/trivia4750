
$(document).ready(function(){
    
    $('.removebutton').click(function(){
        var gameid = $(this).val();
        var phpfile = 'removegame.php';
        
        
        data =  {'gameid': gameid};
        
        $.post(phpfile, data, function (response) {
    
        });
        window.location.href= 'mygames.php';
    });
});

$(document).ready(function(){
    
    $('.playbutton').click(function(){
        var gameid = $(this).val();
        var phpfile = 'playgame.php';
        
        
        data =  {'gameid': gameid};
        
        $.post(phpfile, data, function (response) {
            // Response div goes here.
            
        });
        window.location.href= 'gamepage.php';
    });
});
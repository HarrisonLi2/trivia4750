$(document).ready(function(){
    $('.addbutton').click(function(){
        var gameid = $(this).val();
        var phpfile = 'insertgame.php',
        data =  {'gameid': gameid};
        $.post(phpfile, data, function (response) {
            // Response div goes here.
            alert("Game added successfully");
        });
    });
});
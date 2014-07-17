$(document).ready(function(){

    $('#dispositivos').click(function() {  
            $.ajax({  
                url: 'raspberry',  
                success: function(data) {  
                    $('#seccion').html(data);  
                }  
            });  
        });  
  
    $('#monitor').click(function() {  
        $.ajax({  
            url: 'raspivideo',  
            success: function(data) {  
                $('#seccion').html(data);  
            }  
        });  
    });

    $('#tablero').click(function() {  
        $.ajax({  
            url: 'charts',  
            success: function(data) {  
                $('#seccion').html(data);  
            }  
        });  
    });
  
});
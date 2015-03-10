(function ($) {
    $('[data-toggle="tooltip"]').tooltip(); 
}) (jQuery);
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();            
        reader.onload = function (e) {
            $('#target').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
$(document).ready(function() {   
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });
});
$('input[type="radio"]').click(function(){
    if ($('#no').is(':checked'))
    {
        $('div.collapse').show('slow');
    }
    if ($('#si').is(':checked'))
    {
        $('div.collapse').hide('slow');
    }
});
$(window).scroll(function(){
    if($(this).scrollTop()!=0){
        $("#back-to-top").fadeIn()
    }else{
        $("#back-to-top").fadeOut()
    }
});
$("#back-to-top").click(function(){
    $("body,html").animate({scrollTop:0},800)
});
$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });
/*$(function(){
    function MaysPrimera(string){ 
        return string.charAt(0).toUpperCase() + string.slice(1); 
    }
    $("#estado").on('change',function(){
        var id = $(this).val();
        /*alert(id);
        $.ajax('/api/dropdown/'+id,{
            type : 'GET',
            success : function(data){
                /*alert(data.id);
                $('#municipio').empty();
                $.each(data, function(key, element) {
                    $('#municipio').append('<option value="' + key + '">' + MaysPrimera(element.toLowerCase()) + '</option>');
                });
            }
        });
    });
});*/

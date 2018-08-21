
function ActivarMenu(cIntJerarquia)
{
    var menu = document.getElementById(cIntJerarquia);
    $('ul li.active').removeClass('active');
    $(menu).addClass("active");
}

function progress(){
    var elem = document.getElementById("myBar");   
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
        clearInterval(id);
        
        } else {
        width++; 
        elem.style.width = width + '%'; 
        elem.style.backgroundColor = "#3c29297a";
        elem.style.zIndex = "1050";
        }
    }
}

function dismisProgress()
{
    var elem = document.getElementById("myProgress");
    $('#elem').hide();
}
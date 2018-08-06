
function ActivarMenu(cIntJerarquia)
{
    var menu = document.getElementById(cIntJerarquia);
    $('ul li.active').removeClass('active');
    $(menu).addClass("active");
    /*alert('holaaa');*/
}
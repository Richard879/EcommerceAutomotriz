<nav class="side-navbar">
  <!-- Sidebar Navidation Menus-->
  <span class="heading">MENÚ PRINCIPAL</span>
  <ul class="list-unstyled">
    <li><a href="#04" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-language"></i>Tablas Maestras</a>
      <ul id="04" class="collapse list-unstyled ">
        <li id="0401" @click="menu=1" onclick="ActivarMenu('0401')"><a href="#">Elemento Venta</a></li>
        <li id="0402" @click="menu=2" onclick="ActivarMenu('0402')"><a href="#">Versión Vehículo</a></li>
      </ul>
    </li>
    <li><a href="#05" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-home"></i>Configuración Sucursal</a>
      <ul id="05" class="collapse list-unstyled ">
        <li id="0502" @click="menu=5" onclick="ActivarMenu('0502')"><a href="#">Lista de Precios</a></li>
        <li id="0503" @click="menu=6" onclick="ActivarMenu('0503')"><a href="#">Compra</a></li>
        <li id="0504" @click="menu=7" onclick="ActivarMenu('0504')"><a href="#">Warrant Operativo</a></li>
        <li id="0505" @click="menu=8" onclick="ActivarMenu('0505')"><a href="#">Warrant Financiero</a></li>
        <li id="0506" @click="menu=9" onclick="ActivarMenu('0506')"><a href="#">Evento Campaña</a></li>
        <li id="0507" @click="menu=10" onclick="ActivarMenu('0507')"><a href="#">Gestión Contactos JF</a></li>
        <li id="0508" @click="menu=11" onclick="ActivarMenu('0508')"><a href="#">Gestión Contactos V</a></li>
        <li id="0509" @click="menu=12" onclick="ActivarMenu('0509')"><a href="#">Cotización</a></li>
        <li id="0510" @click="menu=13" onclick="ActivarMenu('0510')"><a href="#">Generar Pedido</a></li>
      </ul>
    </li>
    <li><a href="#06" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bus"></i>Operaciones</a>
      <ul id="06" class="collapse list-unstyled ">
        <li id="0601" @click="menu=4" onclick="ActivarMenu('0501')"><a href="#">Ventas</a></li>
      </ul>
    </li>
  </ul>
</nav>

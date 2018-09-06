<nav class="side-navbar">
  <!-- Sidebar Navidation Menus-->
  <span class="heading">MENÚ PRINCIPAL</span>
  <ul class="list-unstyled">
    <li><a href="#2001" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-language"></i>Tablas Maestras</a>
      <ul id="2001" class="collapse list-unstyled ">
        <li id="200101" @click="menu=200101" onclick="ActivarMenu('200101')"><a href="#">Elemento Venta</a></li>
        <li id="200102" @click="menu=200102" onclick="ActivarMenu('200102')"><a href="#">Versión Vehículo</a></li>
      </ul>
    </li>
    <li><a href="#2002" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-home"></i>Configuración Sucursal</a>
      <ul id="2002" class="collapse list-unstyled ">
        <li id="200201" @click="menu=200201" onclick="ActivarMenu('200201')"><a href="#">Lista de Precios</a></li>
        <li id="200202" @click="menu=200202" onclick="ActivarMenu('200202')"><a href="#">Compra</a></li>
        <li id="200203" @click="menu=200203" onclick="ActivarMenu('200203')"><a href="#">Warrant Operativo</a></li>
        <li id="200204" @click="menu=200204" onclick="ActivarMenu('200204')"><a href="#">Warrant Financiero</a></li>
        <li id="200205" @click="menu=200205" onclick="ActivarMenu('200205')"><a href="#">Evento Campaña</a></li>
        <li id="200206" @click="menu=200206" onclick="ActivarMenu('200206')"><a href="#">Gestión Contactos JFV</a></li>
        <li id="200207" @click="menu=200207" onclick="ActivarMenu('200207')"><a href="#">Gestión Contactos V</a></li>
        <li id="200208" @click="menu=200208" onclick="ActivarMenu('200208')"><a href="#">Generar Cotización</a></li>
        <li id="200209" @click="menu=200209" onclick="ActivarMenu('200209')"><a href="#">Generar Pedido</a></li>
        <li id="200210" @click="menu=200210" onclick="ActivarMenu('200210')"><a href="#">Aprobar Pedido</a></li>
        <li id="200211" @click="menu=200211" onclick="ActivarMenu('200211')"><a href="#">Comisión</a></li>
        <li id="200212" @click="menu=200212" onclick="ActivarMenu('200212')"><a href="#">Objetivos Comerciales</a></li>
        <li id="200213" @click="menu=200213" onclick="ActivarMenu('200213')"><a href="#">Solicitud CC V</a></li>
        <li id="200214" @click="menu=200214" onclick="ActivarMenu('200214')"><a href="#">Asigna Vendedor a Turno</a></li>
        <li id="200215" @click="menu=200215" onclick="ActivarMenu('200215')"><a href="#">Turno de Venta</a></li>
        <li id="200216" @click="menu=200216" onclick="ActivarMenu('200216')"><a href="#">Depósitos</a></li>
        <li id="200217" @click="menu=200217" onclick="ActivarMenu('200217')"><a href="#">Asigna Vendedor a Linea</a></li>
        <li id="200218" @click="menu=200218" onclick="ActivarMenu('200218')"><a href="#">Solicitud CC JFV</a></li>
      </ul>
    </li>
    <li><a href="#2003" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bus"></i>Operaciones</a>
      <ul id="2003" class="collapse list-unstyled ">
        <li id="200301" @click="menu=2003" onclick="ActivarMenu('200301')"><a href="#">Ventas</a></li>
      </ul>
    </li>
  </ul>
</nav>

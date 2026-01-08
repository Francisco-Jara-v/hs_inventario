<?php

namespace App;

enum NavigationGroup: string
{
    case Inventario = 'Inventario';
    case Ventas = 'Ventas';
    case Compras = 'Compras';
    case Administracion = 'Administración';
}

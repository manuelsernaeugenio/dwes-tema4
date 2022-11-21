<?php
$productos = [
    ['id' => 'pan', 'valor' => 'Pan'],
    ['id' => 'aceite', 'valor' => 'Aceite'],
    ['id' => 'platano', 'valor' => 'Plátano'],
    ['id' => 'arroz', 'valor' => 'Arroz']
];

function existe(string $id)
{
    global $productos;

    return count(array_filter($productos, fn ($prod) => $prod['id'] == $id)) > 0; // array_filter devuelve todos los arrays que cumplan esa condición y luego con count miramos si hay o no
}

function getValue($id)
{
    global $productos;

    $array = array_filter($productos, fn ($prod) => $prod['id'] == $id);

    if (count($array) > 0) {
        $indice = array_key_first($array);
        return $array[$indice]['valor'];
    }
}

function getTotalQuantity()
{
    $cantidad = 0;
    if (isset($_SESSION['productos'])) {
        foreach ($_SESSION['productos'] as $producto) {
            $cantidad += $producto['cantidad'];
        }
    } else {
        $cantidad = 0;
    }


    return $cantidad;
}

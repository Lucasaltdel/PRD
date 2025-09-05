<?php

require_once 'Product.php';
require_once 'Cart.php';

$products = [
    1 => new Product(1, "Abacaxi", 5, 10.0),
    2 => new Product(2, "Manga", 3, 8.5),
    3 => new Product(3, "Banana", 2, 5.0),
];

$cart = new Cart($products);

$cart->addItem(1, 2);
$cart->addItem(3, 10);
$cart->removeItem(2);
$cart->addItem(2, 2);
$cart->listItems("DESCONTO10");

<?php

class Product
{
    public int $id;
    public string $name;
    public int $stock;
    public float $price;

    public function __construct(int $id, string $name, int $stock, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->price = $price;
    }
    // diminuir estoque
    public function decreaseStock(int $quantity): bool
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            return true;
        }
        return false;
    }
    // aumentar estoque
    public function increaseStock(int $quantity): void
    {
        $this->stock += $quantity;
    }
}

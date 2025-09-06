<?php

require_once 'Product.php';

class Cart
{
    private array $items = [];
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }
    //adicionar item
    public function addItem(int $productId, int $quantity): void
    {
        if (!isset($this->products[$productId])) {
            echo "Produto não encontrado.<br>";
            return;
        }

        $product = $this->products[$productId];

        if (!$product->decreaseStock($quantity)) {
            echo "Estoque insuficiente.<br>";
            return;
        }

        $this->items[$productId]['quantity'] = ($this->items[$productId]['quantity'] ?? 0) + $quantity;

        echo "Adicionado: {$product->name} ({$quantity} unidade[s]).<br>";
    }
    // Função que remove  os itens 
    public function removeItem(int $productId): void
    {
        if (!isset($this->items[$productId])) {
            echo "Produto não está no carrinho.<br>";
            return;
        }

        $quantity = $this->items[$productId]['quantity'];
        $this->products[$productId]->increaseStock($quantity);
        unset($this->items[$productId]);

        echo "Removido: {$this->products[$productId]->name}.<br>";
    }

    //listar itens 
    public function listItems(?string $coupon = null): void
    {
        if (empty($this->items)) {
            echo "Carrinho vazio.<br>";
            return;
        }

        $total = 0;
        foreach ($this->items as $id => $item) {
            $product = $this->products[$id];
            $subtotal = $item['quantity'] * $product->price;
            $total += $subtotal;

            echo "{$product->name} - Quantidade: {$item['quantity']} - Subtotal: R$ {$subtotal}<br>";
        }

        if ($coupon === "DESCONTO10") {
            $total *= 0.9;
            echo "Cupom aplicado: DESCONTO10 (-10%)<br>";
        }

        echo "Total: R$ {$total}<br>";
    }
}

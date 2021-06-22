<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart 
{
    //
    public $items=[];
    public $totalqty;
    public $totalprice;
    public function __construct($cart=null)
    {
       if($cart)
       {
           $this->items=$cart->items;
           $this->totalqty=$cart->totalqty;
           $this->totalprice=$cart->totalprice;
       }else{
        $this->items=[];
        $this->totalqty=0;
        $this->totlalprice=0;
       }
    }
    public function add($product)
    { 
          $item=[
              "id"=>$product->id,
             "title"=>$product->title,
             "price"=>$product->price,
             "qty"=>0,
             "image"=>$product->image,
          ];
          if(!array_key_exists($product->id,$this->items))
          {
                $this->items[$product->id]=$item;
                $this->totalqty+=1;
                $this->totalprice+=$product->price;
          }else{
                 $this->totalqty+=1;
                 $this->totalprice +=$product->price;
          }
          $this->items[$product->id]['qty']+=1;
    } 
    public function remove($id)
    {
       if(array_key_exists($id,$this->items))
       {
           $this->totalqty-=$this->items[$id]['qty'];
           $this->totalprice-=$this->items[$id]['qty']*$this->items[$id]['price'];
           unset($this->items[$id]);
       }
    }
    public function updateqty($id,$qty)
    {
       //reset qty and price in chart
        $this->totalqty-=$this->items[$id]['qty'];
        $this->totalprice-=$this->items[$id]['price']*$this->items[$id]['qty'];
         //add the item with new qty
         $this->items[$id]['qty']=$qty;

        //add the item with new qty
        $this->totalqty+=$qty;
        $this->totalprice+=$this->items[$id]['price']*$qty;
    }
}

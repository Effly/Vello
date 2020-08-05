<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function basket(){
        $orderId = session('order');

        if(!is_null($orderId)){
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }
    public function basketConfirm(Request $request){
        $orderId = session('order');
        if(is_null($orderId)){
            return redirect()->route('catalog-main');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name,$request->phone,$request->email);

        if($success){
            session()->flash('success','Ваш заказ принят в обработку');
        } else{
            session()->flash('warning', 'Что то пошло не так');
        }

      return redirect('/catalog');
    }
    public function basketPlace(){
        $orderId = session('order');
        if(is_null($orderId)){
            return redirect()->route('catalog-main');
        }
        $order = Order::find($orderId);
        return view('order',['order'=>$order]);
    }

    public function basketAdd($productId){//аолучаем айди товара
        $orderId = session('order');//айди заказа в сессии

        if(is_null($orderId)){
            $order = Order::create()->id;//если сессии нет создаем заказ с айдишником
            session(['order' => $order]);//создаем сессию с айди заказа

        } else{

        $order = Order::find($orderId);//уже есть заказ ищем его по айди
        }

        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();

        } else {

            $order->products()->attach($productId);//если такой товар не содержится в сессии в сессию
        }
        return redirect()->route('basket');//при доавблении баг с обновлением фикс
        //return view('basket', compact('order'));//из за этой конструкции при обновлении стр добавлялся товар из сессии
    }

    public function basketRemove($productId){
        $orderId = session('order');//айди заказа в сессии
        if(is_null($orderId)){
            return redirect()->route('basket');//при доавблении баг с обновлением фикс;

        }
        $order = Order::find($orderId);//ищем продукт для удааления
        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2){
                $order->products()->detach($productId);//detach убираем продукт по айди
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }


        } else {
            $order->products()->detach($productId);//detach убираем продукт по айди

        }

        return redirect()->route('basket');//при доавблении баг с обновлением фикс
    }
}

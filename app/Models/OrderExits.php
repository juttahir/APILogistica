<?php

namespace App\Models;

use App\State\Order\StateOrderExitCanceled;
use App\State\Order\StateOrderExitConcluded;
use App\State\Order\StateOrderExitConference;
use App\State\Order\StateOrderExitNew;
use App\State\Order\StateOrderExitSeparation;
use App\State\Order\StateOrderExitTransfer;
use App\State\Order\StateOrderExitTransit;
use App\State\Order\StateOrderExitTransport;



class OrderExits extends Orders {

    /**
     * STATUS DO PEDIDO
     */
    public const STATUSES = [
        'Novo'                      => StateOrderExitNew::class,
        'Cancelado'                 => StateOrderExitCanceled::class,
        'Aguardando Transferência'  => StateOrderExitTransfer::class,
        'Aguardando Separação'      => StateOrderExitSeparation::class,
        'Aguardando Conferência'    => StateOrderExitConference::class,
        'Aguardando Transporte'     => StateOrderExitTransport::class,
        'Em Transito'               => StateOrderExitTransit::class,
        'Concluído'                 => StateOrderExitConcluded::class
    ];

    /**
     * RETORNA O STATUS DO PEDIDO
     * @param string $state
     * @return string|null
     */
    public static function status(string $state):? string {
        return (array_search($state,self::STATUSES)??null);
    }

    /**
     * RETORNA SE ALGUM ITEM ESTA COM UM STATUS EM ESPECIFICO
     * @param string $status
     * @return bool
     */
    public function hasStatusItems(string $status): bool {
        if(OrderItemExits::where('order_id',$this->id)->where('status',$status)->first()){
            return true;
        }
        return false;
    }

    /**
     * RETORNA OS ITEMS DO PEDIDO
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(OrderItemExits::class,'order_id','id');
    }

    /**
     * RETORNA OS PACOTES DO PEDIDO
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages() {
        return $this->hasMany(OrderPackages::class,'order_id','id');
    }

    /**
     * RETORNA OS SERVIÇOS DO PEDIDO
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services() {
        return $this->hasMany(OrderServices::class,'order_id','id');
    }

    /**
     * MANIPULA AS AÇÕES.
     * @param string $action
     * @param ...$arguments
     * @return mixed
     */
    public function handle(string $action,...$arguments) {
        $class = self::STATUSES[$this->status];
        return (new $class($this))->$action(...$arguments);
    }

}

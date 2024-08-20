<?php declare(strict_types=1);

namespace App\Application\Abstractions\UseCases;


/**
 * Интерфейс UseCase-а отвечающего за ребалансировку процессов между рабочими машинами
 */
interface IRebalanceProcessesUseCase 
{
    /**
     * Основной метод
     */
    public function execute(): void;
}
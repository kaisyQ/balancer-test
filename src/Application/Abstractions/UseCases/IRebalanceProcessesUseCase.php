<?php declare(strict_types=1);

namespace App\Application\Abstractions\UseCases;


/**
 * Interface IRebalanceProcessesUseCase
 *
 * The interface declares a single method that must be implemented by a concrete class that
 * represents a use case for rebalancing processes.
 *
 * @package App\Application\Abstractions\UseCases
 */
interface IRebalanceProcessesUseCase 
{
    /**
     * The execute method is responsible for performing the logic of the rebalancing processes
     * use case. It is expected to interact with the necessary domain entities and repositories,
     * manipulate the data as needed, and update the state of the application.
     *
     */
    public function execute(): void;
}
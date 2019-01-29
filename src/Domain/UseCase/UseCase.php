<?php

namespace App\Domain\UseCase;

/**
 * command pattern
 * @see https://code.tutsplus.com/tutorials/design-patterns-the-command-pattern--cms-22942
 */
interface UseCase {
 
    public function execute( UseCaseRequest $request): UseCaseResponse;
}
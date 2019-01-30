<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @license MIT
 */
namespace App\Domain\UseCase;

/**
 * command pattern
 * 
 * @see https://code.tutsplus.com/tutorials/design-patterns-the-command-pattern--cms-22942
 */
interface UseCaseInterface {
 
    /**
     * execute
     *
     * @param  UseCaseRequest $request
     *
     * @return UseCaseResponse
     */
    public function execute( UseCaseRequest $request): UseCaseResponse;
}
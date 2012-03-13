<?php
/**
 * User: matteo
 * Date: 27/01/12
 * Time: 13.48
 *
 * Just for fun...
 */

namespace Cypress\LessElephantBundle\Listener;

use Cypress\LessElephantBundle\Collection\LessProjectCollection;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CypressLessRequestListener
{
    private $projectCollection;
    private $forceCompile;

    public function __construct(LessProjectCollection $projectCollection, $forceCompile)
    {
        $this->projectCollection = $projectCollection;
        $this->forceCompile = $forceCompile;
    }

    public function updateLess(GetResponseEvent $getResponseEvent)
    {
        foreach ($this->projectCollection as $project) {
            if (!$project->isClean() || true === $this->forceCompile) {
                $project->compile();
            }
        }
    }
}

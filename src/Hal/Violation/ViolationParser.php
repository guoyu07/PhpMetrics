<?php
namespace Hal\Violation;

use Hal\Metric\Metrics;
use Hal\Violation\Class_;

class ViolationParser
{

    /**
     * @param Metrics $metrics
     * @return $this
     */
    public function apply(Metrics $metrics)
    {

        $violations = [
            new Class_\Blob(),
            new Class_\TooComplexCode(),
            new Class_\ProbablyBugged(),
            new Class_\TooLong(),
            new Class_\TooDependent(),
        ];

        foreach ($metrics->all() as $metric) {
            $metric->set('violations', new Violations);

            foreach ($violations as $violation) {
                $violation->apply($metric);
            }
        }

        return $this;
    }
}

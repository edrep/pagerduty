<?php

namespace PagerDuty;

use PagerDuty\Exceptions\PagerDutyConfigurationException;

/**
 * A 'resolve' Event
 *
 * @author adil
 */
class ResolveEvent extends Event
{

    /**
     * ResolveEvent constructor.
     * @param $routingKey
     * @param null|string $dedupKey If empty, will try to auto-generate based on summary
     * @param null|string $summary Used to auto-generate dedup key
     * @throws PagerDutyConfigurationException
     */
    public function __construct($routingKey, $dedupKey, $summary = null)
    {
        parent::__construct($routingKey, 'resolve');

        if (empty($dedupKey)) {
            if (empty($summary)) {
                throw new PagerDutyConfigurationException('Cannot generate dedup key from empty summary');
            }

            $dedupKey = $this->buildAutoDeDupKey($summary);
        }

        $this->setDeDupKey($dedupKey);
    }
}

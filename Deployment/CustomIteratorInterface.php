<?php
namespace WindowsAzure\DistributionBundle\Deployment;


/**
 *
 */
interface CustomIteratorInterface
{
    /**
     * @param array $dirs
     * @param array $subdirs
     */
    public function getIterator(array $dirs, array $subdirs);
}
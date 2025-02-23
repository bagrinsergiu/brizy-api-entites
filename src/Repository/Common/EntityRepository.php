<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Common;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class EntityRepository extends ServiceEntityRepository implements EntityRepositoryInterface
{
    /**
     * Persist and flush the entity
     *
     * @param $entity
     */
    public function save($entity)
    {
        $this->persist($entity);
        $this->flush();
    }

    /**
     * Remove and flush the entity
     *
     * @param $entity
     */
    public function remove($entity)
    {
        $this->_em->remove($entity);
        $this->flush();
    }

    /**
     * Persist
     *
     * @param $entity
     */
    public function persist($entity)
    {
        $this->_em->persist($entity);
    }

    /**
     * Persist
     *
     * @param $entity
     */
    public function persistAll(array $entities)
    {
        array_map(function ($entity) {
            $this->persist($entity);
        }, $entities);

        return $entities;
    }

    /**
     * Flush
     */
    public function flush()
    {
        $this->_em->flush();
    }

    /**
     * Disable filter
     *
     * Return true if the filter was enabled or false if it was disabled
     *
     * @param $filter_name
     * @param $old_state
     *
     * @return bool
     */
    protected function disableFilter($filter_name, $old_state = true)
    {
        $filters = $this->_em->getFilters();
        if ($filters->isEnabled($filter_name) && $old_state) {
            $filters->disable($filter_name);

            return true;
        }

        return false;
    }

    /**
     * Enable filter
     *
     * Return true if it was disabled or false if it was enabled
     *
     * @param $filter_name
     * @param $old_state
     *
     * @return bool
     */
    protected function enableFilter($filter_name, $old_state = true)
    {
        $filters = $this->_em->getFilters();
        if (!$filters->isEnabled($filter_name) && $old_state) {
            $filters->enable($filter_name);

            return true;
        }

        return false;
    }

    public function commit()
    {
        $this->_em->commit();
    }

    public function rollback()
    {
        $this->_em->rollback();
    }

    public function beginTransaction()
    {
        $this->_em->beginTransaction();
    }

    public function deattach($data)
    {
        $this->_em->detach($data);
    }
}

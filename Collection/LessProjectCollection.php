<?php
/**
 * User: matteo
 * Date: 27/01/12
 * Time: 16.16
 *
 * Just for fun...
 */

namespace Cypress\LessElephantBundle\Collection;

use LessElephant\LessProject,
    LessElephant\CommandCaller,
    LessElephant\LessBinary,
    LessElephant\StalenessChecker\FinderStalenessChecker;

class LessProjectCollection implements \ArrayAccess, \Iterator, \Countable
{
    private $lessProjects;
    private $binary;
    private $position;

    /**
     * class constructor
     *
     * @param \LessElephant\LessBinary $binary   a LessBinary instance
     * @param                          $projects an array of projects configuration
     */
    public function __construct(LessBinary $binary, $projects)
    {
        $this->binary = $binary;
        $this->position = 0;
        foreach ($projects as $name => $data) {
            $this->lessProjects[] = new LessProject(
                $data['source_folder'],
                $data['source_file'],
                $data['destination_css'],
                $name,
                $this->binary
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->lessProjects[$this->position];
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->lessProjects[$this->position]);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset An offset to check for.
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->lessProjects[$offset]);
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return isset($this->lessProjects[$offset]) ? $this->lessProjects[$offset] : null;
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->lessProjects[] = $value;
        } else {
            $this->lessProjects[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->lessProjects[$offset]);
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function count()
    {
        return count($this->lessProjects);
    }


}

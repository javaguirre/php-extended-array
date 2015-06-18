<?php

namespace TA\ExtendedArray\Tests;

use TA\ExtendedArray\Type\ExtendedArray;

class ExtendedArrayTest extends \PHPUnit_Framework_TestCase
{
    protected $a;

    protected $ar;

    public function __construct()
    {
        $this->ar = array(
            'firstkey'  => 'myfirstvalue',
            'secondkey' => 'my second value',
            'new_key'        => array(
                'key1' => 'value1',
                'key2' => 'value2'
            )
        );

        $this->a = new ExtendedArray($this->ar);
    }

    public function testInitEmpty()
    {
        $this->assertEquals(
            (new ExtendedArray())->toArray(),
            array()
        );
    }

    public function testInitEmptyWithEmptyArray()
    {
        $this->assertEquals(
            (new ExtendedArray(array()))->toArray(),
            array()
        );
    }

    public function testGetAll()
    {
        $this->assertEquals(
            $this->a->getAll(array(), null),
            null
        );
    }

    public function testGetValidKey()
    {
        $this->assertEquals(
            $this->a->getAll(array('firstkey'), null),
            array('firstkey' => $this->ar['firstkey'])
        );
    }

    public function testGetInvalidKey()
    {
        $this->assertEquals(
            $this->a->getAll(array('other_key'), null),
            null
        );
    }

    public function testGetOneInvalidKey()
    {
        $this->assertEquals(
            $this->a->get('other_one', null),
            null
        );
    }

    public function testGetOneValidKey()
    {
        $this->assertEquals(
            $this->a->get('firstkey', null),
            $this->ar['firstkey']
        );
    }

    public function testHasEmptyArray()
    {
        $this->assertEquals(
            $this->a->hasAll(array()),
            false
        );
    }

    public function testHasValidKey()
    {
        $this->assertEquals(
            $this->a->hasAll(array('firstkey')),
            true
        );
    }

    public function testHasInvalidKey()
    {
        $this->assertEquals(
            $this->a->hasAll(array('hola')),
            false
        );
    }

    public function testHasOneEmptyArray()
    {
        $this->assertEquals(
            $this->a->hasOne(array()),
            false
        );
    }

    public function testHasOneValidKey()
    {
        $this->assertEquals(
            $this->a->hasOne(array('secondkey')),
            true
        );
    }

    public function testHasOneValidOneKey()
    {
        $this->assertEquals(
            $this->a->hasOne(array('no', 'firstkey')),
            true
        );
    }

    public function testHasOneValidOneKeyDifferentOrder()
    {
        $this->assertEquals(
            $this->a->hasOne(array('firstkey', 'no')),
            true
        );
    }

    public function testRemoveInvalidKey()
    {
        $this->assertEquals(
            $this->a->remove('no'),
            false
        );
    }

    public function testRemoveValidKey()
    {
        $this->assertEquals(
            $this->a->remove('firstkey'),
            $this->ar['firstkey']
        );
    }

    public function testToArray()
    {
        $this->assertEquals(
            $this->a->toArray(),
            $this->ar
        );
    }

    public function testToArrayWithObject()
    {
        $this->assertTrue($this->a != $this->ar);
    }

    public function testGetAccess()
    {
        $this->assertEquals(
            $this->a['firstkey'],
            $this->ar['firstkey']
        );
    }

    public function testGetAccessObject()
    {
        $this->assertEquals(
            $this->a->firstkey,
            $this->ar['firstkey']
        );
    }

    public function testSetAccess()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b->set('firstkey', 'new firstkey');

        $this->assertEquals(
            $b['firstkey'],
            'new firstkey'
        );
    }

    public function testSetAccessArray()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b['firstkey'] = 'new firstkey';

        $this->assertEquals(
            $b->firstkey,
            'new firstkey'
        );
    }

    public function testSetAccessObject()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b->firstkey = 'new firstkey';

        $this->assertEquals(
            $b['firstkey'],
            'new firstkey'
        );
    }
}
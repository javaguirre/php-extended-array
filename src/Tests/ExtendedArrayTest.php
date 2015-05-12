<?php

namespace TA\Tests;

use TA\Type\ExtendedArray;

class ExtendedArrayTest extends \PHPUnit_Framework_TestCase
{
    protected $a;

    protected $ar;

    public function __construct()
    {
        $this->ar = array(
            'iban'           => 'myiban',
            'account_holder' => 'aaaaa',
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
            $this->a->getAll(array('iban'), null),
            array('iban' => $this->ar['iban'])
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
            $this->a->get('iban', null),
            $this->ar['iban']
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
            $this->a->hasAll(array('iban')),
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
            $this->a->hasOne(array('account_holder')),
            true
        );
    }

    public function testHasOneValidOneKey()
    {
        $this->assertEquals(
            $this->a->hasOne(array('no', 'iban')),
            true
        );
    }

    public function testHasOneValidOneKeyDifferentOrder()
    {
        $this->assertEquals(
            $this->a->hasOne(array('iban', 'no')),
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
            $this->a->remove('iban'),
            $this->ar['iban']
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
            $this->a['iban'],
            $this->ar['iban']
        );
    }

    public function testGetAccessObject()
    {
        $this->assertEquals(
            $this->a->iban,
            $this->ar['iban']
        );
    }

    public function testSetAccess()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b->set('iban', 'new iban');

        $this->assertEquals(
            $b['iban'],
            'new iban'
        );
    }

    public function testSetAccessArray()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b['iban'] = 'new iban';

        $this->assertEquals(
            $b->iban,
            'new iban'
        );
    }

    public function testSetAccessObject()
    {
        $b = new ExtendedArray($this->a->toArray());
        $b->iban = 'new iban';

        $this->assertEquals(
            $b['iban'],
            'new iban'
        );
    }
}
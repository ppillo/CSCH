<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Child Entity
 *
 * @property int $id
 * @property string $givenName
 * @property string $familyName
 * @property string $gender
 * @property \Cake\I18n\Time $dob
 * @property string $address
 * @property bool $isAboriginal
 * @property bool $isIslander
 * @property bool $allergy
 * @property bool $disability
 * @property bool $legal
 * @property bool $immunisation
 * @property bool $active
 *
 * @property \App\Model\Entity\Childcontact[] $childcontacts
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Childcare[] $childcares
 * @property \App\Model\Entity\Custodian[] $custodians
 */
class Child extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}

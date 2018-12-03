<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Childcontact Entity
 *
 * @property int $id
 * @property string $givenName
 * @property string $familyName
 * @property string $homeNumber
 * @property string $mobileNumber
 * @property string $relationshipToChild
 * @property int $children_id
 * @property string $streetAddress
 * @property string $suburb
 * @property string $postCode
 * @property string $state
 *
 * @property \App\Model\Entity\Child $child
 */
class Childcontact extends Entity
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

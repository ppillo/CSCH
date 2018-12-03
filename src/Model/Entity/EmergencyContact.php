<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmergencyContact Entity
 *
 * @property int $id
 * @property string $givenName
 * @property string $familyName
 * @property string $mobilePhone
 * @property string $homePhone
 * @property string $relationshipMember
 * @property int $member_id
 *
 * @property \App\Model\Entity\Member $member
 */
class EmergencyContact extends Entity
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

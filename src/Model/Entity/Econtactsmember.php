<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Econtactsmember Entity
 *
 * @property int $id
 * @property string $givenName
 * @property string $familyname
 * @property string $homeNumber
 * @property string $mobileNumber
 * @property string $relationshipMember
 * @property int $Members_id
 *
 * @property \App\Model\Entity\Member $member
 */
class Econtactsmember extends Entity
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
        'id' => false,
        'Members_id' => false
    ];
}

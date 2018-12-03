<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Custodian Entity
 *
 * @property int $id
 * @property string $helpRoster
 * @property bool $childLivingWithYou
 * @property string $relationshipToChild
 * @property int $member_id
 * @property int $related_member
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Child[] $children
 */
class Custodian extends Entity
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

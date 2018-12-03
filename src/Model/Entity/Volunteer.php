<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Volunteer Entity
 *
 * @property int $id
 * @property int $member_id
 * @property int $medicare_number
 * @property string $private_health_fund
 * @property string $private_health_number
 * @property int $category_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $police_check_date
 * @property \Cake\I18n\Time $children_check_date
 * @property bool $reference_check_complete
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Referee[] $referees
 */
class Volunteer extends Entity
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

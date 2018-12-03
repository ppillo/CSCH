<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity
 *
 * @property int $id
 * @property string $givenName
 * @property string $familyName
 * @property \Cake\I18n\Time $dob
 * @property string $email
 * @property string $streetAddress
 * @property string $suburb
 * @property string $postCode
 * @property string $homePhone
 * @property string $mobilePhone
 * @property string $tier
 * @property bool $newsletter
 * @property string $gender
 * @property bool $voting
 * @property \Cake\I18n\Time $signupDate
 * @property bool $active
 * @property int $user_id
 * @property string $image
 * @property string $state
 * @property string $imageDir
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Custodian[] $custodians
 * @property \App\Model\Entity\EmergencyContact[] $emergency_contacts
 * @property \App\Model\Entity\Volunteer[] $volunteers
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Program[] $programs
 */
class Member extends Entity
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
